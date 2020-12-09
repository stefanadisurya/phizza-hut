<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini berfungsi untuk mengautentikasi user, dan dibuat
    | menggunakan Laravel Auth.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    use AuthenticatesUsers;

    /**
     * Berfungsi untuk me-redirect user menuju homepage ketika
     * setelah berhasil melakukan login. Dibuat otomatis
     * oleh Laravel Auth.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Function ini digunakan untuk memberikan middleware pada halaman Login,
     * sehingga yang dapat mengakses halaman ini hanya guest. Dibuat
     * otomatis oleh Laravel Auth.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
