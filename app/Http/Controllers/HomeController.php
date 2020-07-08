<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['index']);;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $schedule = Schedule::where('user_id', Auth::user()->id)->get();
        return view('index', compact('schedule'));
    }


    public function postSchedule(Request $request){
        $data['name'] = request('event');
        $data['date'] = request('date');
        $data['user_id'] = Auth::user()->id;

        Schedule::create($data);

        return redirect('/scheduling');
    }


    public function editSchedule(Request $request){
        $data['name'] = request('event_edit');
        $data['date'] = request('date');
        $schedule = Schedule::where('user_id', Auth::user()->id)->where('date', $data['date'])->first();

        $schedule->update($data);

        return redirect('/scheduling');
    }


    public function deleteSchedule(Request $request, $date){
        $date = $date;
        $schedule = Schedule::where('user_id', Auth::user()->id)->where('date', $date)->first();

        $schedule->delete();

        return redirect('/scheduling');
    }


}
