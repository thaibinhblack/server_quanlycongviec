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
Route::get('token', 'UserController@checkToken')->middleware('cors');
Route::post('resignter', 'UserController@resignter')->middleware('cors');
Route::post('login', 'UserController@login')->middleware('cors');

