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
Route::get('login', 'Auth\LoginController@login')->name('login');
// Route::get('login',array('as'=>'login',function(){
//     return view('cms/pages/users/login');
// }));
Route::post('login', 'Auth\LoginController@doLoginCms');
Route::get('logout', 'Auth\LoginController@doLogout')->name('logout');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('templatecms');
    });
    Route::get('users/hapus/{id}', 'CMS\UserController@hapus');
    Route::resource('users', 'CMS\UserController');
    Route::post('users/postProcess', 'CMS\UserController@postProcess');


    ## BLOG
    Route::get('blog/hapus/{id}', 'CMS\BlogController@hapus');
    Route::resource('blog', 'CMS\BlogController');
    Route::post('blog/postProcess', 'CMS\BlogController@postProcess');

    Route::get('configuration', 'CMS\ConfigurationController@index' );
    Route::post('configuration', 'CMS\ConfigurationController@store' )->name('configuration.store');
    Route::patch('configuration/{id}', 'CMS\ConfigurationController@update')->name('configuration.update');

});