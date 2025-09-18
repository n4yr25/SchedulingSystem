<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\academic_programs;
use App\CtrRoom;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use Illuminate\Support\Facades\DB;
use App\CtrSection;
use App\curriculum;
use App\offerings_infos_table;

class CourseOfferingAjax extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function get_sections(Request $request)
    {
        if ($request->ajax()) {
            $level = $request->input('level');
            $program_code = $request->input('program_code');

            $sections = CtrSection::where('level', $level)
                ->where('is_active', 1)
                ->where('program_code', $program_code)
                ->get();

            return view('admin.course_offering.ajax.get_sections', compact('sections'))->render();
        }

        // Optional: Handle non-AJAX requests
        return response()->json(['error' => 'Invalid request'], 400);
    }
    
    public function edit_modal(Request $request)
    {
        if ($request->ajax()) {
            $curriculum_id = $request->input('curriculum_id');
            $course = \App\Curriculum::find($curriculum_id);

            return view('admin.curriculum_management.edit_curriculum', compact('course'));
        }

        // Optional: Handle non-AJAX access
        return response()->json(['error' => 'Invalid request'], 400);
    }
    
    public function get_courses(Request $request)
    {
        if ($request->ajax()) {
            $curriculum_year = $request->input('cy');
            $level = $request->input('level');
            $period = $request->input('period');
            $section_name = $request->input('section_name');
            $program_code = $request->input('program_code');

            $offered = offerings_infos_table::where('section_name', $section_name)->get();

            $courses = curriculum::where('program_code', $program_code)
                ->where('curriculum_year', $curriculum_year)
                ->where('level', $level)
                ->where('period', $period)
                ->whereNotIn('id', $offered->pluck('curriculum_id')->toArray())
                ->get();

            return view('admin.course_offering.ajax.get_courses', compact(
                'courses',
                'section_name',
                'level',
                'period',
                'curriculum_year'
            ))->render();
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
    
    
    public function get_courses_offered(Request $request)
    {
        if ($request->ajax()) {
            $curriculum_year = $request->input('cy');
            $level = $request->input('level');
            $period = $request->input('period');
            $section_name = $request->input('section_name');

            $offerings = offerings_infos_table::where('section_name', $section_name)
                ->where('level', $level)
                ->get();

            return view('admin.course_offering.ajax.get_courses_offered', compact(
                'offerings', 'section_name', 'curriculum_year', 'level', 'period'
            ))->render();
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
    
    public function add_course_offer(Request $request)
    {
        if ($request->ajax()) {
            $section_name = $request->input('section_name');
            $curriculum_id = $request->input('course_id');

            // Check if the offering already exists
            $check_if_exists = offerings_infos_table::where('curriculum_id', $curriculum_id)
                ->where('section_name', $section_name)
                ->exists();

            if ($check_if_exists) {
                return response()->json(['message' => 'Offered Subject Already Exists!'], 409); // Conflict
            }

            $curriculum = curriculum::find($curriculum_id);

            if (!$curriculum) {
                return response()->json(['message' => 'Curriculum not found!'], 404);
            }

            $offering = new offerings_infos_table();
            $offering->curriculum_id = $curriculum_id;
            $offering->section_name = $section_name;
            $offering->level = $curriculum->level;
            $offering->save();

            return response()->json(['message' => 'Offered Subject!'], 201);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function remove_course_offer(Request $request)
    {
        if ($request->ajax()) {
            $section_name = $request->input('section_name');
            $curriculum_id = $request->input('curriculum_id');

            $courseOffer = \App\offerings_infos_table::where('curriculum_id', $curriculum_id)
                ->where('section_name', $section_name);

            if ($courseOffer) {
                $courseOffer->delete();
                return response()->json(['message' => 'Removed Course Offered!']);
            }

            return response()->json(['error' => 'Course offering not found.'], 404);
        }

        return response()->json(['error' => 'Invalid request.'], 400);
    }
    
    public function edit_section(Request $request)
    {
        if ($request->ajax()) {
            $sectionId = $request->input('section_id');
            
            $section = CtrSection::find($sectionId);
            $programs = academic_programs::distinct()->get(['program_code', 'program_name']);

            return view('admin.course_offering.ajax.edit_section', compact('section', 'programs'));
        }

        // Optionally return a 404 or redirect if not an AJAX request
        abort(404);
    }
    
    public function edit_room(Request $request)
    {
        if ($request->ajax()) {
            $roomId = $request->input('room_id');

            $room = CtrRoom::find($roomId);
            $programs = academic_programs::distinct()->get(['program_code', 'program_name']);

            return view('admin.course_offering.ajax.edit_room', compact('room', 'programs'));
        }

        // Optional: return a 404 error if not an AJAX request
        abort(404);
    }
}
