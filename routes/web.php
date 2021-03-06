<?php

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
    return view('welcome');
});

Route::resource('/keahlian', 'SpecialistController')->except('create', 'show');

Route::resource('/dokter', 'DoctorController');
Route::resource('/pasien', 'PatientController');
Route::resource('/kasur', 'SeatController')->except('create', 'show');
Route::resource('/pegawai', 'EmployeeController');
Route::resource('/test', 'TestController');