<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class GuestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Guest Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini digunakan untuk mengatur homepage yang dapat diakses
    | oleh guest.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    /**
     * Function ini digunakan untuk menampilkan landing page (root).
     * Function ini juga mem-passing data, yaitu 'pizzas', yang
     * digunakan untuk menampilkan seluruh pizza
     * yang ada pada PhizzaHut. Daftar pizza
     * ditampilkan dalam bentuk card, dan
     * di-paginate menjadi 6 data
     * setiap halaman. User dapat
     * menggunakan fitur search
     * pada halaman ini. User
     * dapat mencari pizza
     * berdasarkan nama
     * atau harga.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function index(Request $request)
    {
        $search = $request->get('search'); /* Mengambil input dengan name="search". */
        $pizzas = Pizza::where("name", 'like', '%' . $search . '%') /* Pencarian pizza berdasarkan nama dari table 'pizzas'. Menggunakan model 'Pizza' (Eloquent) untuk melakukannya. */
            ->orWhere("price", 'like', '%' . $search . '%') /* Pencarian pizza berdasarkan harga dari table 'pizzas'. Menggunakan model 'Pizza' (Eloquent) untuk melakukannya. */
            ->paginate(6); /* Pagination menjadi 6 data setiap halaman. */
        return view('guest.index', ['pizzas' => $pizzas]); /* Mengembalikan view guest.index, dan mem-passing data 'pizzas'. */
    }

    /**
     * Function ini digunakan untuk menampilkan halaman View Pizza Details untuk
     * guest. Function ini juga mem-passing data, yaitu pizzas, yang digunakan
     * untuk menampilkan pizza yang dipilih oleh user.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function show(Pizza $pizza)
    {
        return view('guest.show', ['pizza' => $pizza]); /* Mengembalikan view guest.show, dan mem-passing data 'pizzas'. */
    }
}
