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

});

Route::apiResource('employee','API\ApiEmployeeController');

Route::get('joblist','API\ApiEmployeeController@job_list');

Route::apiResource('jobtype','API\ApiJobTypeController');



