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

//Authentication
Route::post('v1/auth', 'AuthenticateController@authJwt');

//Users
Route::post('v1/users', 'UserController@store');
Route::group(['prefix' => 'v1/users', 'middleware' => 'jwt.auth'], function () {
    Route::get('{id}', 'UserController@show')->where('id', '[a-z0-9\-]+');
    Route::put('{id}', 'UserController@update');
    Route::delete('{id}', 'UserController@delete');
});

//Workout Types
Route::group(['prefix' => 'v1/workout_types', 'middleware' => 'jwt.auth'], function () {
    Route::post('/', 'WorkoutTypeController@store');
    Route::get('{id}', 'WorkoutTypeController@show');
    Route::put('{id}', 'WorkoutTypeController@update');
    Route::delete('{id}', 'WorkoutTypeController@delete');
});

//Workout Plans
Route::group(['prefix' => 'v1/workout_plans', 'middleware' => 'jwt.auth'], function () {
    Route::post('/', 'WorkoutPlanController@store');
    Route::get('{id}', 'WorkoutPlanController@workoutPlanByUser');
    Route::put('{id}', 'WorkoutPlanController@update');
    Route::delete('{id}', 'WorkoutPlanController@delete');
});