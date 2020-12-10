<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Pizza;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini digunakan untuk mengatur fitur yang hanya dapat digunakan
    | oleh user dengan role 'admin'. Jika guest atau user dengan role
    | 'member' berusaha mengakses halaman-halaman ini, maka user
    | akan di-redirect ke halaman mereka semula. Controller
    | ini menggunakan model 'User' dan 'Pizza'.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    /**
     * Function ini digunakan oleh admin untuk menampilkan halaman View All Users.
     * Function ini juga mem-passing sebuah data, yaitu users, yang akan
     * menampilkan seluruh user yang terdaftar pada PhizzaHut.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function getUser()
    {
        $users = User::all(); /* Mengambil data seluruh User dari table 'users'. Menggunakan model 'User' (Eloquent) untuk melakukannya. */
        return view('admin.getUser', ['users' => $users]); /* Mengembalikan view admin.getUser, dan mem-passing data 'users'. */
    }

    /**
     * Function ini digunakan untuk menampilkan halaman Add Pizza.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function addPizza()
    {
        return view('admin.add'); /* Mengembalikan view admin.add. */
    }

    /**
     * Function ini digunakan oleh admin untuk menyimpan pizza baru. Terdapat beberapa
     * validasi yang didefinisikan pada bagian $this->validate(...). Pada function
     * ini, gambar yang di-upload oleh admin akan disimpan didalam folder
     * public/assets/image, dan dalam database dalam bentuk string.
     * Jika proses penambahan pizza baru berhasil, maka akan
     * muncul sebuah alert konfirmasi bahwa pizza baru
     * berhasil ditambahkan, dan admin akan
     * di-redirect menuju homepage.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function store(Request $request)
    {
        /* Validasi form. */
        $this->validate($request, [
            'name' => 'required|max:20', /* Tidak boleh kosong, dan maksimum diisi dengan 20 character. */
            'price' => 'required|numeric|min:10000', /* Tidak boleh kosong, harus diisi dengan angka yang nominalnya minimum 10000 */
            'description' => 'required|min:20', /* Tidak boleh kosong, dan minimum diisi dengan 20 character. */
            'image' => 'required|mimes:jpeg,jpg,png', /* Tidak boleh kosong, dan format upload harus jpeg, jpg, atau png. */
        ]);

        $filename = $request->image->getClientOriginalName(); /* Mengambil nama file yang di-upload. */

        Pizza::create([
            'name' => $request->name, /* Ambil data dari input 'name' pada form. */
            'price' => $request->price, /* Ambil data dari input 'price' pada form. */
            'description' => $request->description, /* Ambil data dari input 'description' pada form. */
            'image' => $filename /* Ambil nama data dari input 'image' pada form. */
        ]);

        $request->image->storeAs('image', $filename, 'public'); /* Menyimpan image yang sudah di-upload pada folder public/assets/image */
        Alert::success('Add Pizza Success!', 'Pizza added'); /* Menampilkan pesan sukses menambahkan pizza baru. Dibuat dengan menggunakan SweetAlert. */

        return redirect()->route('home'); /* Me-redirect ke route yang mempunyai name('home'). */
    }

    /**
     * Function ini digunakan untuk menampilkan halaman Edit Pizza.
     * Function ini juga mem-passing sebuah data, yaitu pizza,
     * yang akan digunakan pada blade untuk menampilkan
     * data pizza yang dipilih oleh admin.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function editPizza(Pizza $pizza)
    {
        return view('admin.edit', ['pizza' => $pizza]); /* Mengembalikan view admin.edit, dan mem-passing data 'pizza'. */
    }

    /**
     * Function ini digunakan oleh admin untuk melakukan edit (update) pizza
     * yang dipilih. Terdapat beberapa validasi yang didefinisikan pada
     * $this->validate(...). Function ini mirip dengan function
     * store(), namun perbedaannya terdapat pada clause
     * yang digunakan, yakni Pizza::where(...), dan
     * alert yang diberikan ketika berhasil
     * melakukan update pizza.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function update(Request $request, Pizza $pizza)
    {
        /* Validasi form. */
        $request->validate([
            'name' => 'required|max:20', /* Tidak boleh kosong, dan maksimum diisi dengan 20 character. */
            'price' => 'required|numeric|min:10000', /* Tidak boleh kosong, harus diisi dengan angka yang nominalnya minimum 10000 */
            'description' => 'required|min:20', /* Tidak boleh kosong, dan minimum diisi dengan 20 character. */
            'image' => 'required|mimes:jpeg,jpg,png', /* Tidak boleh kosong, dan format upload harus jpeg, jpg, atau png. */
        ]);

        $filename = $request->image->getClientOriginalName(); /* Mengambil nama file yang di-upload. */

        Pizza::where('id', $pizza->id)->update([
            'name' => $request->name, /* Ambil data dari input 'name' pada form. */
            'price' => $request->price, /* Ambil data dari input 'price' pada form. */
            'description' => $request->description, /* Ambil data dari input 'description' pada form. */
            'image' => $filename /* Ambil nama data dari input 'image' pada form. */
        ]);

        $request->image->storeAs('image', $filename, 'public'); /* Menyimpan image yang sudah di-upload pada folder public/assets/image */
        Alert::success('Edit Pizza Success!', 'Pizza updated'); /* Menampilkan pesan sukses menambahkan pizza baru. Dibuat dengan menggunakan SweetAlert. */

        return redirect()->route('home'); /* Me-redirect ke route yang mempunyai name('home'). */
    }

    /**
     * Function ini digunakan untuk menampilkan halaman Delete Pizza.
     * Function ini juga mem-passing sebuah data, yaitu pizza,
     * yang akan digunakan pada blade untuk menampilkan
     * data pizza yang dipilih oleh admin.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function deletePizza(Pizza $pizza)
    {
        return view('admin.delete', ['pizza' => $pizza]); /* Mengembalikan view admin.edit, dan mem-passing data 'pizza'. */
    }

    /**
     * Function ini digunakan untuk menghapus pizza dari database.
     * Digunakan clasue Pizza::destroy(...) untuk melakukan
     * operasi tersebut. Jika pizza sudah dihapus,
     * maka akan muncul sebuah alert sebagai
     * konfirmasi bahwa pizza berhasil
     * dihapus.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function destroy(Pizza $pizza)
    {
        Pizza::destroy($pizza->id); /* Menghapus pizza dari table 'pizzas'. Menggunakan model 'Pizza' (Eloquent) untuk melakukannya. */
        Alert::success('Delete Success!', 'Pizza deleted'); /* Menampilkan pesan sukses menghapus pizza. Dibuat dengan menggunakan SweetAlert. */

        return redirect()->route('home'); /* Me-redirect ke route yang mempunyai name('home'). */
    }
}
