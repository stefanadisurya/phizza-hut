<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('users.login');
    }

    public function verifyLogin(Request $request) {
        if(Auth::attempt($request->only('email', 'password'))) {
            if(auth()->user()->role == "admin") {
                return redirect()->route('homeAdmin');
            } else if(auth()->user()->role == "member") {
                return redirect()->route('homeMember');
            } else {
                return redirect()->route('home');
            }
        }
        
        return redirect()->back();
    }

    public function logout(Request $request) {
        Auth::logout();

        return redirect()->route('login');
    }
}
