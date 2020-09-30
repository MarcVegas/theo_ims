<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function cart(){
        return $this->hasOne('App\Cart');
    }

    public function order(){
        return $this->hasOne('App\Order');
    }
}
