<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Pizza;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{

    public function storeToCart(Request $request, Pizza $pizza)
    {

        $user = auth()->user();

        $this->validate($request, ['quantity' => 'required|numeric|min:1']);

        Cart::create([
            'user_id' => $user->id,
            'pizza_id' => $pizza->id,
            'quantity' => $request->quantity
        ]);

        Alert::success('Add to Cart Success!', 'Pizza added to your cart');

        return redirect()->route('show', $pizza);
    }

    public function showAllCart()
    {
    }
}
