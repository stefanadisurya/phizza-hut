<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Reset Password Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini berfungsi untuk mengatur permintaan reset password,
    | dan dibuat menggunakan Laravel Auth.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    use ResetsPasswords;

    /**
     * Berfungsi untuk me-redirect user menuju homepage ketika
     * setelah berhasil melakukan reset password.
     * Dibuat otomatis oleh Laravel Auth.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
