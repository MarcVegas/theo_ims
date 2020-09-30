<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function transaction(){
        return $this->belongsTo('App\Transaction');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function stock(){
        return $this->belongsTo('App\Stock', 'product_id', 'product_id');
    }
}
