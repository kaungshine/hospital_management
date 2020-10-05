<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Physician;
use App\Nurse;
use App\Room;
use App\Department;
use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    //
    public function __construct(){
    	$patient_count = Patient::all()->count();
        $physician_count = Physician::all()->count();
        $nurse_count = Nurse::all()->count();
        $room_count = Room::all()->count();
        $department_count = Department::all()->count();
        View::share('count', [
            'patient_count' => $patient_count,
            'physician_count' => $physician_count,
            'nurse_count' => $nurse_count,
            'room_count' => $room_count,
            'department_count' => $department_count
        ]);
    }
    public function dashboard(){
    	return view('backend.dashboard');
    }
}
