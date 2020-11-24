<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'address' => 'required|min:5',
            'phoneNumber' => 'required|numeric|min:6',
            'gender' => 'required'
        ]);

        $user = User::create([
            'username' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'gender' => $request->gender
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->back();
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->remember ? true : false;

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember)) {
            // Alert::success('Login Success', 'You are logged in');
            return redirect()->route('home');
        }

        // Alert::error('Login Failed', 'Invalid credentials');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('root');
    }
}
