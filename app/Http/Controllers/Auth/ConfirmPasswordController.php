<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini digunakan untuk mengatur konfirmasi password, dan dibuat
    | menggunakan Laravel Auth.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    use ConfirmsPasswords;

    /**
     * Berfungsi untuk me-redirect user menuju homepage ketika
     * setelah berhasil melakukan konfirmasi password.
     * Dibuat otomatis oleh Laravel Auth.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Function ini digunakan untuk memberikan middleware,
     * sehingga yang dapat mengakses halaman ini hanya
     * user dengan role 'admin' dan 'member'. Dibuat
     * otomatis oleh Laravel Auth.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
