<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Roles;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Tempat untuk meregistrasi web routes pada aplikasi.
| Route-route ini di-load oleh RouteServiceProvider
| dalam sebuah group yang mengandung group "web"
| middleware.
|
| Made by @stefanadisurya & @ChristopherIrvine
*/

Auth::routes();

/**
 * Daftar route yang bisa diakses bersama oleh user dengan role 'admin' dan 'member'.
 * 
 * Made by @stefanadisurya & @ChristopherIrvine
 */
Route::group(['middleware' => ['auth', 'roles:admin,member']], function () {
    Route::get('/home', 'UserController@index')->name('home');
    Route::get('/pizza/{pizza}', 'UserController@show')->name('show');
});

/**
 * Daftar route yang hanya dapat diakses oleh user dengan role 'admin'.
 * 
 * Made by @stefanadisurya & @ChristopherIrvine
 */
Route::group(['middleware' => ['auth', 'roles:admin']], function () {
    Route::get('/add', 'AdminController@addPizza')->name('add');
    Route::post('/add', 'AdminController@store');
    Route::get('/edit/{pizza}', 'AdminController@editPizza')->name('edit');
    Route::post('/edit/{pizza}', 'AdminController@update');
    Route::get('/delete/{pizza}', 'AdminController@deletePizza')->name('delete');
    Route::get('/getUser', 'AdminController@getUser')->name('getUser');
    Route::delete('/delete/{pizza}', 'AdminController@destroy');
    Route::get('/allTransactionList', 'TransactionController@showall')->name('showalltransaction');
    Route::get('/admin/detailTransactionList/{Htrans}', 'TransactionController@showdetailtransaction')->name('showdetailtransactionforadmin');
});

/**
 * Daftar route yang hanya dapat diakses oleh user dengan role 'member'.
 * 
 * Made by @stefanadisurya & @ChristopherIrvine
 */
Route::group(['middleware' => ['auth', 'roles:member']], function () {
    Route::post('/pizza/{pizza}', 'CartController@storeToCart');
    Route::get('/cartList', 'CartController@showAllCart')->name('showcart');
    Route::post('/cartList/update/{item}', 'CartController@updateQuantity')->name('updatequantity');
    Route::delete('/cartList/delete/{item}', 'CartController@deleteItemFromCart')->name('delete');
    Route::post('/cartList', 'CartController@checkout')->name('checkout');
    Route::get('/transactionList', 'TransactionController@show')->name('showtransaction');
    Route::get('/detailTransactionList/{Htrans}', 'TransactionController@showdetailtransaction')->name('showdetailtransaction');
});

/**
 * Route yang hanya dapat diakses oleh guest.
 * 
 * Made by @stefanadisurya & @ChristopherIrvine
 */
Route::get('/', 'GuestController@index')->name('root')->middleware('guest');
Route::get('/{pizza}', 'GuestController@show')->name('showPizza')->middleware('guest');

/**
 * Route yang digunakan jika URL tidak ditemukan (tidak ada dalam daftar route di web.php).
 * 
 * Made by @stefanadisurya & @ChristopherIrvine
 */
Route::get('/error', function () {
    return view('errors.404');
});
