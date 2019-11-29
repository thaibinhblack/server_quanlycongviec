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
Route::post('group_user', 'NhomController@store')->middleware('cors');