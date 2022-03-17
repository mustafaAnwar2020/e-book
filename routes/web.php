<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('cart', 'App\Http\Controllers\cartController@index')->name('cart');

Auth::routes();

// Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

// });

Route::resource('/category','App\Http\Controllers\CategoryController');
Route::resource('/author', 'App\Http\Controllers\AuthorController');
Route::resource('/book','App\Http\Controllers\BookController');
Route::get('/user/profile','App\Http\Controllers\ProfileController@index')->name('profile.index');
Route::get('/user/profile/edit/{profile}','App\Http\Controllers\ProfileController@edit')->name('profile.edit');
Route::put('/user/profile/edit/{profile}','App\Http\Controllers\ProfileController@update')->name('profile.update');
Route::post('/user/profile/edit/{profile}','App\Http\Controllers\ProfileController@changePassword')->name('profile.password');
Route::get('/order/cart','App\Http\Controllers\OrderController@cart')->name('order.cart');
Route::get('/client/{user}/orders/edit/{order}','App\Http\Controllers\OrderController@edit')->name('orders.edit');
Route::put('/client/{user}/orders/edit/{order}','App\Http\Controllers\OrderController@update')->name('orders.update');
Route::resource('/order','App\Http\Controllers\OrderController');
