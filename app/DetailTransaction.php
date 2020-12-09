<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Model DetailTransaction
    |--------------------------------------------------------------------------
    |
    | Model ini merupakan gambaran dari table 'detailTransactions' pada database.
    | Terdapat relationship belongsTo kepada model 'Pizza' dan
    | 'HeaderTransaction'.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    /**
     * Nama table pada database.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $table = 'detailtransactions';

    /**
     * Daftar atribut yang dapat diisi menggunakan mass assignment.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $fillable = ['TransactionId','PizzaId','Quantity'];

    /**
     * Eloquent Relationship kepada model 'Pizza'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function Pizza(){
        return $this->belongsTo(Pizza::class,'PizzaId');
    }

    /**
     * Eloquent Relationship kepada model 'HeaderTransaction'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function HeaderTransactions(){
        return $this->belongsTo(HeaderTransaction::class,'TransactionId');
    }
}
