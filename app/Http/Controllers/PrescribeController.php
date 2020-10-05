<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Physician;
use App\Patient;
use App\Medication;
use App\Appointment;
use App\Prescribe;
use App\Disease;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PrescribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->getRoleNames()->first() == 'patient')
        {
             $dp = DB::table('prescribes')->where('patient_id', Auth::user()->patient->id)->get();  
            $physician_appt = Auth::user()->patient->appointments()->has('prescribes')->get()->map(function($appointment){
                return ['appointment_id' => $appointment->id, 'physician_id' => $appointment->physician->id];
            });
            $physicians = array();
            foreach ($physician_appt as $value) {
                $value = collect($value);
                $physician = Physician::find($value->get('physician_id'));
                $extras = DB::table('prescribes')
                            ->where('patient_id', Auth::user()->patient->id)
                            ->where('physician_id', $value->get('physician_id'))
                            ->where('appointment_id', $value->get('appointment_id'))
                            ->get(['id', 'appointment_id', 'date', 'dose'])->first();
                $appointment = Appointment::find($extras->appointment_id);
                $appointment->end_date_time = Carbon::parse($appointment->end_date_time)
                                                ->toDayDateTimeString();
                $appointment->start_date_time = Carbon::parse($appointment->start_date_time)
                                                    ->toDayDateTimeString();
                $physician['custom_appointment'] = array_merge($appointment->toArray(), [
                                                'physician' => $appointment->physician->user,
                                                'nurse' => $appointment->nurse->user
                                            ]);  
                $physician['prescribe_id'] = $extras->id;                                
                $physician['date'] = new Carbon($extras->date);
                $physician['dose'] = $extras->dose;

                $physician['medications'] = Medication::find(DB::table('prescribes')
                                ->where('patient_id', Auth::user()->patient->id)
                                ->where('physician_id', $value->get('physician_id'))
                                ->where('appointment_id', $value->get('appointment_id'))
                                ->get('medication_id')->map->medication_id->toArray());
                array_push($physicians, $physician);
            }
            $dp_obj = collect($physicians)->map(function($element){
                return [
                    'physician' => Physician::find($element->id)->user->name,
                    'patient' => Auth::user()->name,
                    'medication' => $element['medications'],
                    'appointment' => $element['custom_appointment'],
                    'url' => url('admin/prescribes'),
                    'id' => $element['prescribe_id'],
                    'dose' => $element['dose'],
                    'date' => $element['date']->toFormattedDateString(),
                ];
            });
        }
        else if(Auth::user()->getRoleNames()->first() == 'physician')
        {
            $dp = DB::table('prescribes')->where('physician_id', Auth::user()->physician->id)->get(); 
            $patient_appt = Auth::user()->physician->appointments()->has('prescribes')->get()->map(function($appointment){
                return ['appointment_id' => $appointment->id, 'patient_id' => $appointment->patient->id];
            });
            $patients = array();
            foreach ($patient_appt as $value) {
                $value = collect($value);
                $patient = Patient::find($value->get('patient_id'));
                $extras = DB::table('prescribes')
                            ->where('physician_id', Auth::user()->physician->id)
                            ->where('patient_id', $value->get('patient_id'))
                            ->where('appointment_id', $value->get('appointment_id'))
                            ->get(['id', 'appointment_id', 'date', 'dose'])->first();
                $appointment = Appointment::find($extras->appointment_id);
                $appointment->end_date_time = Carbon::parse($appointment->end_date_time)
                                                ->toDayDateTimeString();
                $appointment->start_date_time = Carbon::parse($appointment->start_date_time)
                                                    ->toDayDateTimeString();
                $patient['custom_appointment'] = array_merge($appointment->toArray(), [
                                                'physician' => $appointment->physician->user,
                                                'nurse' => $appointment->nurse->user
                                            ]);  
                $patient['prescribe_id'] = $extras->id;                                
                $patient['date'] = new Carbon($extras->date);
                $patient['dose'] = $extras->dose;

                $patient['medications'] = Medication::find(DB::table('prescribes')
                                ->where('physician_id', Auth::user()->physician->id)
                                ->where('patient_id', $value->get('patient_id'))
                                ->where('appointment_id', $value->get('appointment_id'))
                                ->get('medication_id')->map->medication_id->toArray());
                array_push($patients, $patient);
            }
            $dp_obj = collect($patients)->map(function($element){
                return [
                    'patient' => Patient::find($element->id)->user->name,
                    'physician' => Auth::user()->name,
                    'medication' => $element['medications'],
                    'appointment' => $element['custom_appointment'],
                    'url' => url('admin/prescribes'),
                    'id' => $element['prescribe_id'],
                    'dose' => $element['dose'],
                    'date' => $element['date']->toFormattedDateString(),
                ];
            });
        }
        else{
            $dp = DB::table('prescribes')->get();
            $dp_obj = $dp->map(function ($element){
            $date = new Carbon($element->date);
            $patient = Patient::find($element->patient_id)->user->name;
            $physician = Physician::find($element->physician_id)->user->name;
            $medication = Medication::find($element->medication_id)->name;
            $appointment = Appointment::find($element->appointment_id);
            $appointment->end_date_time = Carbon::parse($appointment->end_date_time)
                                            ->toDayDateTimeString();
            $appointment->start_date_time = Carbon::parse($appointment->start_date_time)
                                                ->toDayDateTimeString();
            return [
                'patient' => $patient,
                'physician' => $physician,
                'medication' => $medication,
                'appointment' => array_merge($appointment->toArray(), [
                                                'physician' => $appointment->physician->user,
                                                'nurse' => $appointment->nurse->user
                                            ]),
                'url' => url('admin/prescribes'),
                'id' => $element->id,
                'dose' => $element->dose,
                'date' => $date->toFormattedDateString(),
            ];
            });
        }
        $physicians = Physician::all();
        $patients = Patient::all();
        $medications = Medication::all();
        $appointments = Appointment::all();
        return view('backend.prescribes.index', compact('dp_obj', 'patients', 'physicians', 'medications', 'appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $patient_id = $request->query('id');
        $physician = Auth::user()->physician ?? Physician::all();
        $patient = Patient::find($patient_id);
        $medications = Medication::all();
        $diseases = Disease::all();
        $appointment = Patient::find($patient_id)->appointments
        ->map(function ($appointment){
            $appointment->physician->user;
            $appointment->nurse->user;
            $appointment->precribes;
            return $appointment;
        })->last();
        $previous_appointments = Patient::find($patient_id)->appointments
        ->filter(function ($appointment){
            return $appointment->physician->user->id == Auth::id();
        })
        ->map(function ($appointment){
            $appointment->physician->user;
            $appointment->nurse->user;
            $appointment->precribes;
            return $appointment;
        })
        ->reject(function ($appointment, $key) use ($patient_id){
            return $key === count(Patient::find($patient_id)->appointments) - 1;
        });
        return view('backend.prescribes.create', compact('physician', 'patient', 'medications', 'appointment', 'previous_appointments', 'diseases'));
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
        $date = array($request->input('date'));
        $date = implode(" ", $date);
        $patient = $request->input('patient_id');
        $medication = $request->medication;
        $physician = $request->physician;
        $appointment = $request->appointment;
        $diseasepatient = Patient::find($request->patient_id);
        $diseasepatient->diseases()->attach($request->disease);
        foreach ($request->input('medication') as $key => $medication) {
            # code...
            $prescribe = new Prescribe;
            $prescribe->dose = $request->input('dose');
            $prescribe->date = $date;
            $prescribe->patient_id = $patient;
            $prescribe->medication_id = $medication;
            $prescribe->physician_id = Auth::user()->physician->id;
            $prescribe->appointment_id = $appointment;
            $prescribe->save();
        }
        $patient = Patient::find($request->input('patient_id'));
        $patient->status="cured";
        $patient->save();

        //Redirect
        return redirect()->route('patients.index')->with('status', 'stored');
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
