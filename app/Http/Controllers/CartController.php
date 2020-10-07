<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Customer;
use App\Product;
use App\Stock;

class CartController extends Controller
{

    public function getCart($id){
        $carts = Cart::leftJoin('products', 'carts.product_id','=','products.id')
        ->select('products.name','products.selling_price', 'carts.cart_quantity')
        ->where('carts.customer_id','=', $id)->get();

        $total = 0;
        foreach ($carts as $item) {
            $subtotal = $item->selling_price * $item->cart_quantity;
            $total += $subtotal;
        }

        return view('dashboard.order.cart')->with('carts', $carts)->with('subtotal', $total);
    }

    public function getRestockCart($id){
        $carts = Cart::with('product', 'stock')->where('customer_id', $id)->get();

        $total = 0;
        foreach ($carts as $item) {
            $subtotal = $item->stock->supplier_price * $item->cart_quantity;
            $total += $subtotal;
        }

        return view('dashboard.store.myorders.cart')->with('carts', $carts)->with('subtotal', $total);
    }

    public function setOrdered($id){
        $carts = Cart::select('product_id','customer_id')->where('customer_id', $id)->get()->toJson();

        return $carts;
    }

    public function getCartCount($id){
        $count = Cart::where('customer_id','=', $id)->count();

        return $count;
    }

    public function store(Request $request){
        $this->validate($request, [
            'product_id' => 'required|string',
            'cart_quantity' => 'required|integer',
            'customer_id' => 'required|string',
        ]);
        
        $product_id = $request->product_id;
        $cart_quantity = $request->cart_quantity;
        $customer_id = $request->customer_id;

        $stock = Stock::where('product_id','=', $product_id)->first();
        $maxQuantity = $stock->quantity;

        if ($cart_quantity <= $maxQuantity) {
            $cart = new Cart;
            $cart->product_id = $product_id;
            $cart->cart_quantity = $cart_quantity;
            $cart->customer_id = $customer_id;
            $cart->save();
        }else{
            $message = "Order quantity cannot exceed stock quantity";
            return $message;
        }
    }

    public function removeItem(Request $request){
        $product_id = $request->get('product_id');
        $customer_id = $request->get('customer_id');

        $cart = Cart::where('product_id', $product_id)->where('customer_id', $customer_id)->first();
        $cart->delete();
    }

    public function checkout($id){
        $carts = Cart::leftJoin('products', 'carts.product_id','=','products.id')
        ->select('products.name','products.selling_price', 'carts.cart_quantity')
        ->where('carts.customer_id','=', $id)->get();

        $total = 0;
        foreach ($carts as $item) {
            $subtotal = $item->selling_price * $item->cart_quantity;
            $total += $subtotal;
        }

        $customer = Customer::find($id);

        return view('dashboard.order.checkout')->with('carts', $carts)
        ->with('customer', $customer)->with('total', $total);
    }

    public function destroy($id){
        try {
            $cart = Cart::where('customer_id', $id)->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect('/customers/'.$id)->with('success', 'Order has been successfuly cancelled');
    }
}
