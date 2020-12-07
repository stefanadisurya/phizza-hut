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

    // function ini digunakan oleh member ketika mereka ingin memasukan produk pizza yang mereka inginkan ke dalam cart
    //sebelum dimasukkan ke dalam database terdapat proses validasi terlebih dahulu terhadap data quantity yang dimasukkan 
    //data quantity yng dimasukkan harus ada dan nilainya mesti lebih dari 0 apabila tidak memenuhi persyaratan tersebut akan
    //muncul error message dan datanya tidak akan dimasukkan ke dalam database, sebaliknya apabila sudah memenuhi persyaratan tersebut
    //data-data pizza dan member tersebut akan langsung dimasukkan ke dalam database
    public function storeToCart(Request $request, Pizza $pizza)
    {

        $user = auth()->user();

        $this->validate($request, ['quantity' => 'required|numeric|min:1']);

        if (Cart::where("user_id", "=", $user->id)->count() > 0 && Cart::where("pizza_id", "=", $pizza->id)->count() > 0) {
            Cart::where([["user_id", "=", $user->id], ["pizza_id", "=", $pizza->id]])->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id' => $user->id,
                'pizza_id' => $pizza->id,
                'quantity' => $request->quantity
            ]);
        }

        Alert::success('Add to Cart Success!', 'Pizza added to cart');

        return redirect()->route('show', $pizza);
    }

    //function ini digunakan apabila member ingin mengakses halaman view cart, jadi sebelum diakses halaman tersebut
    //diambilah data cart member tersebut terlebih dahulu dan dimasukan ke dalam suatu variabel kemudian ketika
    //membuka page view cart tersebut dipassing lah parameter tersebut agar data-data cart tersebut dapat ditampilkan
    // dalam view
    public function showAllCart()
    {

        $user = auth()->user();

        $CartList = Cart::where("user_id", "=", $user->id)->get();

        return view('member.viewCart', ['list' => $CartList]);
    }

    //function ini akan digunakan apabila member ingin mengupdate quantity item dalam cart nya dengan 
    // mengklik update button dalam view cart page
    //sebelum di update akan dilakukan validasi terlebih dahulu, data quantity yang diisi oleh member
    //harus ada dan quantity nya harus diatas 0 apabile tidak akan muncul error message dan data quantity
    //tidak akan diupdate sebaliknya apabila data yang dimasukan sudah valid data quantity tersebut akan
    //langsung diupdate
    public function updateQuantity(Request $request, Cart $item)
    {

        // $user = auth()->user();

        // echo json_encode($item);
        // die();


        $this->validate($request, ['Quantity' => 'required|numeric|min:1']);



        Cart::where("id", "=", $item->id)->update([
            'Quantity' => $request->Quantity
        ]);



        Alert::success('Update Quantity Success!', 'Pizza quantity updated');

        return redirect()->route('showcart');
    }

    //function ini akan digunakan apabila member mengklik button delete pada page viewcart
    //jadi dalam function ini kita delete salah satu item dalam cart berdasarkan bagian item yang diklik
    //kemudian diambilah id item yang ingin di delete untuk proses pencarian data cart yang akan di delete
    // dalam table cart database nya 
    public function deleteItemFromCart(Cart $item)
    {

        Cart::destroy($item->id);

        Alert::success('Delete Pizza Success!', 'Pizza deleted from cart');

        return redirect()->route('showcart');
    }

    // function ini diakses ketika member ingin melakukan checkout terhadap daftar cart yang sudah mmereka masukan
    // data dalam cart tersebut akan menjadi 1 data header transaksi dan beberapa data detail transaksi apabila data pizza
    // dalam cart tersebut lebih dari 1 data, setelah data cart dimasukan ke dalam tabel header dan detail transaction
    // data cart member tersebut akan di remove semua
    public function checkout()
    {

        $user = auth()->user();

        HeaderTransaction::create([
            'UserId' => ($user->id)
        ]);

        $headertransaction = HeaderTransaction::latest('id')->first();

        // echo json_encode($headertransaction);
        // die();

        $CartList = Cart::where("user_id", "=", $user->id)->get();

        foreach ($CartList as $cart) {

            DetailTransaction::create([
                'TransactionId' => ($headertransaction->id),
                'PizzaId' => ($cart->pizza_id),
                'Quantity' => ($cart->quantity)
            ]);
        }

        Cart::where("user_id", "=", $user->id)->delete();

        Alert::success('Checkout Success!', 'Cart successfully transfered to transaction');

        return redirect()->route('home');
    }
}
