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

    Route::resource('employee', 'EmployeeController');

    Route::resource('jobtype', 'JobTypeController');




});

