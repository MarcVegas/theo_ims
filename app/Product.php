<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    public function stock(){
        return $this->hasOne('App\Stock', 'product_id');
    }

    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }

    public function cart(){
        return $this->hasOne('App\Cart', 'product_id');
    }

    public function order(){
        return $this->hasOne('App\Order', 'product_id');
    }

    public function notification(){
        return $this->hasOne('App\Notification', 'product_id');
    }
}
