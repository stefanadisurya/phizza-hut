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

    public function showAllCart()
    {

        $user = auth()->user();

        $CartList = Cart::where("user_id", "=", $user->id)->get();

        return view('member.viewCart', ['list' => $CartList]);
    }

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

    public function deleteItemFromCart(Cart $item)
    {

        Cart::destroy($item->id);

        Alert::success('Delete Pizza Success!', 'Pizza deleted from cart');

        return redirect()->route('showcart');
    }

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

<<<<<<< HEAD
        // Cart::where('id','=',$item->id)->update([
        //     'Quantity' => (($cart->quantity) + ($request->quantity))
        // ]);

        Cart::where("user_id","=",$user->id)->delete();
=======
        Cart::where("user_id", "=", $user->id)->delete();
>>>>>>> a6c060514aa110a012f012f53b40d9a818659eb5

        Alert::success('Checkout Success!', 'Cart successfully transfered to transaction');

        return redirect()->route('home');
    }
}
