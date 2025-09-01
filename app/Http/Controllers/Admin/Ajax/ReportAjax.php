<?php

namespace App\Http\Controllers\Admin\Ajax;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\room_schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use Illuminate\Support\Facades\DB;


class ReportAjax extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function get_room_occupied(Request $request)
    {
        if ($request->ajax()) {
            $room = $request->input('room');

            $schedules = \App\room_schedules::where('is_active', 1)
                            ->join('offerings_infos', 'offerings_infos.id', '=', 'room_schedules.offering_id')
                            ->where('room', $room)
                            ->get();
            
            return view('admin.reports.ajax.get_room_occupied', compact('schedules', 'room'));
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function get_section_occupied(Request $request)
    {
        if ($request->ajax()) {
            $section = $request->input('section');

            $schedules = \App\room_schedules::join('offerings_infos', 'offerings_infos.id', '=', 'room_schedules.offering_id')
                ->join('curricula', 'curricula.id', '=', 'offerings_infos.curriculum_id')
                ->join('ctr_sections', 'ctr_sections.section_name', '=', 'offerings_infos.section_name')
                ->join('users', 'users.id', '=', 'room_schedules.instructor')
                            ->where('room_schedules.is_active', 1)
                            ->where('ctr_sections.id', $section)
                            ->get();
            // return $schedules;
            return view('admin.reports.ajax.get_section_occupied', compact('schedules', 'section'));
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function view_signatories(Request $request)
    {
        if ($request->ajax()) {
            // $signatories = \App\Signatories::all();
            $prepby = \App\Signatories::select('fullname', 'position')
                ->where('role', 1)
                ->latest('date_created')
                ->first();
            return $prepby;
            return view('admin.reports.ajax.manage_signatories');
        }
    }
}
