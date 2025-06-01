<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class ReportController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('checkIfActivated');
        $this->middleware('admin');
    }
    
    function room_occupied(){
        $rooms = \App\CtrRoom::all();
        return view('admin.reports.room_occupied',compact('rooms'));
    }
    
    function print_room_occupied($room){
        // $schedules = \App\room_schedules::where('is_active',1)
        //             ->where('room',$room)->get();
        $curriculum_year = 2025;
        $schedules = \App\room_schedules::join('offerings_infos', 'offerings_infos.id', '=', 'room_schedules.offering_id')
        ->join('curricula', 'curricula.id', '=', 'offerings_infos.curriculum_id')
        ->join('users', 'users.id', '=', 'room_schedules.instructor')
        ->select(
            'room_schedules.day',
            'room_schedules.time_starts',
            'room_schedules.time_end',
            'room_schedules.room',
            'curricula.course_code',
            'curricula.course_name',
            'curricula.program_code',
            'offerings_infos.section_name',
            'users.name',
            'users.lastname'
        )
        ->where('room_schedules.is_active', 1)
        ->where('room_schedules.room', $room)
        ->get();

        // return $schedules;

        $pdf = PDF::loadView('admin.reports.print_room_occupied',compact('schedules','room', 'curriculum_year'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream("RoomsOccupied.pdf");
    }

    public function section_load(){
        $sections = \App\CtrSection::all();
        return view('admin.reports.section_load',compact('sections'));
    }

    function print_section_occupied($room){
        // $schedules = \App\room_schedules::where('is_active',1)
        //             ->where('room',$room)->get();
        $curriculum_year = 2025;

        $section = \App\CtrSection::where('id', $room)->get();
        $program = $section->first()->program_code;
        $level = $section->first()->level;
        $section_name = $section->first()->section_name;

        // return $program.",".$level.",".$section_name;
            
           
        $schedules = \App\room_schedules::join('offerings_infos', 'offerings_infos.id', '=', 'room_schedules.offering_id')
        ->join('curricula', 'curricula.id', '=', 'offerings_infos.curriculum_id')
        ->join('ctr_sections', 'ctr_sections.section_name', '=', 'offerings_infos.section_name')
        ->join('users', 'users.id', '=', 'room_schedules.instructor')
        ->select(
            'room_schedules.day',
            'room_schedules.time_starts',
            'room_schedules.time_end',
            'room_schedules.room',
            'curricula.course_code',
            'curricula.course_name',
            'curricula.program_code',
            'ctr_sections.section_name',
            'users.name',
            'users.lastname'
        )
        ->where('room_schedules.is_active', 1)
        ->where('ctr_sections.id', $room)
        ->where('curricula.program_code', $program)
        ->get();

        $section = $schedules->first()->section_name;
      
        $pdf = PDF::loadView('admin.reports.print_section_occupied',compact('schedules','room', 'curriculum_year', 'section'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream("SectionsOccupied.pdf");
    }
}
