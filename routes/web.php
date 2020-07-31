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
Route::get("/notfound", function(){
    return View::make("frontend.pages.notfound.index");
 });
Route::get('cekongkir', 'Frontend\OngkirController@index')->name('cekongkir');
Route::get('activate', 'Frontend\UserController@activate')->name('activate');
Route::get('cekresi', 'Frontend\ResiController@index')->name('cekresi');
Route::get('news', 'Frontend\BlogController@index')->name('news');
Route::post('morenews', 'Frontend\BlogController@loadmore')->name('morenews');
Route::get('userlogin', 'Frontend\UserController@login')->name('userlogin');
Route::get('userregister', 'Frontend\UserController@register')->name('userregister');
Route::post('registeruser', 'Frontend\UserController@registeruser')->name('registeruser');
Route::get('userreset', 'Frontend\UserController@resetpassword')->name('userreset');
Route::get('userforgot', 'Frontend\UserController@forgotpassword')->name('userforgot');
Route::get('read/{slug}/{id}', 'Frontend\BlogController@read')->name('read');
Route::post('loginuser', 'Frontend\UserController@loginuser')->name('loginuser');
Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('login', 'Auth\LoginController@doLoginCms');
Route::post('forgotpasswordUser', 'Frontend\UserController@forgotpasswordUser')->name('forgotpasswordUser');
Route::post('resetpassworduser', 'Frontend\UserController@resetpassworduser')->name('resetpassworduser');
Route::post('subscibe', 'Frontend\UserController@subscibe')->name('subscibe');
Route::get('logout', 'Auth\LoginController@doLogout')->name('logout');
Route::group(['middleware' => ['auth']], function () {
    
    Route::get('users/hapus/{id}', 'CMS\UserController@hapus');
    Route::resource('users', 'CMS\UserController');
    Route::post('users/postProcess', 'CMS\UserController@postProcess');

    ## ORDER
    Route::get('order/hapus/{id}', 'CMS\OrderController@hapus');
    Route::resource('order', 'CMS\OrderController');
    Route::post('order/postProcess', 'CMS\OrderController@postProcess');

    ## ADDRESS
    Route::get('address/hapus/{id}', 'CMS\AddressController@hapus');
    Route::resource('address', 'CMS\AddressController');
    Route::post('address/postProcess', 'CMS\AddressController@postProcess');

    ## TRACKING
    Route::get('tracking/hapus/{id}', 'CMS\TrackingController@hapus');
    Route::resource('tracking', 'CMS\TrackingController');
    Route::post('tracking/postProcess', 'CMS\TrackingController@postProcess');
    
    ## ITEM
    Route::get('item/hapus/{id}', 'CMS\ItemController@hapus');
    Route::resource('item', 'CMS\ItemController');
    Route::post('item/postProcess', 'CMS\ItemController@postProcess');

    ## BARANG KATEOGRI
    Route::get('barangkategori/hapus/{id}', 'CMS\BarangKategoriController@hapus');
    Route::resource('barangkategori', 'CMS\BarangKategoriController');
    Route::post('barangkategori/postProcess', 'CMS\BarangKategoriController@postProcess');

    ## BARANG JENIS
    Route::get('barangjenis/hapus/{id}', 'CMS\BarangJenisController@hapus');
    Route::resource('barangjenis', 'CMS\BarangJenisController');
    Route::post('barangjenis/postProcess', 'CMS\BarangJenisController@postProcess');

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
    Route::get('webservice/getListOrder', 'CMS\WebserviceController@getListOrder');
});