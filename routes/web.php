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

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

        Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
        Route::resource('/category', 'App\Http\Controllers\CategoryController');
        Route::resource('/author', 'App\Http\Controllers\AuthorController');
        Route::resource('/book', 'App\Http\Controllers\BookController');
        Route::get('/user/profile', 'App\Http\Controllers\ProfileController@index')->name('profile.index');
        Route::get('/user/profile/FavouriteBooks/{user}','App\Http\Controllers\ProfileController@favouriteBooks')->name('user.getFavourite');
        Route::get('/user/profile/edit/{profile}', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
        Route::put('/user/profile/edit/{profile}', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
        Route::post('/user/profile/edit/{profile}', 'App\Http\Controllers\ProfileController@changePassword')->name('profile.password');
        Route::post('/user/addFavouriteBook/{book}','App\Http\Controllers\UserController@addFavourite')->name('user.addFavourite');
        Route::post('/user/deleteFavouriteBook/{book}','App\Http\Controllers\UserController@deleteFavourite')->name('user.deleteFavourite');
        Route::resource('/users','App\Http\Controllers\UserController');
        Route::resource('/order', 'App\Http\Controllers\OrderController');
        Route::get('/orders/create/{cart}', 'App\Http\Controllers\OrderController@create')->name('orders.create');
        Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
        Route::post('/cart', 'App\Http\Controllers\CartController@store')->name('cart.store');
        Route::post('/cart/edit/{cart}', 'App\Http\Controllers\CartController@updateItem')->name('cart.updateItem');
        Route::delete('/cart/{book}', 'App\Http\Controllers\CartController@destroy')->name('cart.delete');
        Route::resource('/role','App\Http\Controllers\RoleController');

    });
});
