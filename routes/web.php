<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' =>true]); //verifikasi email

Route::get('/home', 'HomeController@index')->name('home'); //route setelah user login
Route::prefix('product')->group(function () {
    Route::get('/{id}', 'HomeController@detail_product')->name('detail_product');
    Route::post('review/{id}', 'HomeController@review_product')->name('review_product');
});

Route::prefix('admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginform')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register','Auth\AdminRegisterController@register')->name('admin.register.submit');

    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset')->name('admin.password.update');
});

//Courier
Route::resource('/courier','CourierController')->middleware('auth:admin');

//Product
Route::resource('/products','ProductController')->middleware('auth:admin');
Route::get('/{id}/edit', 'ProductController@edit')->name('product.edit')->middleware('auth:admin');
Route::post('/{id}/update', 'ProductController@update')->name('product.edit')->middleware('auth:admin');
Route::post('/{id}/add_image', 'ProductController@add_image')->name('product.add_image')->middleware('auth:admin');
Route::delete('/{id}/delete_image', 'ProductController@delete_image')->name('product.delete_image')->middleware('auth:admin');
Route::post('/{id}/add_cat', 'ProductController@add_cat')->name('product.add_cat')->middleware('auth:admin');
Route::delete('/{id}/delete_cat', 'ProductController@delete_cat')->name('product.delete_cat')->middleware('auth:admin');

//Categories
Route::resource('/categories','ProductCategoriesController')->middleware('auth:admin');

Route::prefix('admin/response')->group(function () {
    Route::get('/', 'ResponseController@index')->name('admin.response')->middleware('auth:admin');
    Route::get('/add', 'ResponseController@create')->name('response.add')->middleware('auth:admin');
    Route::get('/{review}/add', 'ResponseController@add_response')->name('response.add_response')->middleware('auth:admin');
    Route::get('/{response}/edit', 'ResponseController@edit')->name('response.edit')->middleware('auth:admin');
    Route::post('/store', 'ResponseController@store')->name('response.store')->middleware('auth:admin');
    Route::put('/{id}/update', 'ResponseController@update')->name('response.update')->middleware('auth:admin');
    Route::delete('/{id}', 'ResponseController@destroy')->name('response.destroy')->middleware('auth:admin');
});

Route::prefix('admin/discount')->group(function () {
    Route::get('/', 'DiscountController@index')->name('admin.discount')->middleware('auth:admin');
    Route::get('/add/{id}', 'DiscountController@create')->name('discount.add')->middleware('auth:admin');
    Route::get('/{discount}/edit', 'DiscountController@edit')->name('discount.edit')->middleware('auth:admin');
    Route::post('/store', 'DiscountController@store')->name('discount.store')->middleware('auth:admin');
    Route::put('/{id}/update', 'DiscountController@update')->name('discount.update')->middleware('auth:admin');
    Route::delete('/{id}', 'DiscountController@destroy')->name('discount.destroy')->middleware('auth:admin');
});