<?php

namespace App\Http\Controllers\Admin\Ajax;

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
    
    function edit_modal(){
        if(Request::ajax()){
            $curriculum_id = Input::get('curriculum_id');
            $course = \App\curriculum::find($curriculum_id);
            
            return view('admin.curriculum_management.edit_curriculum',compact('course'));
        }
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

            $offerings = offerings_infos_table::where('section_name', $section_name)->get();

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
    
    function remove_course_offer(){
        if(Request::ajax()){
            
            $section_name = Input::get('section_name');
            $curriculum_id = Input::get('curriculum_id');
           
            $check_if_exists = \App\offerings_infos_table::
                    where('curriculum_id',$curriculum_id)->where('section_name',$section_name)
                    ->first(); 
            $check_if_exists->delete();
            return 'Removed Course Offered!';
           
        }
    }
    
    function edit_section(){
        if(Request::ajax()){
            $section_id = Input::get('section_id');
            
            $section = \App\CtrSection::find($section_id);
            $programs = \App\academic_programs::distinct()->get(['program_code','program_name']);
            return view('admin.course_offering.ajax.edit_section',compact('section','programs'));
        }
    }
    
    function edit_room(){
        if(Request::ajax()){
            $room_id = Input::get('room_id');
            
            $room = \App\CtrRoom::find($room_id);
            $programs = \App\academic_programs::distinct()->get(['program_code','program_name']);
            return view('admin.course_offering.ajax.edit_room',compact('room','programs'));
        }
    }
}
