<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function stock(){
        return $this->belongsTo('App\Stock', 'product_id', 'product_id');
    }
}
