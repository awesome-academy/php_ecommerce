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

Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    Route::get('profile', 'UserController@index')->name('user.profile');
    Route::post('profile', 'UserController@update')->name('user.update');
    Route::post('suggest', 'UserController@requestProduct')->name('user.request');
    Route::get('detail/{id}', 'UserController@getDetailOrder')->name('user.detail');
});

Route::group(['prefix' => 'notifications', 'namespace' => 'Web'], function () {
    Route::get('marks', 'NotificationController@markAllAsRead')->name('notifications.marks');
    Route::delete('remove', 'NotificationController@removeAll')->name('notifications.remove');
    Route::get('mark/{id}', 'NotificationController@markSingleAsRead')->name('notifications.mark.single');
});

Route::group(['prefix' => 'shop'], function () {
    Route::get('/', 'ShopController@index')->name('shop.index');
    Route::get('{productSlug}', 'ShopController@show')->name('shop.show');
    Route::post('{productSlug}', 'Web\ReviewController@store')->name('review.store');
    Route::get('/filter/category/{param}', 'ShopController@filterCategory')->name('shop.filter.category');
    Route::get('/filter/price/{data}', 'ShopController@filterPrice')->name('shop.filter.price');
});

Route::resource('cart', 'CartController')->parameters([
    '/' => 'productSlug',
])->only(['index', 'destroy']);

Route::get('cart/increase/{productSlug}', 'CartController@updateIncrease')->name('cart.increase');

Route::get('cart/decrease/{productSlug}', 'CartController@updateDecrease')->name('cart.decrease');

Route::post('/cart/{productSlug}', 'CartController@store')->name('cart.store');

Route::resource('order', 'Web\OrderController')->only(['index', 'store']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('products', 'ProductController');
    Route::resource('orders', 'OrderController');
    Route::get('requests/{id}', 'ProductController@requestProductShow')->name('products.requests.show');
    Route::put('requests', 'ProductController@requestProductStore')->name('products.requests.store');
    Route::get('chart', 'AdminController@getCharts')->name('chart');
    Route::post('import', 'ProductController@importProduct')->name('products.import');
});

Auth::routes();
