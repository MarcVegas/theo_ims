<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    public function transaction(){
        return $this->hasMany('App\Transaction','customer_id');
    }

    public function cart(){
        return $this->hasMany('App\Cart','customer_id');
    }
}
