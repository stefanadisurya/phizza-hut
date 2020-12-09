<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Verification Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini digunakan untuk mengatur verifikasi email untuk user
    | yang melakukan registrasi. Fitur ini tidak digunakan pada project,
    | sehingga controller ini tidak digunakan. Dibuat menggunakan
    | Laravel Auth.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    use VerifiesEmails;

    /**
     * Berfungsi untuk me-redirect user menuju homepage ketika
     * setelah berhasil melakukan verifikasi. Dibuat otomatis
     * oleh Laravel Auth.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Function ini berfungsi untuk membuat instance controller baru,
     * memberikan middleware agar hanya user yang belum terdaftar
     * yang dapat menggunakan fitur ini. Dalam function ini
     * juga diatur mekanisme verifikasi, dan resend
     * verifikasi jika user tidak menerimanya.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
