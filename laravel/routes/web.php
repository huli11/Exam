<?php

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


Route::get('/add', 'ExamController@add');
Route::post('/adds', 'ExamController@adds');
Route::get('/show', 'ExamController@show');
Route::get('/details', 'ExamController@details');
Route::get('/del', 'ExamController@del');
Route::get('/id_Number', 'ExamController@id_Number');


Route::get('/', function () {
    return view('welcome');
});
