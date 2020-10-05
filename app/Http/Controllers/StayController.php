<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Room;
use App\Stay;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->getRoleNames()->first() == 'patient')
        {
             $dp = DB::table('stays')->where('patient_id', Auth::user()->patient->id)->get();
        }
        else{
            $dp = DB::table('stays')->get();
        }
        $dp_obj = $dp->map(function ($element){
            $patient = Patient::find($element->patient_id)->user->name;
            $room = Room::find($element->room_id)->roomtype;
            $starttime = new Carbon($element->start_time);
            $endtime = new Carbon($element->end_time);
            return [
                'patient' => $patient,
                'room' => $room,
                'starttime' => $starttime->toFormattedDateString(),
                'endtime' => $endtime->toFormattedDateString(),
                'url' => url('admin/stays'),
                'id' => $element->id,
            ];
        });
        $patients = Patient::all();
        $rooms = Room::all();
        return view('backend.stays.index', compact('dp_obj', 'patients', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all()->map(function ($patient){ $patient->user; return $patient; });
        $rooms = Room::all();
        $floors = $rooms->unique('blockfloor')->values();
        $codes = $rooms->unique('blockcode')->values();
        return view('backend.stays.create', compact('patients', 'rooms', 'codes', 'floors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $startdate = array($request->input('startdate'));
        $startdate = implode(" ", $startdate);
        $enddate = array($request->input('enddate'));
        $enddate = implode(" ", $enddate);
        $patient = $request->patient;
        $room = $request->room;
        $stay = new Stay;
        $stay->start_time = $startdate;
        $stay->end_time = $enddate;
        $stay->room_id = $room;
        $stay->patient_id = $patient;
        $stay->save();
        $stay->room->unavailable = 0;
        $stay->push();
        //Redirect
        return redirect()->route('stays.index')->with('status', 'stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
