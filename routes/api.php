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
    Route::post('assign_offline/user/{patient_id}','API\ApiPatientController@assign_user');
    Route::get('get_by_search/{search_keyword}','API\ApiPatientController@get_by_search');
    Route::patch('update/{id}','API\ApiPatientController@update');
    Route::patch('del/{id}','API\ApiPatientController@delete_patient');
    Route::post('addpatient_online','API\ApiPatientController@add_patient_online');
    Route::post('assign/user/{patient_id}','API\ApiPatientController@assign_user_online');
    Route::patch('bio_data/{patient_id}','API\ApiPatientController@submit_patient_biometric_data');
    Route::get('get_patient/{search_keyword}','API\ApiPatientController@get_patient_by_search');
    Route::post('add_bio_data','API\ApiPatientController@save_biometric_data');
    Route::get('get_biometric_data/{patient_id}','API\ApiPatientController@get_biometric_data_by_patientID');
    Route::post('add_treatment/{patient_id}','API\ApiPatientController@save_treatment_data');
    Route::get('get_treatment_data/{patient_id}','API\ApiPatientController@get_treatment_data_by_patient_id');
    Route::patch('update_treatment/{treatment_id}','API\ApiPatientController@update_treatment_record');
    Route::get('get_lab_report_data/{patient_id}','API\ApiPatientController@get_lab_report_data');

});


Route::group(['prefix' => 'doctor'], function () {
   Route::post('addspeciality','API\AddSpecialityController@add_speciality');
   Route::get('get_spec','API\AddSpecialityController@get_spec');
   Route::delete('del/{id}','API\AddSpecialityController@del_spec');
   Route::get('get_doc_list/{spec_id}','API\ApiDoctorController@get_doc_list_by_spec_id');
});

Route::group(['prefix' => 'lab'], function () {
    Route::post('add_report_type','API\ApiLabTestController@add_report_type');
    Route::get('get_all','API\ApiLabTestController@get_all_report_type');
    Route::patch('update/{id}','API\ApiLabTestController@update_report_type');
    Route::get('get_report_type','API\ApiLabTestController@get_report_type');
    Route::post('submit_appointment','API\ApiLabTestController@submit_appointment');
    Route::get('get_lab_appointment/{patient_id}','API\ApiLabTestController@get_lab_appointment');
    Route::get('get_lab_appointment_for_reception/{patient_id}','API\ApiLabTestController@get_lab_appointment_for_reception');
    Route::get('get_doc_appointment_for_reception/{patient_id}','API\ApiLabTestController@get_doc_appointment_for_reception');
    Route::patch('waiting_payment_paid/{app_id}','API\ApiLabTestController@waiting_payment_paid');

    Route::get('get_all_lab_appointment','API\ApiLabTestController@get_all_lab_appointment');





 });


Route::group(['prefix' => 'schedule'], function () {
   Route::post('save','API\ApiScheduleController@store');
   Route::get('get/{employee_id}','API\ApiScheduleController@get_schedule');
   Route::delete('del/{id}','API\ApiScheduleController@destroy');
   Route::get('get_one_schedule/{id}','API\ApiScheduleController@get_one_schedule');
   Route::get('get_by_room_id/{room_id}','API\ApiScheduleController@get_by_room_id');
});


Route::group(['prefix' => 'appointment'], function () {
    Route::get('get/{employee_id}','API\ApiAppointmentController@get_schedule_appointment');
    Route::post('submit_appointment','API\ApiAppointmentController@submit_appointment');
    Route::get('get_patient/{patient_id}','API\ApiAppointmentController@get_patient_by_user');
    Route::get('get_patient_by_userID/{user_id}','API\ApiAppointmentController@get_patient_by_userID');

    Route::get('get_app_by_userID/{user_id}','API\ApiAppointmentController@get_appoitment_by_userID');
    Route::get('get_tot_amount/{p_id}','API\ApiAppointmentController@get_app_total_amount');
    Route::get('get_pending_pay/{p_id}','API\ApiAppointmentController@get_pending_payment');
    Route::get('get_appointment_list/{p_id}','API\ApiAppointmentController@get_appointment_list');
    Route::patch('del/{id}','API\ApiAppointmentController@delete_appointment');
    Route::patch('del_lab_app/{id}','API\ApiAppointmentController@delete_lab_appointment');

    Route::patch('online_payment/{pay_id}','API\ApiPaymentController@submit_payment');

    Route::patch('waiting_payment_paid/{appointment_id}','API\ApiAppointmentController@waiting_payment_paid');

    Route::post('submit_regular_patient_appointment','API\ApiAppointmentController@submit_regular_patient_appointment');
    Route::patch('regular_doc_app_paid/{payment_id}','API\ApiPaymentController@submit_payment');
    Route::get('get_one_app_list_for_rep/{payment_id}','API\ApiAppointmentController@get_one_app_list_for_rep');

    Route::get('get_all_doc_appointment','API\ApiAppointmentController@get_all_doc_appointments');

    Route::get('get_all_doc_appointment_selected_date','API\ApiAppointmentController@get_all_doc_appointment_selected_date');

    Route::get('total_doc_app','API\ApiAppointmentController@total_doc_app');
    Route::get('total_lab_app','API\ApiAppointmentController@total_lab_app');
    Route::get('total_services_count','API\ApiAppointmentController@total_services_count');









});

Route::group(['prefix' => 'laboraty'], function () {
    Route::get('get_waiting_list','API\ApiLaboratyController@get_waiting_list');
    Route::patch('check_appointment/{id}','API\ApiLaboratyController@check_appointment');
    Route::get('get_processing_list','API\ApiLaboratyController@get_processing_list');
    Route::patch('checked_processing/{id}','API\ApiLaboratyController@checked_processing');
    Route::get('get_deliver_list','API\ApiLaboratyController@get_deliver_list');
    Route::post('upload_file','API\ApiLaboratyController@upload_file');
    Route::get('get_report_by_ducumentable_id/{id}','API\ApiLaboratyController@get_report_by_ducumentable_id');


 });

 Route::group(['prefix' => 'attendance'], function () {
    Route::post('workplace_time','API\ApiAttendanceController@save_time');
    Route::post('mark_attendance/{value}','API\ApiAttendanceController@mark_attendance');
 });

Route::post('add_room','API\ApiScheduleController@add_room');
Route::get('room_list','API\ApiScheduleController@room_list');


Route::post('add_service','API\ApiServiceController@add_service');
Route::get('get_service_list','API\ApiServiceController@get_service_list');

Route::apiResource('employee','API\ApiEmployeeController');

Route::get('joblist','API\ApiEmployeeController@job_list');

Route::apiResource('jobtype','API\ApiJobTypeController');

Route::post('submit_service','API\ApiServiceController@submit_service');
Route::patch('service_payment_confirm/{payment_id}','API\ApiServiceController@service_payment_confirm');

Route::get('get_all_payment_data','API\ApiPaymentController@get_all_payment_data');

