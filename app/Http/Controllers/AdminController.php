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
        $users = User::all();
        return view('admin.getUser', ['users' => $users]);
    }


    /**
     * Function ini digunakan untuk menampilkan halaman Add Pizza.
     * 
     * Made by @stefanadisurya
     */
    public function addPizza()
    {
        return view('admin.add');
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
     * Made by @stefanadisurya
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|min:20',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $filename = $request->image->getClientOriginalName();

        Pizza::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $filename
        ]);

        $request->image->storeAs('image', $filename, 'public');
        Alert::success('Add Pizza Success!', 'Pizza added');

        return redirect()->route('home');
    }

    /**
     * Function ini digunakan untuk menampilkan halaman Edit Pizza.
     * Function ini juga mem-passing sebuah data, yaitu pizza,
     * yang akan digunakan pada blade untuk menampilkan
     * data pizza yang dipilih oleh admin.
     * 
     * Made by @stefanadisurya
     */
    public function editPizza(Pizza $pizza)
    {
        return view('admin.edit', ['pizza' => $pizza]);
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
     * Made by @stefanadisurya
     */
    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'name' => 'required|max:20',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|min:20',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $filename = $request->image->getClientOriginalName();

        Pizza::where('id', $pizza->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $filename
        ]);

        $request->image->storeAs('image', $filename, 'public');
        Alert::success('Edit Pizza Success!', 'Pizza updated');

        return redirect()->route('home');
    }

    /**
     * Function ini digunakan untuk menampilkan halaman Delete Pizza.
     * Function ini juga mem-passing sebuah data, yaitu pizza,
     * yang akan digunakan pada blade untuk menampilkan
     * data pizza yang dipilih oleh admin.
     * 
     * Made by @stefanadisurya
     */
    public function deletePizza(Pizza $pizza)
    {
        return view('admin.delete', ['pizza' => $pizza]);
    }

    /**
     * Function ini digunakan untuk menghapus pizza dari database.
     * Digunakan clasue Pizza::destroy(...) untuk melakukan
     * operasi tersebut. Jika pizza sudah dihapus,
     * maka akan muncul sebuah alert sebagai
     * konfirmasi bahwa pizza berhasil
     * dihapus.
     * 
     * Made by @stefanadisurya
     */
    public function destroy(Pizza $pizza)
    {
        Pizza::destroy($pizza->id);
        Alert::success('Delete Success!', 'Pizza deleted');

        return redirect()->route('home');
    }
}
