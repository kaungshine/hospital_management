<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Auth::routes();
Route::get('/home', function(){
	return redirect()->route('dashboard');
})->name('home');
Route::prefix('admin')->middleware('auth')->group(function () {

	Route::get('/', 'BackendController@dashboard')->name('dashboard'); // {{route('dashboard')}}

	Route::resource('appointments', 'AppointmentController');

	Route::resource('departments', 'DepartmentController');

	Route::resource('medications', 'MedicationController');

	Route::resource('nurses', 'NurseController');

	Route::resource('patients', 'PatientController');

	Route::resource('physicians', 'PhysicianController');

	Route::resource('prescribes', 'PrescribeController');

	Route::resource('procedures', 'ProcedureController');

	Route::resource('rooms', 'RoomController');

	Route::resource('stays', 'StayController');

	Route::resource('assignphysicians', 'AssignPhysicianController');

	Route::resource('assignprocedures', 'AssignProcedureController');

	Route::resource('assigndiseases', 'AssignDiseaseController');
});