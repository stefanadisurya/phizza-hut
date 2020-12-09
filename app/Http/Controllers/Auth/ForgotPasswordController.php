<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Forgot Password Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini berfungsi untuk mengatur manajemen reset password melalui
    | email, dan dibuat menggunakan Laravel Auth.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    use SendsPasswordResetEmails;
}
