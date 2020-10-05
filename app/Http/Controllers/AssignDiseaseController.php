<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Disease;
use App\User;
use Illuminate\Support\Facades\DB;

class AssignDiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dp = DB::table('disease_patient')->get();
        $dp_obj = $dp->map(function ($element){
            $disease = Disease::find($element->disease_id)->name;
            $patient = Patient::find($element->patient_id)->user->name;
            return [
                'disease' => $disease, 
                'patient' => $patient,
                'url' => url('admin/assigndiseases'),
                'id' => $element->id,
            ];
        });
        $patients = Patient::all();
        $diseases = Disease::all();
        return view('backend.assigndiseases.index', compact('dp_obj', 'diseases', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $diseases = Disease::all();
        return view('backend.assigndiseases.create', compact('patients', 'diseases'));
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
        $patient = Patient::find($request->patient);
        $patient->diseases()->attach($request->disease);

        //Redirect
        return redirect()->route('assigndiseases.index')->with('status', 'stored');
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
        $dp = DB::table('disease_patient')->where('id', $id)->first();
        $disease = Disease::find($dp->disease_id)->name;
        $patient = Patient::find($dp->patient_id)->user->name;
        $dp_obj = [
            'disease' => $disease,
            'disease_id' => $dp->disease_id, 
            'patient' => $patient,
            'patient_id' => $dp->patient_id,
            'url' => url('admin/assigndiseases'),
            'id' => $dp->id,
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
        //
        DB::table('disease_patient')
          ->where('id', $id)
          ->update([
            'disease_id' => $request->disease,
            'patient_id' => $request->patient,
        ]);
        $dp = DB::table('disease_patient')->get();
        $dp_obj = $dp->map(function ($element){
            $disease = Disease::find($element->disease_id)->name;
            $patient = Patient::find($element->patient_id)->user->name;
            return [
                'disease' => $disease, 
                'patient' => $patient,
                'url' => url('admin/assigndiseases'),
                'id' => $element->id,
            ];
        });
        return response()->json($dp_obj);
    }
    public function destroy($id)
    {
        //
        DB::table('disease_patient')->where('id', $id)->delete();
        $dp = DB::table('disease_patient')->get();
        $dp_obj = $dp->map(function ($element){
            $disease = Disease::find($element->disease_id)->name;
            $patient = Patient::find($element->patient_id)->user->name;
            return [
                'disease' => $disease, 
                'patient' => $patient,
                'url' => url('admin/assigndiseases'),
                'id' => $element->id,
            ];
        });
        return response()->json($dp_obj);
    }
}
