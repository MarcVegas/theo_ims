<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
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

    public function orders(){
        $orders = Order::has('product')->latest()->get();
        $columns = array("Name","Category","Qnty","Price","Subtotal");

        return view('dashboard.general.ordertable')->with('orders', $orders)
        ->with('columns', $columns);
    }

    public function customerOrders($id){
        $orders = Order::has('product')->whereHas('transaction', function($q) use ($id){
            $q->where('customer_id', $id);
        })->latest()->get();
        $columns = array("Name","Category","Qnty","Price","Subtotal");

        return view('dashboard.general.ordertable')->with('orders', $orders)
        ->with('columns', $columns);
    }

    public function transactions(){
        $transactions = Transaction::where('supplier_id','=', null)->latest()->get();
        $columns = array("Date","Type","Total","Cash","Balance","Change","Status");

        return view('dashboard.general.transactiontable')->with('transactions', $transactions)
        ->with('columns', $columns);
    }

    public function customerTransactions($id){
        $transactions = Transaction::where('customer_id', $id)->latest()->get();
        $columns = array("Date","Type","Total","Cash","Balance","Change","Status");

        return view('dashboard.general.transactiontable')->with('transactions', $transactions)
        ->with('columns', $columns);
    }

    public function products(){
        
    }
}
