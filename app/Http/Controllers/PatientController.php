<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PatientController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allpatients = Patient::all();
        if(Auth::user()->getRoleNames()->first() == 'physician')
        {
            $allpatients = Auth::user()->physician->appointments
                           ->map(function($appointment){
                                return $appointment->patient;
                           });
        }
        $patients = $allpatients->map(function ($patient){
            $patient['url'] = url("admin/patients");
            $patient['user'] = User::find($patient->user_id);
            $patient->status = ($patient->status === "") ? " ": $patient->status;
            return $patient;
        })
        ->groupBy(function($el){return "patient-" . $el->id;})
        ->map(function($element){
            return $element->last();
        })->values(); 
        return view('backend.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.patients.create');
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
        $user = new User([
            'name' => $request->input('name'), 
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        $user->save();
        $user->assignRole('patient');

        $patient = new Patient;
        /* DB Column *//* Name = "?" */
        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');
        $patient->insuranceid = $request->input('insurance');
        $patient->status = "";
        $user->patient()->save($patient);
        return redirect()->route('patients.index');
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
    public function edit(Patient $patient)
    {
        $patient['url'] = url('admin/patients');
        $patient['user'] = User::find($patient->user_id);
        return response()->json($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
        $patient->insuranceid = $request->input('insurance');
        $patient->phone = $request->input('phone');
        $patient->address = $request->input('address');
        $patient->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        $patient->save();
        
        $patients = Patient::all()->map(function ($patient){
            $patient['url'] = url("admin/patients");
            $patient['user'] = User::find($patient->user_id);
            return $patient;
        });
        return response()->json($patients);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        $patients = Patient::all()->map(function ($patient){
            $patient['url'] = url("admin/patients");
            $patient['user'] = User::find($patient->user_id);
            return $patient;
        });
        return response()->json($patients);
    }
}
