<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use App\Transaction;
use App\Order;
use App\Product;
use App\Customer;

class ReportsController extends Controller
{
    public function index(){
        $customers = Customer::where('type', 'reseller')->get();

        return view('dashboard.general.report')->with('customers', $customers);
    }

    public function orders(Request $request){
        $from = '';
        $to = '';
        if ($request->has('from') && $request->has('to')) {
            $from = Carbon::parse($request->get('from'))->startOfDay();
            $to = Carbon::parse($request->get('to'))->endOfDay();
        }

        if ($from != '' && $to != '') {
            $orders = Order::has('product')->whereBetween('created_at',[$from, $to])->latest()->get();
        }else {
            $orders = Order::has('product')->latest()->get();
        }

        $columns = array("Name","Category","Qnty","Price","Subtotal","Purchased On");

        return view('dashboard.general.ordertable')->with('orders', $orders)
        ->with('columns', $columns);
    }

    public function customerOrders(Request $request, $id){
        $from = '';
        $to = '';
        if ($request->has('from') && $request->has('to')) {
            $from = Carbon::parse($request->get('from'))->startOfDay();
            $to = Carbon::parse($request->get('to'))->endOfDay();
        }

        if ($from != '' && $to != '') {
            $orders = Order::has('product')->whereHas('transaction', function($q) use ($id){
                $q->where('customer_id', $id);
            })->whereBetween('created_at',[$from, $to])->latest()->get();
        }else {
            $orders = Order::has('product')->whereHas('transaction', function($q) use ($id){
                $q->where('customer_id', $id);
            })->latest()->get();
        }

        $columns = array("Name","Category","Qnty","Price","Subtotal","Purchased On");

        return view('dashboard.general.ordertable')->with('orders', $orders)
        ->with('columns', $columns);
    }

    public function transactions(Request $request){
        $from = '';
        $to = '';
        if ($request->has('from') && $request->has('to')) {
            $from = Carbon::parse($request->get('from'))->startOfDay();
            $to = Carbon::parse($request->get('to'))->endOfDay();
        }

        if ($from != '' && $to != '') {
            $transactions = Transaction::where('supplier_id','=', null)->whereBetween('created_at',[$from, $to])->latest()->get();
        }else {
            $transactions = Transaction::where('supplier_id','=', null)->latest()->get();
        }

        $columns = array("Date","Type","Total","Cash","Balance","Change","Status");

        return view('dashboard.general.transactiontable')->with('transactions', $transactions)
        ->with('columns', $columns);
    }

    public function customerTransactions(Request $request,$id){
        $from = '';
        $to = '';
        if ($request->has('from') && $request->has('to')) {
            $from = Carbon::parse($request->get('from'))->startOfDay();
            $to = Carbon::parse($request->get('to'))->endOfDay();
        }

        if ($from != '' && $to != '') {
            $transactions = Transaction::where('customer_id', $id)->whereBetween('created_at',[$from, $to])->latest()->get();
        }else {
            $transactions = Transaction::where('customer_id', $id)->latest()->get();
        }

        $columns = array("Date","Type","Total","Cash","Balance","Change","Status");

        return view('dashboard.general.transactiontable')->with('transactions', $transactions)
        ->with('columns', $columns);
    }

    public function products(){
        $products = Product::has('stock')->get();
        $columns = array("Name","Category","Supplier Price","Selling Price","Difference","Quantity");
        
        return view('dashboard.general.producttable')->with('products', $products)->with('columns', $columns);
    }
}
