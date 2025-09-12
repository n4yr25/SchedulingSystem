<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\CtrRoom;
use App\CtrSection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\instructors_infos;
use App\offerings_infos_table;
use App\room_schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use Illuminate\Support\Facades\DB;


class CourseScheduleAjax extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function get_sections(Request $request)
    {
        if ($request->ajax()) {
            $program_code = $request->input('program_code');
            $level = $request->input('level');

            $sections = CtrSection::where('program_code', $program_code)
                ->where('level', $level)
                ->whereNotNull('section_name')
                ->distinct()
                ->get(['section_name']);

            return view('admin.course_schedule.ajax.get_sections', compact('sections'))->render();
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
    
    public function get_courses_offered(Request $request)
    {
        if ($request->ajax()) {
            $program_code = $request->input('program_code');
            $level = $request->input('level');
            $section_name = $request->input('section_name');

            $courses = offerings_infos_table::where('level', $level)
                ->where('section_name', $section_name)
                ->get();

            return view('admin.course_schedule.ajax.get_courses_offered', compact('courses', 'section_name'))->render();
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
    
    public function get_rooms_available(Request $request)
    {
        if ($request->ajax()) {
            $day = $request->input('day');
            $time_start = $request->input('time_start');
            $time_end = $request->input('time_end');
            $offering_id = $request->input('offering_id');
            $section_name = $request->input('section_name');

            // Parse times to proper format
            $start = date("H:i:s", strtotime($time_start));
            $end = date("H:i:s", strtotime($time_end));

            
          

            // Find conflicting room schedules
            $conflict_schedules = room_schedules::join('offerings_infos', 'offerings_infos.id', '=', 'room_schedules.offering_id')
                ->where('room_schedules.day', $day)
                ->where(function ($query) use ($start, $end) {
                    $query->whereBetween('room_schedules.time_starts', [$start, $end])
                        ->orWhereBetween('room_schedules.time_end', [$start, $end])
                        ->orWhere(function($q) use ($start, $end) {
                            $q->where('room_schedules.time_starts', '<=', $start)
                                ->where('room_schedules.time_end', '>=', $end);
                        });
                })
                ->get();

            $instructors = instructors_infos::join('users', 'users.id', '=', 'instructors_infos.instructor_id')
                ->where('instructors_infos.employee_type', '!=' , 'Inactive')
                ->get(['instructors_infos.instructor_id', 'users.name', 'users.lastname']);

            // Filter available rooms
            if ($conflict_schedules->isNotEmpty()) {
                $conflicting_rooms = $conflict_schedules->pluck('room')->unique()->toArray();

                $rooms = CtrRoom::where('is_active', 1)
                    ->whereNotIn('room', $conflicting_rooms)
                    ->get();
            } else {
                $rooms = CtrRoom::where('is_active', 1)->get();
            }
            
            return view('admin.course_schedule.ajax.get_available_rooms', compact(
                'rooms', 'offering_id', 'day', 'time_start', 'time_end', 'section_name', 'instructors'
            ))->render();
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
    
}
