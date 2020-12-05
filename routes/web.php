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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth', 'roles:admin']], function () {
    Route::get('/add', 'AdminController@addPizza')->name('add');
    Route::post('/add', 'AdminController@store');
    Route::get('/edit/{pizza}', 'AdminController@editPizza')->name('edit');
    Route::post('/edit/{pizza}', 'AdminController@update');
    Route::get('/delete/{pizza}', 'AdminController@deletePizza')->name('delete');
    Route::get('/getUser', 'AdminController@getUser')->name('getUser');
    Route::delete('/delete/{pizza}', 'AdminController@destroy');
    Route::get('/alltransactionlist','TransactionController@showall')->name('showalltransaction');
    Route::get('/detailtransactionlistforadmin/{Htrans}','TransactionController@showdetailtransaction')->name('showdetailtransactionforadmin');
});

Route::group(['middleware' => ['auth','roles:member']], function(){
    Route::get('/pizza/{pizza}', 'PagesController@show')->name('show');
    Route::post('/pizza/{pizza}', 'CartController@storeToCart');
    Route::get('/cartlist','CartController@showAllCart')->name('showcart');
    Route::post('/cartlist/update/{item}','CartController@updateQuantity')->name('updatequantity');
    Route::delete('/cartlist/delete/{item}','CartController@deleteItemFromCart')->name('delete');
    Route::post('/cartlist','CartController@checkout')->name('checkout');
    Route::get('/transactionlist','TransactionController@show')->name('showtransaction');
    Route::get('/detailtransactionlist/{Htrans}','TransactionController@showdetailtransaction')->name('showdetailtransaction');
});



Route::get('/', 'PagesController@index')->name('root')->middleware('guest');
Route::get('/{pizza}', 'PagesController@showPizza')->name('showPizza')->middleware('guest');
