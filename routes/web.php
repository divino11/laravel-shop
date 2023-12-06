<?php

use http\Url;
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

URL::forceScheme('https');

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::group([
    'middleware' => 'auth',
    'namespace' => 'Account',
    'prefix' => 'account'
], function () {
    Route::get('orders', 'MainController@orders')->name('account-orders');
    Route::get('profile', 'MainController@index')->name('account');
    Route::get('favorites', 'FavoriteController@index')->name('account-favorites');
    Route::post('favorite/{product}', 'FavoriteController@favoriteProduct');
    Route::post('unfavorite/{product}', 'FavoriteController@unFavoriteProduct');
    Route::get('basket', 'BasketController@basket')->name('account-basket');
    Route::post('profile/update', 'MainController@updateProfile')->name('updateProfile');
    Route::post('profile/address/update', 'MainController@updateProfileAddress')->name('updateProfileAddress');
});

Route::group([
    'middleware' => 'auth',
    'namespace' => 'Admin',
    'prefix' => 'admin'
], function () {
    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('/', 'MainController@index');
        Route::resource('/products', 'ProductController');
        Route::resource('/blog', 'BlogController');
        Route::post('/blog/upload-image', 'BlogController@uploadImage');
        Route::resource('/category', 'CategoryController');
        Route::resource('/post', 'PostController');
        Route::get('/main', 'MainController@mainPage');
        Route::post('/main-upload', 'MainController@updateMainPage')->name('updateMainPage');
    });
});

Route::get('logout', 'Auth\LoginController@logout')->name('exit');

Route::get('/', 'MainController@index')->name('index');
Route::get('/catalog', 'MainController@catalog')->name('catalog');
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
Route::get('/how-to-choose-size', 'MainController@chooseSize')->name('choose-size');
Route::get('/insta-shop', 'MainController@instaShop')->name('insta-shop');
Route::get('/blog', 'PostController@index')->name('blog');
Route::get('/blog/{slug}', 'PostController@show')->name('blog-read');
Route::post('review-add/user/{user}/product/{product}', 'RatingController@reviewAdd')->name('review-add');

Route::group([
    'prefix' => 'basket'
], function () {
    Route::get('/', 'BasketController@basket')->name('basket');
    Route::get('/place', 'BasketController@basketPlace')->name('basket-place');
    Route::get('/count', 'BasketController@getCount')->name('basket-count');
    Route::get('/total-price', 'BasketController@getTotalPrice')->name('basket-total-price');
    Route::get('/total-price-without-discount', 'BasketController@getTotalPriceWithoutDiscount')->name('basket-total-price-without-discount');
    Route::post('/update-count/{product}/{quantity}', 'BasketController@updateCount')->name('basket-update-count');
    Route::post('/confirm', 'BasketController@basketConfirm')->name('basket-confirm');
    Route::post('/add', 'BasketController@basketAdd')->name('basket-add');
    Route::post('/remove/{id}', 'BasketController@basketRemove')->name('basket-remove');
});

Route::get('/category/{category}', 'MainController@category')->name('category');
Route::get('/category/{category}/product/{product?}', 'MainController@product')->name('product');
