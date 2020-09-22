<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Customer;
use App\Product;
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
            if ($cash > $total) {
                $change = $cash - $total;
                $this->saveTransaction($transaction_id,$type,$total,$cash,0,$change,'paid',$date,$customer_id);
            }else {
                return view('dashboard.order.checkout')->with('error', 'Cash amount must be greater than order total for full payment transactions');
            }
        }elseif ($type == 'credit') {
            # code...
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
        //
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
        $products = Product::has('stock')->get();

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

}
