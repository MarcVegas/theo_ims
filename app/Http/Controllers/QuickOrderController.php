<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Customer;

class QuickOrderController extends Controller
{
    public function quickOrder(){
        $id = (string) Str::uuid();
        $firstname = 'Customer';
        $lastname = rand(100,8000);
        $type = 'buyer';

        $customer = new Customer;
        $customer->id = $id;
        $customer->firstname = $firstname;
        $customer->lastname = $lastname;
        $customer->type = $type;
        $customer->save();

        return redirect('/shop/'.$id);
    }
}
