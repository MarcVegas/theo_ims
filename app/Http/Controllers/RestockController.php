<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Product;
use App\Customer;
use App\Supplier;
use App\Cart;
use App\Order;
use App\Stock;
use App\Transaction;

class RestockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::where('supplier_id','<>', '')->get();
        $credit = Transaction::where('supplier_id','<>', '')->where('type', 'credit')->count();
        $sum = Transaction::where('supplier_id','<>', '')->sum('balance');

        return view('dashboard.store.myorders.index')->with('transactions', $transactions)
        ->with('credit', $credit)->with('sum', $sum);
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
            'supplier_id' => 'required|string',
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
        $supplier_id = $request->input('supplier_id');

        if ($type == 'full') {
            if ($cash >= $total) {
                $change = $cash - $total;
                $this->saveTransaction($transaction_id,$type,$total,$cash,0,$change,'paid',$date,$supplier_id,$customer_id);
                $this->saveOrder($customer_id,$transaction_id);
                $this->restock($transaction_id);
                $this->clearCart($customer_id);
                return redirect('/restock/owner/complete/'.$transaction_id);
            }else {
                return redirect('/restock/owner/checkout/'.$customer_id)->with('error', 'Cash amount must be greater than order total for full payment transactions');
            }
        }elseif ($type == 'credit') {
            if ($cash < $total) {
                $balance = $total - $cash;
                $this->saveTransaction($transaction_id,$type,$total,$cash,$balance,0,'partial',$date,$supplier_id,$customer_id);
                $this->saveOrder($customer_id,$transaction_id);
                $this->restock($transaction_id);
                $this->clearCart($customer_id);
                return redirect('/orders/owner/complete/'.$transaction_id);
            }else{
                return redirect('/restock/owner/checkout/'.$customer_id)->with('error', 'Invalid cash amount. Payment amount must be less than total for credit transactions. Select Full Payment for fully paid transactions');
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
        $customer = Customer::where('type', 'owner')->first();
        $products = Product::has('stock')->where('supplier_id', $id)->where('removed', false)->get();
        $supplier = Supplier::select('id','business_name')->find($id);

        return view('dashboard.store.myorders.myorder')->with('products', $products)
        ->with('customer', $customer)->with('supplier', $supplier);
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

    public function checkout(Request $request){
        /* $carts = Cart::leftJoin('products', 'carts.product_id','=','products.id')
        ->select('products.name','products.selling_price', 'carts.cart_quantity')
        ->where('carts.customer_id','=', $id)->get(); */

        $customer_id = $request->get('customer_id');
        $supplier_id = $request->get('supplier_id');

        $carts = Cart::with('product', 'stock')->where('customer_id', $customer_id)->get();

        $total = 0;
        foreach ($carts as $item) {
            $subtotal = $item->stock->supplier_price * $item->cart_quantity;
            $total += $subtotal;
        }

        $customer = Customer::find($customer_id);
        $supplier = Supplier::find($supplier_id);

        return view('dashboard.store.myorders.checkout')->with('carts', $carts)
        ->with('customer', $customer)->with('supplier', $supplier)->with('total', $total);
    }

    public function complete($id){
        $transaction = Transaction::has('customer')->find($id);

        return view('dashboard.order.complete')->with('transaction', $transaction);
    }

    public function saveTransaction($id, $type, $total, $cash, $balance, $change, $status, $date, $supplier, $customer){
        $transaction = new Transaction;
        $transaction->id = $id;
        $transaction->type = $type;
        $transaction->total = $total;
        $transaction->cash = $cash;
        $transaction->balance = $balance;
        $transaction->change = $change;
        $transaction->status = $status;
        $transaction->transaction_date = $date;
        $transaction->supplier_id = $supplier;
        $transaction->customer_id = $customer;
        $transaction->save();
    }

    public function saveOrder($customer_id, $transaction_id){
        $carts = Cart::with('product', 'stock')->where('customer_id', $customer_id)->get();

        foreach ($carts as $item) {
            $subtotal = $item->stock->supplier_price * $item->cart_quantity;
            $order = new Order;
            $order->product_id = $item->product_id;
            $order->order_quantity = $item->cart_quantity;
            $order->order_price = $item->stock->supplier_price;
            $order->subtotal = $subtotal;
            $order->transaction_id = $transaction_id;
            $order->save();
        }
    }

    public function restock($transaction_id){
        $order = Order::with('stock')->where('transaction_id', $transaction_id)->get();

        try {
            foreach ($order as $item) {
                $addedQnty = $item->stock->quantity + $item->order_quantity;
                $stock = Stock::where('product_id', $item->product_id)->first();
                $stock->quantity = $addedQnty;
                $stock->save();
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function clearCart($customer_id){
        $cart = Cart::where('customer_id', $customer_id)->delete();
    }
}
