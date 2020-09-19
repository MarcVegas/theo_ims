<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }
}
