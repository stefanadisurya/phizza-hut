<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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

    protected function sendLoginResponse(Request $request)
    {
        /**
         * Mengatur cookie agar disimpan selama 2 jam.
         * 
         * Made by @stefanadisurya & @ChristopherIrvine
         */
        $minutes = 120;
        $rememberToken = Auth::getRecallerName();
        Cookie::queue($rememberToken, Cookie::get($rememberToken), $minutes);

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }
}
