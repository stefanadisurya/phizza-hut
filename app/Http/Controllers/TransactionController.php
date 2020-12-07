<?php

namespace App\Http\Controllers;

use App\DetailTransaction;
use App\HeaderTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
    // function ini hanya dapat diakses oleh member ketika mereka ingin melihat history dari
    // transaksi yang sudah mereka lakukan 
    function show(){

        $user = auth()->user();

        $transaction = HeaderTransaction::where("UserId","=",$user->id)->get();

        return view('member.showusertransaction',['transactionlist' => $transaction]);

    }

    //code dalam function ini berfungsi untuk mengakses page show all transaction dan juga 
    // menunjukan semua daftar transaksi yang sudah di checkout oleh semua user
    // jadi function ini hanya bisa diakses oleh admin untuk mengakses page show all transaction dengan
    // 1 parameter variable yang berisi data-data dari semua transaksi yang sudah di lakukan oleh semua user
    function showall(){

        $transaction = HeaderTransaction::all();

        return view('admin.showalltransaction',['transactionlist' => $transaction]);

    }


    //code dalam function ini digunakan ketika admin ingin melihat salah satu detail transaksi member dan
    //code dalam function ini juga bisa digunakan oleh member ketika mereka ingin melihat salah satu detail transaksi
    //yang sudah dilakukan oleh member tersebut 
    function showdetailtransaction(HeaderTransaction $Htrans){

        $detailtransaction = DetailTransaction::where("TransactionId","=",$Htrans->id)->get();

        return view('showdetailtransaction',['detailtransactionlist' => $detailtransaction]);

        
    }


}
