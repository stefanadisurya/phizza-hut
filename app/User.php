<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /*
    |--------------------------------------------------------------------------
    | Model User
    |--------------------------------------------------------------------------
    |
    | Model ini merupakan gambaran dari table 'users' pada database.
    | Terdapat relationship hasMany kepada model
    | 'HeaderTransaction' dan 'Cart'.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    use Notifiable;

    /**
     * Daftar atribut yang dapat diisi menggunakan mass assignment.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $fillable = [
        'UserId', 'username', 'role', 'email', 'password', 'address', 'phoneNumber', 'gender'
    ];

     /**
     * Daftar atribut yang disembunyikan untuk array.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Daftar atribut yang harus diisi dengan tipe native.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Eloquent Relationship kepada model 'HeaderTransaction'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function HeaderTransactions(){
        return $this->hasMany(HeaderTransaction::class);
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
