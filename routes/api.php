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
## price
Route::post('cekongkir', 'API\PriceController@cekongkir');
Route::post('cekharga', 'API\PriceController@index');
Route::post('hargalisting', 'API\PriceController@cekongkirnew');
## blog
Route::get('listallblog', 'API\BlogController@listing');
Route::post('listblog', 'API\BlogController@index');
Route::post('detailblog', 'API\BlogController@detail');
Route::post('insertblog', 'API\BlogController@store');
Route::post('updateblog/{id}', 'API\BlogController@update');
Route::post('deleteblog/{id}', 'API\BlogController@destroy');
## kota
Route::get('listkotanegara', 'API\KotaController@index');
Route::post('getkota', 'API\KotaController@getKota');
Route::post('getkotabyid', 'API\KotaController@getDataById');
Route::post('insertkota', 'API\KotaController@store');
Route::post('updatekota/{id}', 'API\KotaController@update');
Route::post('deletekota/{id}', 'API\KotaController@destroy');
## negara
Route::post('listnegara', 'API\NegaraController@index');
Route::post('insertnegara', 'API\NegaraController@store');
Route::post('updatenegara/{id}', 'API\NegaraController@update');
Route::post('deletenegara/{id}', 'API\NegaraController@destroy');
## address
Route::post('getaddressbyuser', 'API\AddressController@getAddressByUser');
Route::get('getaddressbyid/{id}', 'API\AddressController@getAddressById');
Route::get('listaddress', 'API\AddressController@listing');
Route::post('insertaddress', 'API\AddressController@store');
Route::post('updateaddress', 'API\AddressController@update');
Route::post('deleteaddress/{id}', 'API\AddressController@destroy');
## user
Route::get('userselect2', 'API\UsersController@userSelect2');
Route::post('authlogin', 'API\UsersController@login');
Route::post('authregister', 'API\UsersController@register');
Route::post('authregistercompany', 'API\UsersController@registercompany');
Route::post('aktivasi', 'API\UsersController@aktivasi');
## item
Route::post('getitembyid', 'API\ItemController@getItemById');
Route::post('insertitem', 'API\ItemController@store');
Route::post('updateitem/{id}', 'API\ItemController@update');
Route::post('deleteitem/{id}', 'API\ItemController@destroy');
## barang jenis
Route::post('getbarangjenisbybarangkategori', 'API\BarangJenisController@getDataByBarangKategori');
Route::post('getbarangjenisbyid', 'API\BarangJenisController@getDataById');
Route::post('insertbarangjenis', 'API\BarangJenisController@store');
Route::post('updatebarangjenis/{id}', 'API\BarangJenisController@update');
Route::post('deletebarangjenis/{id}', 'API\BarangJenisController@destroy');
## barang kategori
Route::post('listbarangkategori', 'API\BarangKategoriController@index');
Route::post('insertbarangkategori', 'API\BarangKategoriController@store');
Route::post('updatebarangkategori/{id}', 'API\BarangKategoriController@update');
Route::post('deletebarangkategori/{id}', 'API\BarangKategoriController@destroy');
## barang package
Route::post('listbarangpackage', 'API\BarangPackageController@index');
Route::post('insertbarangpackage', 'API\BarangPackageController@store');
Route::post('updatebarangpackage/{id}', 'API\BarangPackageController@update');
Route::post('deletebarangpackage/{id}', 'API\BarangPackageController@destroy');
## fob
Route::post('listfob', 'API\FobController@index');
Route::post('insertfob', 'API\FobController@store');
Route::post('updatefob/{id}', 'API\FobController@update');
Route::post('deletefob/{id}', 'API\FobController@destroy');
## asuransi
Route::post('getasuransibybarangjenis', 'API\AsuransiController@getDataByBarangJenis');
Route::post('getasuransibyid', 'API\AsuransiController@getDataById');
Route::post('insertasuransi', 'API\AsuransiController@store');
Route::post('updateasuransi/{id}', 'API\AsuransiController@update');
Route::post('deleteasuransi/{id}', 'API\AsuransiController@destroy');
## order
Route::get('listallorder', 'API\OrderController@listAllOrder');
Route::post('getorderbyid', 'API\OrderController@getOrderById');
Route::post('orderselect2', 'API\OrderController@select2');
Route::post('insertorder', 'API\OrderController@store');
Route::post('updateorder/{id}', 'API\OrderController@update');
Route::post('deleteorder/{id}', 'API\OrderController@destroy');
## tracking
Route::get('listtracking', 'API\TrackingController@listing');
Route::post('detailtracking', 'API\TrackingController@detail');
Route::post('inserttracking', 'API\TrackingController@store');
Route::post('updatetracking/{id}', 'API\TrackingController@update');
Route::post('deletetracking/{id}', 'API\TrackingController@destroy');
## contactus
Route::post('sendcontactus', 'API\ContactusController@send');
## iklan
Route::get('listiklan', 'API\IklanController@listing');
Route::post('detailiklan', 'API\IklanController@getIklanById');
Route::post('insertiklan', 'API\IklanController@store');
Route::post('updateiklan/{id}', 'API\IklanController@update');
Route::post('deleteiklan/{id}', 'API\IklanController@destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});