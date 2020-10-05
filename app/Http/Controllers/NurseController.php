<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nurse;
use App\User;
use Illuminate\Support\Facades\Hash;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nurses = Nurse::all()->map(function ($nurse){
            $nurse['url'] = url("admin/nurses");
            $nurse['user'] = User::find($nurse->user_id);
            return $nurse;
        });
        return view('backend.nurses.index', compact('nurses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.nurses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->input('name'), 
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        $user->save();
        $user->assignRole('nurse');

        $nurse = new Nurse;
        /* DB Column *//* Name = "?" */
        $nurse->security_number = $request->input('ssn');
        $nurse->position = $request->input('position');
        $user->nurse()->save($nurse);
        return redirect()->route('nurses.index');
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
    public function edit(Nurse $nurse)
    {
        $nurse['url'] = url('admin/nurses');
        $nurse['user'] = User::find($nurse->user_id);
        return response()->json($nurse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nurse $nurse)
    {
        //
        $nurse->security_number = $request->input('ssn');
        $nurse->position = $request->input('position');
        $nurse->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        $nurse->save();
        
        $nurses = Nurse::all()->map(function ($nurse){
            $nurse['url'] = url("admin/nurses");
            $nurse['user'] = User::find($nurse->user_id);
            return $nurse;
        });
        return response()->json($nurses);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nurse $nurse)
    {
        $nurse->delete();
        $nurses = Nurse::all()->map(function ($nurse){
            $nurse['url'] = url("admin/nurses");
            $nurse['user'] = User::find($nurse->user_id);
            return $nurse;
        });
        return response()->json($nurses);
    }
}
