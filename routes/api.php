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
Route::post('auth/admin/login', 'Admin\LoginController@login');



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

    Route::post('quantity', 'LocationController@quantityLocation');
});

/**
 * Device API
 */
Route::group(['prefix' => 'device', 'middleware' => 'auth:api'], function () {
    Route::get('all', 'DeviceController@showDeviceAll');
    Route::get('id/{id}', 'DeviceController@showDevice');
    Route::get('name/{name}', 'DeviceController@showDeviceId');
    Route::get('edit/{id}', 'DeviceController@editDevice');
    Route::patch('update/{id}', 'DeviceController@updateDevice');

    Route::post('updatejson', 'DeviceController@updateDeviceJson');

    Route::post('add', 'DeviceController@storeDevice');
    Route::delete('delete/{id}', 'DeviceController@destroyDevice');

    Route::get('allDeviceId', 'DeviceController@getDevice');
    Route::get('addedDeviceId', 'DeviceController@getAddedDevice');
    Route::get('availiableDeviceId', 'DeviceController@getAvailiableDevice');
});

/**
 * Status API
 */
Route::group(['prefix' => 'status', 'middleware' => 'auth:api'], function () {
    Route::get('all', 'StatusController@showStatusAll');
    Route::get('added', 'StatusController@showStatusAdded');
    Route::get('id/{id}', 'StatusController@showStatus');
    Route::get('edit/{id}', 'StatusController@editStatus');
    Route::patch('update/{id}', 'StatusController@updateStatus');
    Route::post('add', 'StatusController@storeStatus');
    Route::delete('delete/{id}', 'StatusController@destroyStatus');
});

/**
 * Rfid API
 */
Route::group(['prefix' => 'rfid', 'middleware' => 'auth:api'], function () {
    Route::get('all', 'RfidController@showRfidAll');
    Route::get('id/{id}', 'RfidController@showRfid');
    Route::patch('update/{id}', 'RfidController@updateRfid');

    Route::post('updatejson', 'RfidController@updateRfidJson');

    Route::post('add', 'RfidController@storeRfid');
    Route::delete('delete/{id}', 'RfidController@destroyRfid');

    Route::get('allDeviceId', 'RfidController@getRfid');
    Route::get('addedDeviceId', 'RfidController@getAddedRfid');
    Route::get('availiableDeviceId', 'RfidController@getAvailiableRfid');
});

