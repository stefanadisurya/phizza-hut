<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DetailTransaction;
use App\HeaderTransaction;
use App\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{

     /*
    |--------------------------------------------------------------------------
    | Cart Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini digunakan untuk mengatur logic flow cart yang hanya dapat digunakan
    | oleh user dengan role 'admin'. Dengan adanya controller ini member dapat melihat
    | list pizza yang telah dimasukkan ke dalam cart dan dapat mengupdate, menghapus,
    | serta checkout list-list pizza dalam cart tersebut.
    |
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    /**
     * Function ini digunakan oleh member ketika mereka ingin memasukan produk pizza yang mereka inginkan ke dalam cart
     * sebelum dimasukkan ke dalam database terdapat proses validasi terlebih dahulu terhadap data quantity yang  
     * dimasukkan data quantity yng dimasukkan harus ada dan nilainya mesti lebih dari 0 apabila tidak 
     * memenuhi persyaratan tersebut akan muncul error message dan datanya tidak akan dimasukkan 
     * ke dalam database, sebaliknya apabila sudah memenuhi persyaratan tersebut data-data
     * pizza dan member tersebut akan langsung dimasukkan ke dalam database.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function storeToCart(Request $request, Pizza $pizza)
    {

        $user = auth()->user(); /* Validasi user. */

        /* Validasi form. */
        $this->validate($request, ['quantity' => 'required|numeric|min:1']); /* Tidak boleh kosong, dan harus diisi dengan angka yang bernilai minimal 1. */

        if (Cart::where("user_id", "=", $user->id)->count() > 0 && Cart::where("pizza_id", "=", $pizza->id)->count() > 0) { /* Jika sudah ada pizza yang sama pada cart. */
            Cart::where([["user_id", "=", $user->id], ["pizza_id", "=", $pizza->id]])->increment('quantity', $request->quantity); /* Menambahkan quantity pizza tersebut. */
        } else { /* Jika belum ada pizza yang sama pada cart. */
            Cart::create([
                'user_id' => $user->id, /* Ambil user_id dari user yang sedang melakukan pemesanan. */
                'pizza_id' => $pizza->id, /* Ambil pizza_id dari pizza yang dipesan (Add to Cart). */
                'quantity' => $request->quantity /* Ambil data dari input 'quantity' pada form. */
            ]);
        }

        Alert::success('Add to Cart Success!', 'Pizza added to cart'); /* Menampilkan pesan sukses Add to Cart. Dibuat dengan menggunakan SweetAlert. */

        return redirect()->route('show', $pizza);  /* Me-redirect ke route yang mempunyai name('show'), dan mem-passing data $pizza. */
    }

   /*  
    * Function ini digunakan apabila member ingin mengakses halaman view cart, jadi sebelum diakses halaman tersebut
    * diambilah data cart member tersebut terlebih dahulu dan dimasukan ke dalam suatu variabel kemudian ketika
    * membuka page view cart tersebut dipassing lah parameter tersebut agar data-data cart tersebut dapat
    * ditampilkan dalam view 
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    public function showAllCart()
    {

        $user = auth()->user(); /* Validasi user. */

        $CartList = Cart::where("user_id", "=", $user->id)->get(); /* Mengambil data Cart dari table 'carts' yang memiliki UserID sesuai dengan user yang melakukan pemesanan (Add to Cart). Menggunakan model 'Cart' (Eloquent) untuk melakukannya. */

        return view('member.viewCart', ['list' => $CartList]); /* Mengembalikan view member.viewCart, dan mem-passing data 'list'. */
    }

    /* 
    * Function ini akan digunakan apabila member ingin mengupdate quantity item dalam cart nya dengan 
    * mengklik update button dalam view cart page sebelum di update akan dilakukan validasi
    * terlebih dahulu, data quantity yang diisi oleh member harus ada dan quantity-nya
    * harus diatas 0. Apabila tidak, akan muncul error message dan data quantity
    * tidak akan diupdate, sebaliknya apabila data yang dimasukan sudah valid
    * data quantity tersebut akan langsung di-update. 
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    public function updateQuantity(Request $request, Cart $item)
    {
        /* Validasi form. */
        $this->validate($request, ['Quantity' => 'required|numeric|min:1']); /* Tidak boleh kosong, dan harus diisi dengan angka yang bernilai minimal 1. */

        /* Validasi update quantity. */
        Cart::where("id", "=", $item->id)->update([
            'Quantity' => $request->Quantity /* Ambil data dari input 'quantity' pada form. */
        ]);

        Alert::success('Update Quantity Success!', 'Pizza quantity updated'); /* Menampilkan pesan sukses update quantity pesanan. Dibuat dengan menggunakan SweetAlert. */

        return redirect()->route('showcart'); /* Me-redirect ke route yang mempunyai name('showcart'). */
    }

    /* 
    * Function ini akan digunakan apabila member mengklik button delete pada page viewcart. Jadi,
    * dalam function ini kita delete salah satu item dalam cart berdasarkan bagian item yang
    * diklik, kemudian diambilah ID item yang ingin di delete untuk proses pencarian data
    * cart yang akan di delete dalam table cart database-nya.  
    *
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    public function deleteItemFromCart(Cart $item)
    {
        Cart::destroy($item->id);  /* Menghapus pesanan (Cart) dari table 'carts'. Menggunakan model 'Cart' (Eloquent) untuk melakukannya. */

        Alert::success('Delete Pizza Success!', 'Pizza deleted from cart'); /* Menampilkan pesan sukses menghapus pesanan (cart). Dibuat dengan menggunakan SweetAlert. */

        return redirect()->route('showcart'); /* Me-redirect ke route yang mempunyai name('showcart'). */
    }

    /* 
    * Function ini diakses ketika member ingin melakukan checkout terhadap daftar cart yang sudah mmereka masukan.
    * Data dalam cart tersebut akan menjadi 1 data header transaksi, dan beberapa data detail transaksi. Apabila
    * data pizza dalam cart tersebut lebih dari 1 data, setelah data cart dimasukan ke dalam tabel header
    * dan detail transaction, data cart member tersebut akan di-remove semua.
    *
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    public function checkout()
    {
        $user = auth()->user(); /* Validasi user. */

        /* Membuat Header Transaction baru. */
        HeaderTransaction::create([
            'UserId' => ($user->id) /* Ambil user_id dari user yang melakukan Checkout. */
        ]);

        $headertransaction = HeaderTransaction::latest('id')->first(); /* Mengurutkan data pada table 'headerTransactions berdasarkan waktu. Menggunakan model 'HeaderTransaction' (Eloquent) untuk melakukannya. */

        $CartList = Cart::where("user_id", "=", $user->id)->get(); /* Mengambil data Cart dari table 'carts' yang memiliki UserID sesuai dengan user yang melakukan pemesanan (Add to Cart). Menggunakan model 'Cart' (Eloquent) untuk melakukannya. */

        foreach ($CartList as $cart) { /* Dilakukan repetisi selama $CartList belum kosong. */
            DetailTransaction::create([ /* Membuat Detail Transaction baru pada table 'detailTransactions. Menggunakan model 'DetailTransaction' (Eloquent) untuk melakukannya. */
                'TransactionId' => ($headertransaction->id), /* Ambil TransactionId dari headerTransactionId. */
                'PizzaId' => ($cart->pizza_id), /* Ambil PizzaId dari pizza_id yang terdapat pada table 'carts'. */
                'Quantity' => ($cart->quantity) /* Ambil Quantity dari quantity yang terdapat pada table 'carts'. */
            ]);
        }

        Cart::where("user_id", "=", $user->id)->delete(); /* Menghapus Cart dari table 'carts' sesuai dengan user yang melakukan Checkout. */

        Alert::success('Checkout Success!', 'Cart successfully transfered to transaction'); /* Menampilkan pesan sukses melakukan Checkout. Dibuat dengan menggunakan SweetAlert. */

        return redirect()->route('home'); /* Me-redirect ke route yang mempunyai name('home'). */
    }
}
