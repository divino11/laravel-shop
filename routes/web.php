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

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::group([
    'middleware' => 'auth',
    'namespace' => 'Account'
], function () {
    Route::get('/account', 'MainController@index')->name('account');
});

Route::group([
    'middleware' => 'auth',
    'namespace' => 'Admin'
], function () {
    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('/admin', 'MainController@index');
        Route::resource('/admin/products', 'ProductController');
        Route::resource('/admin/category', 'CategoryController');
    });
});

Route::get('logout', 'Auth\LoginController@logout')->name('exit');

Route::get('/', 'MainController@index')->name('index');
Route::get('/contact', 'MainController@contact')->name('contact');
Route::get('/logging', 'MainController@auth')->name('authentication');
Route::get('/registration', 'MainController@registration')->name('registration');
Route::get('/registration_success', 'MainController@registrationSuccess')->name('registrationSuccess');
Route::get('/search', 'MainController@search')->name('search');
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/favorites', 'FavoriteController@index')->name('favorites');
Route::post('favorite/{product}', 'FavoriteController@favoriteProduct');
Route::post('unfavorite/{product}', 'FavoriteController@unFavoriteProduct');
Route::post('add_to_basket/{order}/{size}', 'BasketController@addSizeToOrder');
Route::post('remove_from_basket/{order}/{size}', 'BasketController@removeSizeFromOrder');
Route::post('remove_product_from_order/{product}', 'BasketController@removeProductFromOrder');

Route::group([
    'prefix' => 'basket'
], function () {
    Route::get('/', 'BasketController@basket')->name('basket');
    Route::get('/place', 'BasketController@basketPlace')->name('basket-place');
    Route::post('/confirm', 'BasketController@basketConfirm')->name('basket-confirm');
    Route::post('/add', 'BasketController@basketAdd')->name('basket-add');
    Route::post('/remove/{id}', 'BasketController@basketRemove')->name('basket-remove');
});

Route::get('/{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product?}/{colors}', 'MainController@product')->name('product');
