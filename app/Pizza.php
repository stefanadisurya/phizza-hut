<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Model Pizza
    |--------------------------------------------------------------------------
    |
    | Model ini merupakan gambaran dari table 'pizzas' pada database.
    | Terdapat relationship hasMany kepada model 'DetailTransaction'
    | dan'Cart'.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */
    
    /**
     * Nama table pada database.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $table = 'pizzas';

    /**
     * Daftar atribut yang dapat diisi menggunakan mass assignment.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $fillable = [
        'name', 'price', 'description', 'image'
    ];

    /**
     * Eloquent Relationship kepada model 'DetailTransaction'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function DetailTransactions(){
        return $this->hasMany(DetailTransaction::class);
    }

    /**
     * Eloquent Relationship kepada model 'Cart'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
