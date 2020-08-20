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
Route::post('cekongkir', 'API\PriceController@cekongkir');
Route::post('cekharga', 'API\PriceController@index');
Route::post('listblog', 'API\BlogController@index');
Route::get('listkotanegara', 'API\KotaController@index');
Route::post('getkota', 'API\KotaController@getKota');
Route::post('getAddressByUser', 'API\AddressController@getAddressByUser');
Route::post('getAddressById', 'API\AddressController@getAddressById');
Route::get('userselect2', 'API\UsersController@userSelect2');
Route::post('getItemById', 'API\ItemController@getItemById');
Route::post('authlogin', 'API\UsersController@login');
Route::post('authregister', 'API\UsersController@register');
Route::post('hargalisting', 'API\PriceController@cekongkirnew');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
