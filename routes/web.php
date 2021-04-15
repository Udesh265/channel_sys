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

    Route::get('appoitnment/view_appointment','AppointmentController@view_appointment')->name('appointment.view');

    Route::get('appointment/pay_online/{payment_id}','AppointmentController@pay_online')->name('online_payment');

    Route::get('lab_appointment/new','LabTestController@new_test_appointment')->name('lab.new_appointment');

    Route::get('lab/add_lab_report_types','LabTestController@add_lab_report_type')->name('lab.add_reports_type');

    Route::get('lab/lab_dashboard','LabTestController@laboraty_overview')->name('lab.overview');

    Route::get('lab/lab_report','LabTestController@laboraty_report')->name('lab.report');

    Route::get('appointment/rooms','RoomController@add_room')->name('appointment.add_rooms');

    Route::get('system/time','WorkingTimeController@add_time')->name('system.time');


    Route::get('emp/atteandance','EmployeeAttendanceController@mark_attendance')->name('employee.attendance');

    Route::get('appoitnment/waiting_online_payment','AppointmentController@waiting_online_payment')->name('appointment.waitpayment');

    Route::get('appointment/check_doctors','AppointmentController@check_doctors_avalable')->name('appointment.check_doc');

    Route::get('appointment/doc_appointment','AppointmentController@rep_doc_appointment')->name('cashier.doc_app');

    Route::get('appointment/view_all_app','AppointmentController@view_all_app')->name('appointment.view_all');

    Route::get('appointment/view_all_lab','AppointmentController@view_all_lab')->name('appointment.view_all_lab');








});

