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

            $schedules = room_schedules::where('is_active', 1)
                            ->where('room', $room)
                            ->get();

            return view('admin.reports.ajax.get_room_occupied', compact('schedules', 'room'));
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
}
