<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{

    public function DetailTransaction(){
        return $this->hasMany(DetailTransaction::class);
    }
    
    public function Cart(){
        return $this->hasMany(Cart::class);
    }
    
    protected $table = 'pizzas';

    protected $fillable = [
        'name', 'price', 'description', 'image'
    ];
}
