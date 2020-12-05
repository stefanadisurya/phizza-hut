<?php

namespace App\Http\Controllers;

use App\DetailTransaction;
use App\HeaderTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
    function show(){

        $user = auth()->user();

        $transaction = HeaderTransaction::where("UserId","=",$user->id)->get();

        return view('member.showusertransaction',['transactionlist' => $transaction]);

    }

    function showall(){

        $transaction = HeaderTransaction::all();

        return view('admin.showalltransaction',['transactionlist' => $transaction]);

    }

    function showdetailtransaction(HeaderTransaction $Htrans){

        $detailtransaction = DetailTransaction::where("TransactionId","=",$Htrans->id)->get();

        return view('showdetailtransaction',['detailtransactionlist' => $detailtransaction]);

        
    }


}
