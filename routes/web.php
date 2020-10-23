<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Roles;

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

Route::get('/welcome', function() {
    return view('welcome');
})->name('welcome');

Route::get('/', 'PagesController@index')->name('home');

Route::group(['middleware' => ['auth','roles:admin']], function() {
    Route::get('/admin/home', 'AdminController@index')->name('homeAdmin');
});

Route::group(['middleware' => ['auth','roles:member']], function() {
    Route::get('/member/home', 'MemberController@index')->name('homeMember');
});

Route::get('/login', 'LoginController@login')->name('login')->middleware('guest');
Route::post('/verifyLogin', 'LoginController@verifyLogin')->name('verifyLogin')->middleware('guest');
Route::get('/logout', 'LoginController@logout')->name('logout')->middleware('auth');
