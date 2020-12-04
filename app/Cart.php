<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'Cart';

    protected $fillable = ['UserId','PizzaId','Quantity'];
    
    public function Pizza(){
        return $this->belongsTo(Pizza::class,'PizzaId');
    }

    public function User(){
        return $this->belongsTo(User::class,'UserId');
    }




}
