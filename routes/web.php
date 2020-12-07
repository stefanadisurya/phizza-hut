<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Roles;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'roles:admin,member']], function () {
    Route::get('/pizza/{pizza}', 'PagesController@show')->name('show');
});

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

Route::group(['middleware' => ['auth', 'roles:member']], function () {
    Route::post('/pizza/{pizza}', 'CartController@storeToCart');
    Route::get('/cartList', 'CartController@showAllCart')->name('showcart');
    Route::post('/cartList/update/{item}', 'CartController@updateQuantity')->name('updatequantity');
    Route::delete('/cartList/delete/{item}', 'CartController@deleteItemFromCart')->name('delete');
    Route::post('/cartList', 'CartController@checkout')->name('checkout');
    Route::get('/transactionList', 'TransactionController@show')->name('showtransaction');
    Route::get('/detailTransactionList/{Htrans}', 'TransactionController@showdetailtransaction')->name('showdetailtransaction');
});

Route::get('/', 'PagesController@index')->name('root')->middleware('guest');
Route::get('/{pizza}', 'PagesController@showPizza')->name('showPizza')->middleware('guest');

Route::get('/error', function () {
    return view('errors.404');
});
