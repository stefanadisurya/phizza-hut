<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'carts';

    protected $fillable = ['user_id', 'pizza_id', 'quantity'];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class, 'pizza_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
