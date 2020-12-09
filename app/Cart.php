<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Model Cart
    |--------------------------------------------------------------------------
    |
    | Model ini merupakan gambaran dari table 'carts' pada database.
    | Terdapat relationship belongsTo kepada model 'Pizza' dan
    | 'User'.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    /**
     * Nama table pada database.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $table = 'carts';

    /**
     * Daftar atribut yang dapat diisi menggunakan mass assignment.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $fillable = ['user_id', 'pizza_id', 'quantity'];

    /**
     * Eloquent Relationship kepada model 'Pizza'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function pizza()
    {
        return $this->belongsTo(Pizza::class, 'pizza_id');
    }

    /**
     * Eloquent Relationship kepada model 'User'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
