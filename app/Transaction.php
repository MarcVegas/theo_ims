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
        return $this->hasMany('App\Order');
    }
}
