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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Administration Routes

Route::resource('/products', 'ProductsController');
Route::resource('/suppliers', 'SupplierController');
Route::resource('/customers', 'CustomerController');
Route::resource('/orders', 'OrdersController');
Route::resource('/transactions', 'TransactionController');
Route::resource('/expenses', 'ExpensesController');
Route::resource('/restock', 'RestockController');

//Cart
Route::get('/cart/{id}', 'CartController@getCart');
Route::get('/cart/ordered/{id}', 'CartController@setOrdered');
Route::post('/cart', 'CartController@store');
Route::delete('/cart/remove', 'CartController@removeItem');
Route::get('/cart/count/{id}', 'CartController@getCartCount');
Route::get('/checkout/{id}', 'CartController@checkout');
Route::delete('/cart/{id}', 'CartController@destroy');

//Restock
Route::get('/restock/owner/checkout', 'RestockController@checkout');
Route::get('/restock/owner/complete/{id}', 'RestockController@complete');

Route::get('/shop/{id}', 'OrdersController@shop')->name('orders.shop');
Route::get('/product/{id}', 'ProductsController@getProduct');

//Store Routes
Route::get('/settings', 'SettingController@index')->name('settings.index');
Route::resource('/category', 'CategoryController');
Route::resource('/profile', 'ProfileController');

//Deposit Routes
route::post('/deposit', 'DepositController@store')->name('deposit.store');

//Reports Route
Route::get('/reports/all', 'ReportsController@orders');

//Invoice
Route::get('/transaction/invoice/{id}', 'InvoiceController@invoice');


