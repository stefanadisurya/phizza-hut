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
     * Function ini juga mem-passing data, yaitu pizzas, yang
     * digunakan untuk menampilkan seluruh pizza
     * yang ada pada PhizzaHut. Daftar pizza
     * ditampilkan dalam bentuk card, dan
     * dipaginasi menjadi 6 halaman.
     * User dapat menggunakan fitur
     * search pada halaman ini.
     * User dapat mencari
     * pizza berdasarkan
     * nama atau harga.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pizzas = Pizza::where("name", 'like', '%' . $search . '%')
            ->orWhere("price", 'like', '%' . $search . '%')
            ->paginate(6);
        return view('guest.index', ['pizzas' => $pizzas]);
    }

    /**
     * Function ini digunakan untuk menampilkan halaman Show Pizza Details untuk
     * guest. Function ini juga mem-passing data, yaitu pizzas, yang digunakan
     * untuk menampilkan pizza yang dipilih oleh user.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function showPizza(Pizza $pizza)
    {
        return view('guest.show', ['pizza' => $pizza]);
    }
}
