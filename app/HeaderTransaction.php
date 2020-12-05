<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    protected $table = 'headertransaction';

    protected $fillable = ['id','UserId'];

    public function DetailTransaction(){
        return $this->hasMany(DetailTransaction::class);
    }

    public function User(){
        return $this->belongsTo(User::class,'UserId');
    }
}
