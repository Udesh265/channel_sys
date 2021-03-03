<?php

use Illuminate\Routing\RouteGroup;
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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('user/profile' , 'UserController@profile')->name('user.show.profile');
    Route::resource('user', 'UserController');
    Route::resource('permission', 'PermissionController');

    Route::get('emp_manage','EmployeeController@manage_emp')->name('employee.manage_emp');
    Route::resource('employee', 'EmployeeController');

    Route::resource('jobtype', 'JobTypeController');

    Route::get('patient/add_patient','PatientController@add_patient')->name('patient.add_patient');
    Route::get('patient/manage','PatientController@manage_patient')->name('patient.manage_patient');

    Route::get('schedule/add_schedule','ScheduleController@add_schedule')->name('schedule.add_schedule');

    Route::get('doctor/add_speciality','AddSpecialityController@add_speciality')->name('doctor.speciality');

    Route::get('appoitnment/new_appointment','AppointmentController@new_appointment')->name('appointment.create');




});

