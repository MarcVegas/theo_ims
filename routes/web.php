<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Administration Routes

Route::resource('/products', 'ProductsController');
Route::resource('/suppliers', 'SupplierController');
Route::resource('/customers', 'CustomerController');
Route::resource('/orders', 'OrdersController');
Route::resource('/transactions', 'TransactionController');

//Store Routes
Route::get('/settings', 'SettingController@index')->name('settings.index');
Route::resource('/category', 'CategoryController');
Route::resource('/profile', 'ProfileController');


