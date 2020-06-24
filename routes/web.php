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
Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('cekongkir', 'Frontend\OngkirController@index')->name('cekongkir');
Route::get('cekresi', 'Frontend\ResiController@index')->name('cekresi');
Route::get('news', 'Frontend\BlogController@index')->name('news');
Route::post('morenews', 'Frontend\BlogController@loadmore')->name('morenews');
Route::get('userlogin', 'Frontend\UserController@login')->name('userlogin');
Route::get('userregister', 'Frontend\UserController@register')->name('userregister');
Route::get('userreset', 'Frontend\UserController@resetpassword')->name('userreset');
Route::get('userforgot', 'Frontend\UserController@forgotpassword')->name('userforgot');
Route::get('read/{slug}/{id}', 'Frontend\BlogController@read')->name('read');
Route::get('login', 'Auth\LoginController@login')->name('login');

Route::post('login', 'Auth\LoginController@doLoginCms');
Route::get('logout', 'Auth\LoginController@doLogout')->name('logout');
Route::group(['middleware' => ['auth']], function () {
    
    Route::get('users/hapus/{id}', 'CMS\UserController@hapus');
    Route::resource('users', 'CMS\UserController');
    Route::post('users/postProcess', 'CMS\UserController@postProcess');

    ## ORDER
    Route::get('order/import', 'CMS\OrderController@import')->name('order.import');
    Route::post('order/importData', 'CMS\OrderController@importData')->name('order.importData');
    Route::resource('order', 'CMS\OrderController');
    Route::get('order/hapus/{id}', 'CMS\OrderController@hapus');
    Route::post('order/postProcess', 'CMS\OrderController@postProcess');

    ## ADDRESS
    Route::get('address/hapus/{id}', 'CMS\AddressController@hapus');
    Route::resource('address', 'CMS\AddressController');
    Route::post('address/postProcess', 'CMS\AddressController@postProcess');

    ## BLOG
    Route::get('blog/hapus/{id}', 'CMS\BlogController@hapus');
    Route::resource('blog', 'CMS\BlogController');
    Route::post('blog/postProcess', 'CMS\BlogController@postProcess');

    ## KOTA
    Route::get('kota/import', 'CMS\KotaController@import')->name('kota.import');
    Route::post('kota/importData', 'CMS\KotaController@importData')->name('kota.importData');
    Route::resource('kota', 'CMS\KotaController');
    Route::get('kota/hapus/{id}', 'CMS\KotaController@hapus');
    Route::post('kota/postProcess', 'CMS\KotaController@postProcess');

    ## CONFIGURATION
    Route::get('configuration', 'CMS\ConfigurationController@index' );
    Route::post('configuration', 'CMS\ConfigurationController@store' )->name('configuration.store');
    Route::patch('configuration/{id}', 'CMS\ConfigurationController@update')->name('configuration.update');

    ## IMAGE
    Route::resource('image', 'CMS\ImagesController');
    Route::get('image/hapus/{id}', 'CMS\ImagesController@hapus');
    Route::post('image/postProcess', 'CMS\ImagesController@postProcess');
    Route::get('imagepopup', 'CMS\ImagesController@imagepopup');
    Route::get('listtinymce', 'CMS\ImagesController@listtinymce');
    Route::get('addimagepopup', 'CMS\ImagesController@addimagepopup')->name('image.addimagepopup');
    Route::post('image/addimagepopuppost', 'CMS\ImagesController@addimagepopuppost')->name('image.addimagepopuppost');

    ## NEGARA
    Route::get('negara/hapus/{id}', 'CMS\NegaraController@hapus');
    Route::get('negara/import', 'CMS\NegaraController@import')->name('negara.import');
    Route::post('negara/importData', 'CMS\NegaraController@importData')->name('negara.importData');
    Route::resource('negara', 'CMS\NegaraController');
    Route::post('negara/postProcess', 'CMS\NegaraController@postProcess');

    ## WEBSERVICE
    Route::get('webservice/getListNegara', 'CMS\WebserviceController@getListNegara');
});