<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function order(){
        return $this->hasMany('App\Order', 'transaction_id');
    }

    public function deposit(){
        return $this->hasMany('App\Deposit', 'transaction_id');
    }

    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }
}
