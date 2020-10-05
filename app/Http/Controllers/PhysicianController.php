<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Physician;
use App\User;
use Illuminate\Support\Facades\Hash;

class PhysicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $physicians = Physician::all()->map(function ($physician){
            $physician['url'] = url("admin/physicians");
            $physician['user'] = User::find($physician->user_id);
            return $physician;
        });
        return view('backend.physicians.index', compact('physicians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.physicians.create');
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
        $user->assignRole('physician');

        $physician = new Physician;
        /* DB Column *//* Name = "?" */
        $physician->security_number = $request->input('ssn');
        $physician->position = $request->input('position');
        $user->physician()->save($physician);
        return redirect()->route('physicians.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Physician $physician)
    {
        //
        return view('backend.physicians.show', compact('physician'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Physician $physician)
    {
        $physician['url'] = url('admin/physicians');
        $physician['user'] = User::find($physician->user_id);
        return response()->json($physician);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Physician $physician)
    {
        //
        $physician->security_number = $request->input('ssn');
        $physician->position = $request->input('position');
        $physician->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        $physician->save();
        
        $physicians = Physician::all()->map(function ($physician){
            $physician['url'] = url("admin/physicians");
            $physician['user'] = User::find($physician->user_id);
            return $physician;
        });
        return response()->json($physicians);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Physician $physician)
    {
        $physician->delete();
        $physicians = Physician::all()->map(function ($physician){
            $physician['url'] = url("admin/physicians");
            $physician['user'] = User::find($physician->user_id);
            return $physician;
        });
        return response()->json($physicians);
    }
}
