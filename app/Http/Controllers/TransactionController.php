<?php

namespace App\Http\Controllers;

use App\DetailTransaction;
use App\HeaderTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
     /*
    |--------------------------------------------------------------------------
    | Transaction Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini digunakan untuk mengatur logic flow transaction yang dapat digunakan
    | oleh user dengan role 'admin' dan 'member'. Dengan adanya controller ini
    | admin atau member dapat melihat data-data transaksi 
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */


    /* 
    * Function ini hanya dapat diakses oleh member ketika mereka ingin melihat history dari
    * transaksi yang sudah mereka lakukan  
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    function show(){

        $user = auth()->user();

        $transaction = HeaderTransaction::where("UserId","=",$user->id)->get();

        return view('member.showusertransaction',['transactionlist' => $transaction]);

    }

    /* 
    * Code dalam function ini berfungsi untuk mengakses page show all transaction dan juga 
    * menunjukan semua daftar transaksi yang sudah di checkout oleh semua user
    * jadi function ini hanya bisa diakses oleh admin untuk mengakses page show all transaction dengan
    * 1 parameter variable yang berisi data-data dari semua transaksi yang sudah di lakukan oleh semua user
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    function showall(){

        $transaction = HeaderTransaction::all();

        return view('admin.showalltransaction',['transactionlist' => $transaction]);

    }


    /* 
    * Code dalam function ini digunakan ketika admin ingin melihat salah satu detail transaksi member dan
    * code dalam function ini juga bisa digunakan oleh member ketika mereka ingin melihat salah satu detail transaksi
    * yang sudah dilakukan oleh member tersebut 
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    function showdetailtransaction(HeaderTransaction $Htrans){

        $detailtransaction = DetailTransaction::where("TransactionId","=",$Htrans->id)->get();

        return view('showdetailtransaction',['detailtransactionlist' => $detailtransaction]);

        
    }


}
