<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    public function product(){
        return $this->hasMany('App\Product');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction', 'supplier_id');
    }
}
