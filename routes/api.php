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

/**
 * Authorize routes
 */
Route::post('auth/signin', 'AuthController@authenticate');
Route::post('auth/otp', 'AuthController@otp');
Route::post('oauth/signin', 'AuthController@loginOAuth');
Route::post('pusherAuthorize', 'PusherController@auth');

/**
 * Public routes
 */
Route::get('products', 'ProductController@index');
Route::get('product_detail', 'ProductController@show');
Route::get('filters', 'ProductController@filters');

/**
 * Private routes
 */
Route::group(['middleware' => 'jwt'], function () {


    
    Route::post('subscriptions', 'SubscriptionController@update');
    Route::post('subscriptions/delete', 'SubscriptionController@destroy');
    Route::get('auth/user', 'AuthController@user');
    Route::get('auth/logout', 'AuthController@logout');
});