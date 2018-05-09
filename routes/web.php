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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('customer', 'CustomerController');
    Route::GET('searchCustomer', 'CustomerController@searchCustomer');
    Route::POST('addCustomer', 'CustomerController@addCustomer');
    Route::POST('editCustomer', 'CustomerController@editCustomer');
    Route::POST('deleteCustomer', 'CustomerController@deleteCustomer');
});
