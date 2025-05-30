<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Controllers\Controller;
use App\room_schedules;
use Illuminate\Http\Request;


class CourseExportAjax extends Controller
{
    public function exportCourses(Request $request) 
    {
       $data = $request->query('courseId');
       $response = room_schedules::whereIn('offering_id', $data)->get();

        // You can format the response as needed, e.g., to JSON or a specific structure
        // For example, if you want to return JSON:
        // return response()->json($response);

        // If you want to return a view with the data:
        //
       return $response;
        // return view('admin.course_schedule.course_schedule', compact('data'));
    }
}