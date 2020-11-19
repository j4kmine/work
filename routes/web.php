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


Route::post('login', 'Auth\LoginController@doLoginCms')->name('dologin');
Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@doRegisterCms')->name('doregister');
Route::get('register', 'Auth\RegisterController@register')->name('register');
Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/', function () {
        echo "welcome";
    });
});