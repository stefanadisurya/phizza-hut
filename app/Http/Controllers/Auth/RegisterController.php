<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini digunakan untuk mengurus registrasi user baru. User
    | yang melakukan registrasi lewat halaman Register, akan memiliki
    | role 'Member'. Jika ingin menambahkan user denga role 'Admin',
    | maka harus ditambahkan melalui seeder, tinker, ataupun secara
    | manual pada database (dalam hal ini, phpMyAdmin). Controller
    | ini menggunakan model User, dan dibuat menggunakan Laravel
    | Auth.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    use RegistersUsers;

    /**
     * Berfungsi untuk me-redirect user menuju homepage ketika
     * telah berhasil melakukan register. Dibuat otomatis
     * oleh Laravel Auth.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Function ini digunakan untuk memberikan middleware pada halaman Register,
     * sehingga yang dapat mengakses halaman ini hanya guest. Dibuat
     * otomatis oleh Laravel Auth.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Function ini digunakan untuk melakukan validasi pada form Register.
     * Jika ada data yang tidak sesuai, maka akan dikeluarkan sebuah
     * warning pada form. Dibuat otomatis oleh Laravel Auth, dan
     * dimodifikasi sesuai kebutuhan.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'address' => ['required', 'min:5'],
            'phoneNumber' => ['required', 'numeric', 'digits:6'],
            'gender' => ['required']
        ]);
    }

    /**
     * Function ini digunakan untuk mendaftarkan user baru, dan menyimpannya
     * ke dalam database. Data didapat dari form yang diisi oleh user
     * pada halaman Register. Clause yang digunakan adalah
     * User::create(...). Dibuat otomatis oleh Laravel Auth, dan
     * dimodifikasi sesuai kebutuhan.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
            'phoneNumber' => $data['phoneNumber'],
            'gender' => $data['gender']
        ]);
    }
}
