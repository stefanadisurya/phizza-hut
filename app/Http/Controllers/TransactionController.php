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
    | admin atau member dapat melihat data-data transaksi. 
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    /* 
    * Function ini hanya dapat diakses oleh member ketika mereka ingin melihat history dari
    * transaksi yang sudah mereka lakukan.
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    function show(){

        $user = auth()->user(); /* Validasi user. */

        $transaction = HeaderTransaction::where("UserId","=",$user->id)->get(); /* Mengambil data Header Transaction dari table 'headerTransactions' yang memiliki UserID sesuai dengan user yang melakukan transaksi tersebut. Menggunakan model 'HeaderTransaction' (Eloquent) untuk melakukannya. */

        return view('member.showusertransaction',['transactionlist' => $transaction]); /* Mengembalikan view member.showusertransaction, dan mem-passing data 'transactionlist'. */

    }

    /* 
    * Code dalam function ini berfungsi untuk mengakses page show all transaction, dan juga 
    * menunjukan semua daftar transaksi yang sudah di checkout oleh semua user.
    * Function ini hanya dapat diakses oleh admin untuk mengakses page
    * show all transaction dengan 1 parameter variable yang berisi
    * data-data dari semua transaksi yang sudah di lakukan oleh
    * semua user.
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    function showall(){

        $transaction = HeaderTransaction::all(); /* Mengambil data seluruh Header Transaction dari table 'headerTransactions'. Menggunakan model 'HeaderTransaction' (Eloquent) untuk melakukannya. */

        return view('admin.showalltransaction',['transactionlist' => $transaction]); /* Mengembalikan view admin.showalltransaction, dan mem-passing data 'transactionlist'. */

    }


    /* 
    * Code dalam function ini digunakan ketika admin ingin melihat salah satu detail transaksi member, dan
    * code dalam function ini juga bisa digunakan oleh member ketika mereka ingin melihat salah satu
    * detail transaksi yang sudah dilakukan oleh member tersebut.
    *
    * Made by @stefanadisurya & @ChristopherIrvine
    */
    function showdetailtransaction(HeaderTransaction $Htrans){

        $detailtransaction = DetailTransaction::where("TransactionId","=",$Htrans->id)->get(); /* Mengambil data Detail Transaction dari table 'detailTransactions' yang memiliki headerTransactionID yang sesuai dengan Detail Transaction tersebut. Menggunakan model 'DetailTransaction' (Eloquent) untuk melakukannya.  */

        return view('showdetailtransaction',['detailtransactionlist' => $detailtransaction]); /* Mengembalikan view showdetailtransaction, dan mem-passing data 'detailtransactionlist'. */
    }


}
