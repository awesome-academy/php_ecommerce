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
Route::get('/user/profile', 'User\UserController@index')->name('user.profile');
Route::post('/user/profile', 'User\UserController@update')->name('user.update');

Route::get('/shop', 'ShopController@index')->name('shop.index');

Auth::routes();
