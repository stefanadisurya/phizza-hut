<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Model HeaderTransaction
    |--------------------------------------------------------------------------
    |
    | Model ini merupakan gambaran dari table 'headerTransactions' pada database.
    | Terdapat relationship hasMany kepada model 'DetailTransaction' dan
    | belongsTo kepada model 'User'.
    |
    | Made by @stefanadisurya & @ChristopherIrvine
    */

    /**
     * Nama table pada database.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $table = 'headertransactions';

    /**
     * Daftar atribut yang dapat diisi menggunakan mass assignment.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    protected $fillable = ['id','UserId'];

    /**
     * Eloquent Relationship kepada model 'DetailTransaction'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function DetailTransactions(){
        return $this->hasMany(DetailTransaction::class);
    }

    /**
     * Eloquent Relationship kepada model 'User'.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function User(){
        return $this->belongsTo(User::class,'UserId');
    }
}
