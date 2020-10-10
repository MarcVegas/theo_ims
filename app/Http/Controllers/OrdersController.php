<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Customer;
use App\Product;
use App\Cart;
use App\Order;
use App\Stock;
use App\Transaction;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|string',
            'transaction_type' => 'required|string',
            'total' => 'required|numeric',
            'cash' => 'required|numeric',
        ]);

        $transaction_id = (string) Str::uuid();
        $type = $request->input('transaction_type');
        $total = $request->input('total');
        $cash = $request->input('cash');
        $date = Carbon::now()->toDateString();
        $customer_id = $request->input('customer_id');

        if ($type == 'full') {
            if ($cash >= $total) {
                $change = $cash - $total;
                $this->saveTransaction($transaction_id,$type,$total,$cash,0,$change,'paid',$date,$customer_id);
                $this->saveOrder($customer_id,$transaction_id);
                $this->deduct($transaction_id);
                $this->clearCart($customer_id);
                cache()->forget('best-products');
                cache()->forget('best-customers');
                return redirect('/orders/'.$transaction_id);
            }else {
                return redirect('/checkout/'.$customer_id)->with('error', 'Cash amount must be greater than order total for full payment transactions');
            }
        }elseif ($type == 'credit') {
            if ($cash < $total) {
                $balance = $total - $cash;
                $this->saveTransaction($transaction_id,$type,$total,$cash,$balance,0,'partial',$date,$customer_id);
                $this->saveOrder($customer_id,$transaction_id);
                $this->deduct($transaction_id);
                $this->clearCart($customer_id);
                cache()->forget('best-products');
                cache()->forget('best-customers');
                return redirect('/orders/'.$transaction_id);
            }else{
                return redirect('/checkout/'.$customer_id)->with('error', 'Invalid cash amount. Payment amount must be less than total for credit transactions. Select Full Payment for fully paid transactions');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::has('customer')->find($id);
        cache()->forget('transactions-all');

        return view('dashboard.order.complete')->with('transaction', $transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function shop($id)
    {
        $customer = Customer::find($id);
        $products = Product::has('stock')->where('removed', false)->get();

        return view('dashboard.order.index')->with('customer', $customer)->with('products', $products);
    }

    public function saveTransaction($id, $type, $total, $cash, $balance, $change, $status, $date, $customer){
        $transaction = new Transaction;
        $transaction->id = $id;
        $transaction->type = $type;
        $transaction->total = $total;
        $transaction->cash = $cash;
        $transaction->balance = $balance;
        $transaction->change = $change;
        $transaction->status = $status;
        $transaction->transaction_date = $date;
        $transaction->customer_id = $customer;
        $transaction->save();
    }

    public function saveOrder($customer_id, $transaction_id){
        /* $carts = Cart::leftJoin('products', 'carts.product_id','=','products.id')
        ->select('products.id','products.selling_price', 'carts.cart_quantity')
        ->where('carts.customer_id','=', $customer_id)->get(); */

        $carts = Cart::with('product', 'stock')->where('customer_id', $customer_id)->get();

        foreach ($carts as $item) {
            $subtotal = $item->product->selling_price * $item->cart_quantity;
            $order = new Order;
            $order->product_id = $item->product_id;
            $order->order_quantity = $item->cart_quantity;
            $order->order_price = $item->product->selling_price;
            $order->subtotal = $subtotal;
            $order->transaction_id = $transaction_id;
            $order->save();
        }
    }

    public function deduct($transaction_id){
        $order = Order::select('product_id','order_quantity','transaction_id')->with('stock')->where('transaction_id', $transaction_id)->get();

        try {
            foreach ($order as $item) {
                $deductedQnty = $item->stock->quantity - $item->order_quantity;
                $stock = Stock::where('product_id', $item->product_id)->first();
                $stock->quantity = $deductedQnty;
                $stock->save();
            }
        } catch (\Exception $e) {
            return view('errors.db')->with('error', $e->getMessage());
        }
    }

    public function clearCart($customer_id){
        $cart = Cart::where('customer_id', $customer_id)->delete();
    }

}
