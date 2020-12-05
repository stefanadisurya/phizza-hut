<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{

    public function DetailTransactions(){
        return $this->hasMany(DetailTransaction::class);
    }
    
    protected $table = 'pizzas';

    protected $fillable = [
        'name', 'price', 'description', 'image'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
