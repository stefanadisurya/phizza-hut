<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DetailTransaction;
use App\HeaderTransaction;
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

        $user = auth()->user();

        $CartList = Cart::where("UserId","=",$user->id)->get();

        return view('showcart',['list' => $CartList]);
        

    }

    public function updateQuantity(Request $request, Cart $item){
        
        // $user = auth()->user();

        // echo json_encode($item);
        // die();
        

        $this->validate($request, ['Quantity' => 'required|numeric|min:1']);

       
        
        Cart::where("id","=",$item->id)->update([
            'Quantity' => $request->Quantity
        ]);

        

        Alert::success('Update quantity From Cart Success', 'Quantity updated');
        
        return redirect()->route('showcart');


    }

    public function deleteItemFromCart(Cart $item){

        Cart::destroy($item->id);

        Alert::success('Delete Item From Cart Success', 'Pizza Deleted from cart');
        
        return redirect()->route('showcart');


    }

    public function checkout(){

        $user = auth()->user();

        HeaderTransaction :: create([
            'UserId' => ($user->id)
        ]);

        $headertransaction = HeaderTransaction :: latest('id')->first();

        // echo json_encode($headertransaction);
        // die();

        $CartList = Cart::where("UserId","=",$user->id)->get();
        
        foreach($CartList as $cart){

            DetailTransaction :: create([
                'TransactionId' => ($headertransaction->id),
                'PizzaId' => ($cart->PizzaId),
                'Quantity' => ($cart->Quantity)
            ]);

        }

        Cart::where("UserId","=",$user->id)->delete();

        Alert::success('Cart checkout Success', 'Cart successfully transfered to transaction');
        
        return redirect()->route('home');

    }




}
