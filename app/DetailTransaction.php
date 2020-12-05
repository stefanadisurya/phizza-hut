<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{

    protected $table = 'detailtransaction';

    protected $fillable = ['TransactionId','PizzaId','Quantity'];

    public function Pizza(){
        return $this->belongsTo(Pizza::class,'PizzaId');
    }

    public function HeaderTransaction(){
        return $this->belongsTo(HeaderTransaction::class,'TransactionId');
    }
}
