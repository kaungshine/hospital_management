<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Physician;
use App\Patient;
use App\Nurse;
use App\Appointment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
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
             $dp = DB::table('appointments')->where('patient_id', Auth::user()->patient->id)->get();
        }
        else if(Auth::user()->getRoleNames()->first() == 'physician')
        {
             $dp = DB::table('appointments')->where('physician_id', Auth::user()->physician->id)->get();
        }
        else if(Auth::user()->getRoleNames()->first() == 'nurse')
        {
             $dp = DB::table('appointments')->where('nurse_id', Auth::user()->nurse->id)->get();
        }
        else{
            $dp = DB::table('appointments')->get();
        }
        $dp_obj = $dp->map(function ($element){
            $startdatetime = new Carbon($element->start_date_time);
            $enddatetime = new Carbon($element->end_date_time);
            $patient = Patient::find($element->patient_id)->user->name;
            $physician = Physician::find($element->physician_id)->user->name;
            $nurse = Nurse::find($element->nurse_id)->user->name;
            return [
                'patient' => $patient, 
                'physician' => $physician,
                'nurse' => $nurse,
                'url' => url('admin/appointments'),
                'id' => $element->id,
                'exaroom' => $element->examinationroom,
                'startdatetime' => $startdatetime->toDayDateTimeString(),
                'enddatetime' => $enddatetime->toDayDateTimeString()
            ];
        });
        $physicians = Physician::all();
        $patients = Patient::all();
        $nurses = Nurse::all();
        return view('backend.appointments.index', compact('dp_obj', 'patients', 'physicians', 'nurses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $physicians = Physician::all();
        $patients = Patient::all();
        $nurses = Nurse::all();
        return view('backend.appointments.create', compact('physicians', 'patients', 'nurses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $end_time_arr = explode(" ", $request->input('endtime'));
        $endtime = $end_time_arr[0]; $format = $end_time_arr[1];
        $endtime = explode(":", $endtime);
        $hr = $endtime[0]; $min = $endtime[1];
        if($format == "PM")
        {
            $hr = 12 + (int)$hr;
        }
        $endtime = implode(":", array($hr, $min));
        $enddatetime = array($request->input('enddate'), strval($endtime));
        $enddatetime = implode(" ", $enddatetime);

        $start_time_arr = explode(" ", $request->input('starttime'));
        $starttime = $start_time_arr[0]; $format = $start_time_arr[1];
        $starttime = explode(":", $starttime);
        $hr = $starttime[0]; $min = $starttime[1];
        if($format == "PM")
        {
            $hr = 12 + (int)$hr;
        }
        $starttime = implode(":", array($hr, $min));
        $startdatetime = array($request->input('startdate'), strval($starttime));
        $startdatetime = implode(" ", $startdatetime);
        $patient = $request->patient;
        $nurse = $request->nurse;
        $physician = $request->physician;
        $appointment = new Appointment;
        $appointment->examinationroom = $request->input('exaroom');
        $appointment->start_date_time = $startdatetime;
        $appointment->end_date_time = $enddatetime;
        $appointment->patient_id = $patient;
        $appointment->nurse_id = $nurse;
        $appointment->physician_id = $physician;
        $appointment->save();
        $appointment->patient->status = 'curing';
        $appointment->push();

        //Redirect
        return redirect()->route('appointments.index')->with('status', 'stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dp = DB::table('appointments')->where('id', $id)->first();
        $startdatetime = explode(" ", $dp->start_date_time);
        $startdate = $startdatetime[0];
        $starttime = $startdatetime[1];
        $enddatetime = explode(" ", $dp->end_date_time);
        $enddate = $enddatetime[0];
        $endtime = $enddatetime[1];
        $patient = Patient::find($dp->patient_id)->user->name;
        $nurse = Nurse::find($dp->nurse_id)->user->name;
        $physician = Physician::find($dp->physician_id)->user->name;
        $dp_obj = [
            'patient' => $patient,
            'patient_id' => $dp->patient_id, 
            'physician' => $physician,
            'physician_id' => $dp->physician_id,
            'nurse' => $nurse,
            'nurse_id' => $dp->nurse_id,
            'url' => url('admin/appointments'),
            'id' => $dp->id,
            'exaroom' => $dp->examinationroom,
            'startdate' => $startdate,
            'starttime' => $starttime,
            'enddate' => $enddate,
            'endtime' => $endtime
        ];
        return response()->json($dp_obj);
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
        $starttime = new \DateTime($request->starttime);
        $endtime = new \DateTime($request->endtime);
        DB::table('appointments')
          ->where('id', $id)
          ->update([
            'physician_id' => $request->physician,
            'nurse_id' => $request->nurse,
            'patient_id' => $request->patient,
            'examinationroom' => $request->exaroom,
            'start_date_time' => $request->startdate . " " . $starttime->format('H:i:s'),
            'end_date_time' => $request->enddate . " " . $endtime->format('H:i:s'),
        ]);
        $dp = DB::table('appointments')->get();
        $dp_obj = $dp->map(function ($element){
            $startdatetime = new Carbon($element->start_date_time);
            $enddatetime = new Carbon($element->end_date_time);
            $patient = Patient::find($element->patient_id)->user->name;
            $physician = Physician::find($element->physician_id)->user->name;
            $nurse = Nurse::find($element->nurse_id)->user->name;
            return [
                'patient' => $patient, 
                'physician' => $physician,
                'nurse' => $nurse,
                'url' => url('admin/appointments'),
                'id' => $element->id,
                'exaroom' => $element->examinationroom,
                'startdatetime' => $startdatetime->toDayDateTimeString(),
                'enddatetime' => $enddatetime->toDayDateTimeString()
            ];
        });
        return response()->json($dp_obj);
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
        DB::table('appointments')->where('id', $id)->delete();
        $dp = DB::table('appointments')->get();
        $dp_obj = $dp->map(function ($element){
            $startdatetime = new Carbon($element->start_date_time);
            $enddatetime = new Carbon($element->end_date_time);
            $patient = Patient::find($element->patient_id)->user->name;
            $physician = Physician::find($element->physician_id)->user->name;
            $nurse = Nurse::find($element->nurse_id)->user->name;
            return [
                'patient' => $patient, 
                'physician' => $physician,
                'nurse' => $nurse,
                'url' => url('admin/appointments'),
                'id' => $element->id,
                'exaroom' => $element->examinationroom,
                'startdatetime' => $startdatetime->toDayDateTimeString(),
                'enddatetime' => $enddatetime->toDayDateTimeString()
            ];
        });
        return response()->json($dp_obj);
    }
}
