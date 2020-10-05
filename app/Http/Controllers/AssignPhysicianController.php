<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Physician;
use App\Department;
use App\User;
use Illuminate\Support\Facades\DB;

class AssignPhysicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dp = DB::table('department_physician')->get();
        $dp_obj = $dp->map(function ($element){
            $department = Department::find($element->department_id)->name;
            $physician = Physician::find($element->physician_id)->user->name;
            return [
                'department' => $department, 
                'physician' => $physician,
                'url' => url('admin/assignphysicians'),
                'id' => $element->id,
            ];
        });
        $physicians = Physician::all();
        $departments = Department::all();
        return view('backend.assignphysicians.index', compact('dp_obj', 'departments', 'physicians'));
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $physicians = Physician::all();
        $departments = Department::all();
        return view('backend.assignphysicians.create', compact('physicians', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $physician = Physician::find($request->physician);
        $physician->departments()->attach($request->department);

        //Redirect
        return redirect()->route('assignphysicians.index')->with('status', 'stored');
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
        $dp = DB::table('department_physician')->where('id', $id)->first();
        $department = Department::find($dp->department_id)->name;
        $physician = Physician::find($dp->physician_id)->user->name;
        $dp_obj = [
            'department' => $department,
            'department_id' => $dp->department_id, 
            'physician' => $physician,
            'physician_id' => $dp->physician_id,
            'url' => url('admin/assignphysicians'),
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
        // $arr = [1 , 2, 3]=>map(function(element) { return element + 1 }
        // $arr = [2, 3, 4]    
        DB::table('department_physician')
          ->where('id', $id)
          ->update([
            'department_id' => $request->department,
            'physician_id' => $request->physician,
        ]);
        $dp = DB::table('department_physician')->get();
        $dp_obj = $dp->map(function ($element){
            $department = Department::find($element->department_id)->name;
            $physician = Physician::find($element->physician_id)->user->name;
            return [
                'department' => $department, 
                'physician' => $physician,
                'url' => url('admin/assignphysicians'),
                'id' => $element->id,
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
        DB::table('department_physician')->where('id', $id)->delete();
        $dp = DB::table('department_physician')->get();
        $dp_obj = $dp->map(function ($element){
            $department = Department::find($element->department_id)->name;
            $physician = Physician::find($element->physician_id)->user->name;
            return [
                'department' => $department, 
                'physician' => $physician,
                'url' => url('admin/assignphysicians'),
                'id' => $element->id,
            ];
        });
        return response()->json($dp_obj);
    }
}
