<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Customer;
use App\Deposit;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::has('customer')->where('supplier_id','=', null)->latest()->get();
        $creditCount = Transaction::where('type', 'credit')->count();
        $sum = Transaction::where('type', 'credit')->sum('balance');

        return view('dashboard.mgmt.transactions.transaction')->with('transactions', $transactions)
        ->with('count', $creditCount)->with('sum', $sum);
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
        //
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
        $deposits = Deposit::where('transaction_id', $id)->get();

        return view('dashboard.mgmt.transactions.show')->with('transaction', $transaction)->with('deposits', $deposits);
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

    public function invoice($id){
        $transaction = Transaction::find($id);

        return view('dashboard.order.invoice')->with('transaction', $transaction);
    }
}
