<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('role', 'API\ApiRoleController');
Route::get('role/get/user/{user}', 'API\ApiRoleController@getRolesBasedOnPermission')->name('role.userbased.list');

Route::apiResource('permissions', 'API\ApiPermissionController');
Route::get('permissions/role/{id}', 'API\ApiPermissionController@permission_per_role');


Route::prefix('user')->group(function () {
    Route::get('profile', 'API\ApiUserController@profile')->name('user.profile');
    Route::patch('update/profile/picture/{id}', 'API\ApiUserController@update_profile_pic')->name('user.profile.pic.update');
    Route::post('assign','API\ApiUserController@assign_emp')->name('user.assign.emp');
});
Route::apiResource('user', 'API\ApiUserController');

Route::group(['prefix' => 'employee'], function () {

    Route::get('search/{keyword}','API\ApiEmployeeController@search_all_emp');
    Route::get('all','API\ApiEmployeeController@all_emp_data');
    Route::patch('del/{id}','API\ApiEmployeeController@del_emp');
    Route::patch('update/{id}','API\ApiEmployeeController@update_emp');
    Route::get('getone/{id}','API\ApiEmployeeController@get_one_employee');
    // Route:get('');

});

Route::group(['prefix' => 'patient'], function () {

    Route::post('addpatient','API\ApiPatientController@add_patient');
    Route::get('get_all','API\ApiPatientController@get_all_patient');
    Route::post('assign/user/{patient_id}','API\ApiPatientController@assign_user');
    Route::get('get_by_search/{search_keyword}','API\ApiPatientController@get_by_search');
    Route::patch('update/{id}','API\ApiPatientController@update');
    Route::patch('del/{id}','API\ApiPatientController@delete_patient');
    Route::post('addpatient_online','API\ApiPatientController@add_patient_online');
    Route::post('assign/user/{patient_id}','API\ApiPatientController@assign_user_online');


});

Route::group(['prefix' => 'doctor'], function () {
   Route::post('addspeciality','API\AddSpecialityController@add_speciality');
   Route::get('get_spec','API\AddSpecialityController@get_spec');
   Route::delete('del/{id}','API\AddSpecialityController@del_spec');
   Route::get('get_doc_list/{spec_id}','API\ApiDoctorController@get_doc_list_by_spec_id');
});

Route::group(['prefix' => 'schedule'], function () {
   Route::post('save','API\ApiScheduleController@store');
   Route::get('get/{employee_id}','API\ApiScheduleController@get_schedule');
   Route::delete('del/{id}','API\ApiScheduleController@destroy');
   Route::get('get_one_schedule/{id}','API\ApiScheduleController@get_one_schedule');
});


Route::group(['prefix' => 'appointment'], function () {
    Route::get('get/{employee_id}','API\ApiAppointmentController@get_schedule_appointment');
    Route::post('submit_appointment','API\ApiAppointmentController@submit_appointment');
    Route::get('get_patient/{user_id}','API\ApiAppointmentController@get_patient_by_user');
    Route::get('get_app_by_userID/{user_id}','API\ApiAppointmentController@get_appoitment_by_userID');
    Route::get('get_tot_amount/{p_id}','API\ApiAppointmentController@get_app_total_amount');
    Route::get('get_pending_pay/{p_id}','API\ApiAppointmentController@get_pending_payment');
    Route::get('get_appointment_list/{p_id}','API\ApiAppointmentController@get_appointment_list');
    Route::patch('del/{id}','API\ApiAppointmentController@delete_appointment');
    Route::patch('online_payment/{pay_id}','API\ApiPaymentController@submit_payment');
});

Route::apiResource('employee','API\ApiEmployeeController');

Route::get('joblist','API\ApiEmployeeController@job_list');

Route::apiResource('jobtype','API\ApiJobTypeController');



