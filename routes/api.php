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
Route::get('user-giaoviec','UserController@giaoviec')->middleware('cors');
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
Route::post('customer_search','CustomerController@search')->middleware('cors');

//trung tâm
Route::get('trung-tam','TrungTamController@index')->middleware('cors');
Route::post('trung-tam','TrungTamController@store')->middleware('cors');

// loại dự án
Route::get('loai-du-an','LoaiDuANController@index')->middleware('cors');
Route::post('loai-du-an','LoaiDuANController@store')->middleware('cors');
Route::post('loai-du-an/{id}','LoaiDuANController@update')->middleware('cors');

// dự án
Route::get('du-an','DuAnController@index')->middleware('cors');
Route::post('du-an','DuAnController@store')->middleware('cors');
Route::post('du-an/{id}','DuAnController@update')->middleware('cors');

// dự án khách hàng
Route::get("du-an-kh",'DuAnKhachHangController@index')->middleware('cors');
Route::get("du-an-kh/{id}",'DuAnKhachHangController@show')->middleware('cors');
Route::post("du-an-kh",'DuAnKhachHangController@store')->middleware('cors');
Route::post("du-an-kh/{id}",'DuAnKhachHangController@update')->middleware('cors');
// nhân viên tham gia dự án
Route::get('nhanvien-da','DuAnKhachHangController@nhanvien_duan')->middleware('cors');
Route::get('quyen-nhanvien-da','DuAnKhachHangController@show_quyen_thanhvien')->middleware('cors');
Route::post('nhanvien-da','DuAnKhachHangController@themthanhvien')->middleware('cors');
Route::post('cap-nhat-quyen-thanhvien','DuAnKhachHangController@update_quyen_thanhvien')->middleware('cors');
//cong viec
Route::get('cong-viec','CongViecController@index')->middleware('cors');
Route::post('capnhat_congviec/{id}','CongViecController@capnhat_congviec')->middleware('cors');
Route::post('cong-viec','CongViecController@store')->middleware('cors');
Route::get('cong-viec/{id}','CongViecController@show')->middleware('cors');
Route::post('cong-viec/{id}','CongViecController@update')->middleware('cors');

//cong việc dự án
Route::post('cong-viec-da','CongViecController@chitiet')->middleware('cors');
// loại công việc
Route::get('loai-cv','LoaiCongViecController@index')->middleware('cors');
Route::post('loai-cv','LoaiCongViecController@store')->middleware('cors');
Route::post('loai-cv/{id}','LoaiCongViecController@update')->middleware('cors');