<?php

use Illuminate\Http\Request;

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
//user
Route::get('user','UserController@index')->middleware('cors');
Route::post('user/{id}','UserController@update')->middleware('cors');
Route::get('token', 'UserController@token')->middleware('cors');
Route::post('resignter', 'UserController@resignter')->middleware('cors');
Route::post('login', 'UserController@login')->middleware('cors');

//function
Route::get('functions','FunctionController@index')->middleware('cors');
Route::post('function','FunctionController@store')->middleware('cors');

//function user

Route::get('function_user','FunctrionUserController@index')->middleware('cors');
Route::post('function_user','FunctrionUserController@store')->middleware('cors');

//group
Route::get('group_user', 'NhomController@index')->middleware('cors');
Route::get('group_user/{id}','NhomController@show')->middleware('cors');
Route::post('group_user', 'NhomController@store')->middleware('cors');
Route::post('group_user/{id}', 'NhomController@update')->middleware('cors');

//customers

Route::get('customers','CustomerController@index')->middleware('cors');
Route::post('customer','CustomerController@store')->middleware('cors');
Route::post('customer/{id}','CustomerController@update')->middleware('cors');

//trung tâm
Route::get('trung-tam','TrungTamController@index')->middleware('cors');
Route::post('trung-tam','TrungTamController@store')->middleware('cors');

//loại dự án
Route::get('loai-du-an','LoaiDuANController@index')->middleware('cors');
Route::post('loai-du-an','LoaiDuANController@store')->middleware('cors');
Route::post('loai-du-an/{id}','LoaiDuANController@update')->middleware('cors');

// dự án
Route::get("du-an",'DuAnController@index')->middleware('cors');
Route::post("du-an",'DuAnController@store')->middleware('cors');
Route::post("du-an/{id}",'DuAnController@update')->middleware('cors');

//cong viec

Route::post('cong-viec','CongViecController@store')->middleware('cors');