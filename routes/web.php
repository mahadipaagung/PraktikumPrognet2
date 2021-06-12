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
    return view('home');
});

Auth::routes(['verify' =>true]); //verifikasi email

Route::get('/home', 'ProductController@showbaru')->name('home'); //route setelah user login
Route::prefix('product')->group(function () {
    Route::post('review/{id}', 'HomeController@review_product')->name('review_product');
});

Route::prefix('admin')->group(function(){
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

    Route::get('/transaksi','AdminTransaksiController@index')->name('admin.transaksi');
    Route::get('/transaksi/detail/{id}','AdminDetailTransaksiController@index')->name('admin.detail_transaksi');
    Route::post('/transaksi/detail/status', 'AdminDetailTransaksiController@membatalkanPesanan');
    Route::post('/transaksi/detail/{id}', 'AdminDetailTransaksiController@rejectproof');

    Route::post('/transaksi/detail/review', 'ResponseController@create');
   
});
Route::group(['prefix' => 'admin', 'middleware' => ['CekSuperRole:1']], function () {
    Route::get('/manage-admin', 'AdminController@manageAdmin')->name('admin.manage');
});

Route::post('/store', 'ResponseController@store')->name('response.store')->middleware('auth:admin');

//Courier
Route::resource('/courier','CourierController')->middleware('auth:admin');

//Product
Route::resource('/products','ProductController')->middleware('auth:admin');
Route::get('/{id}/edit', 'ProductController@edit')->name('product.edit')->middleware('auth:admin');
Route::post('/{id}/update', 'ProductController@update')->name('product.update')->middleware('auth:admin');
Route::post('/{id}/add_image', 'ProductController@add_image')->name('product.add_image')->middleware('auth:admin');
Route::delete('/{id}/delete_image', 'ProductController@delete_image')->name('product.delete_image')->middleware('auth:admin');

//Categories
Route::resource('/categories','ProductCategoriesController')->middleware('auth:admin');


Route::resource('/discount','DiscountController')->middleware('auth:admin');

Route::get('/', 'ProductController@showbaru');

Route::get('/shop', 'ShopController@show');
Route::get('/shop/search','ShopController@search');
Route::get('/shop/category','ShopController@filter');

Route::get('/product/{slug}', 'ProductController@showone');

Route::post('/checkout', 'CheckoutController@index');
Route::get('/kota/{id}', 'CheckoutController@cekkota');
Route::post('/ongkir', 'CheckoutController@cekongkir');
Route::post('/beli', 'TransactionController@inbeli');

Route::get('/transaksi/{param}', 'TransactionController@index');
Route::get('/transaksi/detail/{param}', 'TransactionDetailController@index');
Route::post('/transaksi/detail/status', 'TransactionDetailController@updatestatus');
Route::post('/transaksi/detail/proof', 'TransactionDetailController@uploadProof');
Route::post('/transaksi/detail/review', 'ProductReviewController@store');

Route::get('/cart', 'CartController@show');
Route::post('/addcart', 'CartController@store');
Route::post('/updatecart', 'CartController@update');

Auth::routes();
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');