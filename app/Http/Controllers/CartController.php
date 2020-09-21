<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Customer;
use App\Product;

class CartController extends Controller
{
    public function getCart($id){
        $carts = Customer::has('cart')->find($id)->toJson();

        return $carts;
    }

    public function getCartCount($id){
        $count = Cart::count()->where('customer_id','=', $id)->get()->toJson();

        return $count;
    }

    public function store(Request $request){
        
    }

    public function removeItem(Request $request){
        
    }

    public function destroy($id){

    }
}
