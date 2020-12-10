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
            'username' => ['required', 'string', 'max:255'], /* Tidak boleh kosong, harus diisi dengan string yang maksimum panjangnya 255 character. */
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], /* Tidak boleh kosong, harus diisi dengan string dalam format email, maksimum panjangnya 255 character, dan harus unik dalam table 'users'. */
            'password' => ['required', 'string', 'min:6', 'confirmed'], /* Tidak boleh kosong, harus diisi dengan string yang minimum panjangnya 6 character, dan harus sama dengan kolom 'Confirm Password' pada form. */
            'address' => ['required', 'min:5'], /* Tidak boleh kosong, harus diisi dengan minimum panjnagnya 5 chracter. */
            'phoneNumber' => ['required', 'numeric', 'digits:6'], /* Tidak boleh kosong, harus diisi dengan angka yang minimum panjangnya 6 digit. */
            'gender' => ['required'] /* Tidak boleh kosong. */
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
            'username' => $data['username'], /* Ambil data dari input 'username' pada form. */
            'role' => $data['role'], /* Ambil data dari input (hidden) 'role' pada form */
            'email' => $data['email'], /* Ambil data dari input 'email' pada form. */
            'password' => bcrypt($data['password']), /* Ambil data dari input 'password' pada form. Data akan di-bcrypt agar menjaga privasi user pada database. */
            'address' => $data['address'], /* Ambil data dari input 'address' pada form. */
            'phoneNumber' => $data['phoneNumber'], /* Ambil data dari input 'phoneNumber' pada form. */
            'gender' => $data['gender'] /* Ambil data dari input (radio) 'gender' pada form. */
        ]);
    }
}
