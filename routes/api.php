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

Route::post('auth/signin', 'AuthController@authenticate');
Route::post('oauth/signin', 'AuthController@loginOAuth');
Route::apiResource('products', 'ProductController');
Route::group(['middleware' => 'jwt'], function () {
    Route::get('auth/user', 'AuthController@user');
    Route::get('auth/logout', 'AuthController@logout');
});