<?php

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

Route::post('authenticate', 'AuthenticateController@authenticate');

Route::group(['middleware' => 'jwt.auth'], function()
{
    Route::get('user', 'UserController@show');
    Route::post('user/profile/update', 'UserController@updateProfile');
    Route::post('user/password/update', 'UserController@updatePassword');

    Route::get('rooms', 'RoomController@index');
    Route::post('rooms', 'RoomController@store');
    Route::get('rooms/{room}/messages', 'MessagesController@index');
    Route::post('rooms/{room}/messages', 'MessagesController@store');
    Route::get('subscriptions/{room}', 'SubscriptionController@store');
    Route::get('subscriptions', 'SubscriptionController@index');
    Route::delete('subscriptions/{room}', 'SubscriptionController@destroy');
});
