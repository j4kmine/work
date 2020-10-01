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
Route::post('listblog', 'API\BlogController@index');
## kota
Route::get('listkotanegara', 'API\KotaController@index');
Route::post('getkota', 'API\KotaController@getKota');
Route::post('getkotabyid', 'API\KotaController@getDataById');
## address
Route::post('getaddressbyuser', 'API\AddressController@getAddressByUser');
Route::post('getaddressbyid', 'API\AddressController@getAddressById');
Route::get('listaddress', 'API\AddressController@listing');
Route::post('insertaddress', 'API\AddressController@store');
Route::post('updateaddress/{id}', 'API\AddressController@update');
Route::post('deleteaddress/{id}', 'API\AddressController@destroy');
## user
Route::get('userselect2', 'API\UsersController@userSelect2');
Route::post('authlogin', 'API\UsersController@login');
Route::post('authregister', 'API\UsersController@register');
Route::post('authregistercompany', 'API\UsersController@registercompany');
Route::post('aktivasi', 'API\UsersController@aktivasi');
## item
Route::post('getitembyid', 'API\ItemController@getItemById');
## barang jenis
Route::post('getbarangjenisbybarangkategori', 'API\BarangJenisController@getDataByBarangKategori');
Route::post('getbarangjenisbyid', 'API\BarangJenisController@getDataById');
## asuransi
Route::post('getasuransibybarangjenis', 'API\AsuransiController@getDataByBarangJenis');
Route::post('getasuransibyid', 'API\AsuransiController@getDataById');
## order
Route::get('listallorder', 'API\OrderController@listAllOrder');
Route::post('getorderbyid', 'API\OrderController@getOrderById');
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});