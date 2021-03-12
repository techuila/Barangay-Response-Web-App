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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Server Alive */
Route::get('alive', 'AliveController@index');

// List articles 
Route::get('articles', 'ArticleController@index');
Route::get('article/{id}', 'ArticleController@show');
Route::post('article', 'ArticleController@store');
Route::put('article', 'ArticleController@store');
Route::delete('article/{id}', 'ArticleController@destroy');

/* List Location */
Route::get('locations', 'LocationController@index');
Route::get('location/{id}', 'LocationController@show');
Route::post('location', 'LocationController@store');
Route::put('location', 'LocationController@store');
Route::delete('location/{id}', 'LocationController@destroy');

/* Settings */
Route::get('settings', 'SettingController@index');
Route::put('settings/{id}', 'SettingController@update');

/* Users */
Route::get('users', 'ClientController@index');
Route::get('user/{id}', 'ClientController@show');
Route::post('user', 'ClientController@store');
Route::put('user', 'ClientController@store');
Route::delete('user/{id}', 'ClientController@destroy');

/* Sms */
Route::get('sms', 'SmsController@store');
Route::get('sms/{id}', 'SmsController@show');
Route::post('sms', 'SmsController@store');
Route::put('sms', 'SmsController@store');
Route::delete('sms/{id}', 'SmsController@destroy');