<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini digunakan untuk mengatur halaman yang dapat diakses oleh
    | user dengan role 'admin' dan 'member'.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    /**
     * Function ini digunakan untuk memberikan middleware pada homepage,
     * sehingga yang dapat mengakses halaman ini hanya admin dan
     * member.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Function ini digunakan untuk menampilkan homepage. Function
     * ini juga mem-passing data, yaitu 'pizzas', yang digunakan
     * untuk menampilkan  seluruh pizza yang ada. Daftar pizza
     * ditampilkan dalam bentuk card, dan di-paginate menjadi
     * 6 halaman. User dapat menggunakan fitur search pada
     * halaman ini. User juga dapat mencari pizza
     * berdasarkan nama atau harga.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function index(Request $request)
    {
        $search = $request->get('search'); /* Mengambil input dengan name="search". */
        $pizzas = Pizza::where("name", 'like', '%' . $search . '%') /* Pencarian pizza berdasarkan nama dari table 'pizzas'. Menggunakan model 'Pizza' (Eloquent) untuk melakukannya. */
            ->orWhere("price", 'like', '%' . $search . '%') /* Pencarian pizza berdasarkan harga dari table 'pizzas'. Menggunakan model 'Pizza' (Eloquent) untuk melakukannya. */
            ->paginate(6); /* Pagination menjadi 6 data setiap halaman. */
        return view('home', ['pizzas' => $pizzas]); /* Mengembalikan view home, dan mem-pasing data 'pizzas'. */
    }

    /**
     * Function ini digunakan untuk menampilkan halaman View Pizza Details untuk
     * admin dan member. Function ini juga mem-passing data, yaitu 'pizzas',
     * yang digunakan untuk menampilkan pizza yang dipilih oleh user.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function show(Pizza $pizza)
    {
        return view('show', ['pizza' => $pizza]); /* Mengembalikan view guest.show, dan mem-passing data 'pizzas'. */
    }
}
