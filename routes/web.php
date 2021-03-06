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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/scheduling', 'HomeController@index');

Route::post('/post-schedule', 'HomeController@postSchedule');

Route::patch('/edit-schedule', 'HomeController@editSchedule');

Route::delete('/delete-schedule/{date}', 'HomeController@deleteSchedule');