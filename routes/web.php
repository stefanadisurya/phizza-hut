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
    Route::get('/getUser', 'AdminController@getUser')->name('getUser');
    Route::get('/pizza/{pizza}', 'AdminController@show')->name('show');
    Route::get('/add', 'AdminController@addPizza')->name('add');
    Route::post('/add', 'AdminController@store');
    Route::get('/edit/{pizza}', 'AdminController@editPizza')->name('edit');
    Route::post('/edit/{pizza}', 'AdminController@update');
    Route::get('/delete/{pizza}', 'AdminController@deletePizza')->name('delete');
    Route::delete('/delete/{pizza}', 'AdminController@destroy');
});

Route::get('/', 'PagesController@index')->name('root')->middleware('guest');
Route::get('/{pizza}', 'PagesController@show')->name('showPizza')->middleware('guest');
