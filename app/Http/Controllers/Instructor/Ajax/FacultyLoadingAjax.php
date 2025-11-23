<?php

namespace App\Http\Controllers\Instructor\Ajax;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
Use Illuminate\Support\Facades\DB;
use Request;
use App\Events\LoadingNotification;
use PDF;

class FacultyLoadingAjax extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    function get_offer_load(){
        if(Request::ajax()){
            $offering_id = Input::get('offering_id');
            $schedules = \App\room_schedules::where('offering_id',$offering_id)
                    ->where('instructor',Auth::user()->id)->get()->unique('offering_id');
            
            return view('instructor.faculty_loading.ajax.get_offer_load',compact('schedules','offering_id'));
        }
    }
    
    function accept_load(){
        if(Request::ajax()){
           $offering_id = Input::get('offering_id');
           
           $schedules = \App\room_schedules::where('instructor',Auth::user()->id)
                   ->where('offering_id',$offering_id)->get();
           if(!empty($schedules)){
               foreach($schedules as $schedule){
                   $schedule->is_loaded = 1;
                   $schedule->update();
               }
           }
           
           $user = \App\User::find(Auth::user()->id);
           
           $notification = new \App\LoadNotification;
           $notification->date_time = date('Y-m-d H:i:s');
           $notification->content = "Instructor ".strtoupper($user->lastname).', '.strtoupper($user->name).' accepted the faculty load suggested by the Admin.';
           $notification->save();
           
           $content = "Instructor ".strtoupper($user->lastname).', '.strtoupper($user->name).' accepted the faculty load suggested by the Admin.';
           
           event(new LoadingNotification($content));
        }
    }
    
    function reject_offer(){
        if(Request::ajax()){
          $offering_id = Input::get('offering_id');
          $reason = Input::get('reason');
          
          $schedules = \App\room_schedules::where('instructor',Auth::user()->id)
                   ->where('offering_id',$offering_id)->get();
           if(!empty($schedules)){
               foreach($schedules as $schedule){
                   $schedule->is_loaded = 0;
                   $schedule->instructor = NULL;
                   $schedule->update();
               }
           }
           
           $user = \App\User::find(Auth::user()->id);
           
           $notification = new \App\LoadNotification;
           $notification->date_time = date('Y-m-d H:i:s');
           $notification->content = "Instructor ".strtoupper($user->lastname).', '.strtoupper($user->name).' rejected the faculty load suggested by the Admin. Due to '.$reason;
           $notification->save();
           
           $content = "Instructor ".strtoupper($user->lastname).', '.strtoupper($user->name).' rejected the faculty load suggested by the Admin. Due to '.$reason;
           
           event(new LoadingNotification($content));
        }
    }
    
    function reloadtabular(){
        if(Request::ajax()){
            $tabular_schedules = \App\room_schedules::distinct()->
                    where('is_active',1)->where('instructor',Auth::user()->id)->get(['offering_id','is_loaded']);
            return view('instructor.faculty_loading.ajax.reloadtabular',compact('tabular_schedules'));
        }
    }
    
    function reloadcalendar(){
        $schedules = \App\room_schedules::where('is_active',1)->where('instructor',Auth::user()->id)->get();
         if(!$schedules->isEmpty()){
            foreach($schedules as $sched){
                $course_detail = \App\curriculum::join('offerings_infos','offerings_infos.curriculum_id','curricula.id')
                        ->where('offerings_infos.id',$sched->offering_id)->first(['curricula.course_code','offerings_infos.section_name']);
                if($sched->day == 'M'){
                    $day = 'Monday';
                }else if($sched->day == 'T'){
                    $day = 'Tuesday';
                }else if($sched->day == 'W'){
                    $day = 'Wednesday';
                }else if($sched->day == 'Th'){
                    $day = 'Thursday';
                }else if($sched->day == 'F'){
                    $day = 'Friday';
                }else if($sched->day == 'Sa'){
                    $day = 'Saturday';
                }else if($sched->day == 'Su'){
                    $day = 'Sunday';
                }

                if($sched->is_loaded == 1){
                    $color = "lighblue";
                }else{
                    $color = "lightsalmon";
                }

                $event_array[] = array(
                    'id' => $sched->id,
                    'title' => $course_detail->course_code.'<br>'.$sched->room.'<br>'.$course_detail->section_name,
                    'start' => date('Y-m-d', strtotime($day. ' this week')).'T'.$sched->time_starts,
                    'end' => date('Y-m-d', strtotime($day. ' this week')).'T'.$sched->time_end,
                    'color' => $color,
                    "textEscape"=> 'false' ,
                    'textColor' => 'black',
                    'offering_id' => $sched->offering_id
                );
            }
            $get_schedule = json_encode($event_array);
        }else{
            $get_schedule = NULL;
        }
        
        return $get_schedule;
    }

    public function print_schedule($id){
           $schedules = \App\room_schedules::join('offerings_infos', 'offerings_infos.id', '=', 'room_schedules.offering_id')
                    ->join('curricula', 'curricula.id', '=', 'offerings_infos.curriculum_id')
                    ->join('users', 'users.id', '=', 'room_schedules.instructor')
                    ->distinct()->where('is_active',1)
                    ->where('instructor',$id)   
                    ->get();

        $section = $schedules->first()->section_nae;
        $semester = $schedules->first()->period;
        $curriculum_year = $schedules->first()->curriculum_year;
        $faculty = $schedules->first()->name . " " . $schedules->first()->lastname;

        $prepby = \App\Signatories::select('fullname', 'position', 'signature_path')
            ->where('role', 1)
            ->latest('created_at')
            ->first();
        $rec_approval = \App\Signatories::select('fullname', 'position', 'signature_path')
            ->where('role', 2)
            ->latest('created_at')
            ->first();
        $approved = \App\Signatories::select('fullname', 'position', 'signature_path')
            ->where('role', 3)
            ->latest('created_at')
            ->first();
        $conforme = \App\Signatories::select('fullname', 'position', 'signature_path')
            ->where('role', 4)
            ->latest('created_at')
            ->first();  

        // return $schedules;
        $pdf = PDF::loadView('Instructor.print_instructor_occupied',compact('schedules', 'curriculum_year', 'section', 'semester', 'faculty', 'prepby', 'rec_approval', 'approved', 'conforme'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream("SectionsOccupied.pdf");
    }
}
