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
}
