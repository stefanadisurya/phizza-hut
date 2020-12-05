<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{

    protected $table = 'detailtransactions';

    protected $fillable = ['TransactionId','PizzaId','Quantity'];

    public function Pizza(){
        return $this->belongsTo(Pizza::class,'PizzaId');
    }

    public function HeaderTransactions(){
        return $this->belongsTo(HeaderTransaction::class,'TransactionId');
    }
}
