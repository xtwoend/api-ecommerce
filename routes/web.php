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

Route::get('oauth/{provider}', 'Api\AuthController@redirectToProvider');
Route::get('oauth/{provider}/callback', 'Api\AuthController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});
