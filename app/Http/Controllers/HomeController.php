<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Events\SearchEvent;
use Illuminate\Support\Facades\Session;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $role = Auth::user()->accesslevel;

        $availableRooms = \App\CtrRoom::where('is_active', 1)->count();
        $totalRooms = \App\CtrRoom::count();
        $totalSections = \App\CtrSection::count();
        $programs = \App\academic_programs::distinct()->get(['program_code','program_name']);

        $teachingInstructorsCount = \App\instructors_infos::join('room_schedules', 'room_schedules.instructor', '=', 'instructors_infos.instructor_id')
            ->distinct('instructors_infos.instructor_id')
            ->count();
        $teachingInstructors = \App\instructors_infos::join('room_schedules', 'room_schedules.instructor', '=', 'instructors_infos.instructor_id')
            ->join('users', 'users.id', '=', 'instructors_infos.instructor_id')
            ->distinct('instructors_infos.instructor_id')
            ->get(['users.name', 'users.lastname', 'instructors_infos.college', 'instructors_infos.employee_type']);
    

        if ($role == 0) {
            if (Auth::user()->is_first_login == 1) {
                return view('instructor.first_login');
            } else {
                return view('admin.dashboard', compact('availableRooms', 'totalRooms', 'totalSections', 'teachingInstructorsCount', 'teachingInstructors', 'programs'));
            }
        } elseif ($role == 1) {
            if (Auth::user()->is_first_login == 1) {
                return view('instructor.first_login');
            } else {
                return view('instructor.dashboard');
            }
        } elseif ($role == 100) {
            return view('super_admin.dashboard');
        } else {
            return view('adminlte::home');
        }
    }

    function search($search)
    {
        $user = \App\User::where('username', $search)->first();
        event(new SearchEvent($user));
    }

    function view_search()
    {
        return view('search');
    }

    function default_pass(Request $request)
    {
        $validate = $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);
        if ($validate) {
            $user = \App\User::find($request->idno);
            $user->is_first_login = 0;
            $user->password = bcrypt($request->password);
            $user->update();
        }
        Session::flash('success', 'Welcome to Instructor`s portal');
        return redirect(route('home'));
    }
}
