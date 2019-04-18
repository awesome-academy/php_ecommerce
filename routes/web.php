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

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/user/profile', function () {
    return "user.profile";
})->name('user.profile');

Route::get('/shop', 'ShopController@index')->name('shop.index');

Auth::routes();
