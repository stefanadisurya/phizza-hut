<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Pizza;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    
    public function StoreToCart(Request $request, Pizza $pizza){

        $user = auth()->user();

        $this->validate($request, ['Quantity' => 'required|numeric|min:1']);

        Cart::create([
            'UserId' => ($user->id),
            'PizzaId' => $pizza->id,
            'Quantity' => $request->Quantity
        ]);

        Alert::success('Add to cart Success', 'Pizza added to the cart');
        
        return redirect()->route('PizzaDetailInfo',$pizza);

    }

    public function showAllCart(){

        

    }



}
