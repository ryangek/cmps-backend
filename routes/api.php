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

Route::post('auth/login', 'Auth\LoginController@login');


/**
 * User API
 */
Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function () {
    Route::get('all', 'UserController@showUserAll');
    Route::get('id/{id}', 'UserController@showUser');
    Route::get('edit/{id}', 'UserController@editUser');
    Route::patch('update/{id}', 'UserController@updateUser');
    Route::post('add', 'UserController@storeUser');
    Route::delete('delete/{id}', 'UserController@destroyUser');
});

/**
 * Location API
 */
Route::group(['prefix' => 'locate', 'middleware' => 'auth:api'], function () {
    Route::get('all', 'LocationController@showLocationAll');
    Route::get('id/{id}', 'LocationController@showLocation');
    Route::get('edit/{id}', 'LocationController@editLocation');
    Route::patch('update/{id}', 'LocationController@updateLocation');
    Route::post('add', 'LocationController@storeLocation');
    Route::delete('delete/{id}', 'LocationController@destroyLocation');
});

/**
 * ParkSpace API
 */
Route::group(['prefix' => 'park', 'middleware' => 'auth:api'], function () {
    Route::get('all', 'ParkSpaceController@showParkSpaceAll');
    Route::get('id/{id}', 'ParkSpaceController@showParkSpace');
    Route::get('edit/{id}', 'ParkSpaceController@editParkSpace');
    Route::patch('update/{id}', 'ParkSpaceController@updateParkSpace');
    Route::post('add', 'ParkSpaceController@storeParkSpace');
    Route::delete('delete/{id}', 'ParkSpaceController@destroyParkSpace');
});

/**
 * Device API
 */
Route::group(['prefix' => 'device', 'middleware' => 'auth:api'], function () {
    Route::get('all', 'DeviceController@showDeviceAll');
    Route::get('id/{id}', 'DeviceController@showDevice');
    Route::get('edit/{id}', 'DeviceController@editDevice');
    Route::patch('update/{id}', 'DeviceController@updateDevice');
    Route::post('add', 'DeviceController@storeDevice');
    Route::delete('delete/{id}', 'DeviceController@destroyDevice');
});

/**
 * Status API
 */
Route::group(['prefix' => 'status', 'middleware' => 'auth:api'], function () {
    Route::get('all', 'StatusController@showStatusAll');
    Route::get('id/{id}', 'StatusController@showStatus');
    Route::get('edit/{id}', 'StatusController@editStatus');
    Route::patch('update/{id}', 'StatusController@updateStatus');
    Route::post('add', 'StatusController@storeStatus');
    Route::delete('delete/{id}', 'StatusController@destroyStatus');
});

