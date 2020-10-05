<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Physician;
use App\Procedure;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AssignProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->getRoleNames()->first() == 'physician')
        {
             $dp = DB::table('physician_procedure')->where('physician_id', Auth::user()->physician->id)->get();
        }
        else{
            $dp = DB::table('physician_procedure')->get();
        }
        $dp_obj = $dp->map(function ($element){
            $datetime = new Carbon($element->time);
            $procedure = Procedure::find($element->procedure_id)->name;
            $physician = Physician::find($element->physician_id)->user->name;
            return [
                'procedure' => $procedure, 
                'physician' => $physician,
                'url' => url('admin/assignprocedures'),
                'id' => $element->id,
                'time' => $datetime->toDayDateTimeString()
            ];
        });
        $physicians = Physician::all();
        $procedures = Procedure::all();
        return view('backend.assignprocedures.index', compact('dp_obj', 'procedures', 'physicians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $physicians = Physician::all();
        $procedures = Procedure::all();
        return view('backend.assignprocedures.create', compact('physicians', 'procedures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time_arr = explode(" ", $request->input('time'));
        $time = $time_arr[0]; $format = $time_arr[1];
        $time = explode(":", $time);
        $hr = $time[0]; $min = $time[1];
        if($format == "PM")
        {
            $hr = 12 + (int)$hr;  
        }
        $time = implode(":", array($hr, $min));
        $datetime = array($request->input('date'), strval($time));
        $datetime = implode(" ", $datetime);
        $physician = Physician::find($request->physician);
        $physician->procedures()->attach($request->procedure, ['time' => $datetime]);

        //Redirect
        return redirect()->route('assignprocedures.index')->with('status', 'stored');
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
        $dp = DB::table('physician_procedure')->where('id', $id)->first();
        $datetime = explode(" ", $dp->time);
        $date = $datetime[0];
        $time = $datetime[1];
        $procedure = Procedure::find($dp->procedure_id)->name;
        $physician = Physician::find($dp->physician_id)->user->name;
        $dp_obj = [
            'procedure' => $procedure,
            'procedure_id' => $dp->procedure_id, 
            'physician' => $physician,
            'physician_id' => $dp->physician_id,
            'url' => url('admin/assignprocedures'),
            'id' => $dp->id,
            'date' => $date,
            'time' => $time,
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
        $time = new \DateTime($request->time);
        DB::table('physician_procedure')
          ->where('id', $id)
          ->update([
            'procedure_id' => $request->procedure,
            'physician_id' => $request->physician,
            'time' => $request->date . " " . $time->format('H:i:s'),
        ]);
        $dp = DB::table('physician_procedure')->get();
        $dp_obj = $dp->map(function ($element){
            $datetime = new Carbon($element->time);
            $procedure = Procedure::find($element->procedure_id)->name;
            $physician = Physician::find($element->physician_id)->user->name;
            return [
                'procedure' => $procedure, 
                'physician' => $physician,
                'url' => url('admin/assignprocedures'),
                'id' => $element->id,
                'time' => $datetime->toDayDateTimeString()
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
        DB::table('physician_procedure')->where('id', $id)->delete();
        $dp = DB::table('physician_procedure')->get();
        $dp_obj = $dp->map(function ($element){
            $datetime = new Carbon($element->time);
            $procedure = Procedure::find($element->procedure_id)->name;
            $physician = Physician::find($element->physician_id)->user->name;
            return [
                'procedure' => $procedure, 
                'physician' => $physician,
                'url' => url('admin/assignprocedures'),
                'id' => $element->id,
                'time' => $datetime->toDayDateTimeString()
            ];
        });
        return response()->json($dp_obj);      
    }
}
