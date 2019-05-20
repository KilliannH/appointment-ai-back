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


Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('/appointments', [
        'uses' => 'AppointmentController@getAppointments'
    ]);

    Route::get('/appointments/{id}', [
        'uses' => 'AppointmentController@getAppointment'
    ]);

    Route::post('/appointments', [
        'uses' => 'AppointmentController@postAppointment'
    ]);

    Route::put('/appointments/{id}', [
        'uses' => 'AppointmentController@putAppointment'
    ]);

    Route::delete('/appointments/{id}', [
        'uses' => 'AppointmentController@deleteAppointment'
    ]);
});

// AUTH

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');