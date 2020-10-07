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
        $products = Product::has('stock')->where('removed', false)->get();
        $columns = array("Name","Category","Supplier Price","Selling Price","Difference","Quantity");
        
        return view('dashboard.general.producttable')->with('products', $products)->with('columns', $columns);
    }

    public function exportOrders(Request $request){
        $from = '';
        $to = '';
        $hasDates = false;
        $customer_id = '';
        $customer = '';
        $owner = Customer::where('type', 'owner')->first();

        if ($request->has('from') && $request->has('to')) {
            $from = Carbon::parse($request->get('from'))->startOfDay();
            $to = Carbon::parse($request->get('to'))->endOfDay();
            $hasDates = true;
        }

        if ($request->has('customer_id')) {
            $customer_id = $request->get('customer_id');
            $customer = Customer::find($customer_id);
        }

        if ($hasDates == true && $customer_id == '') {
            $orders = Order::has('product')->whereBetween('created_at',[$from, $to])->latest()->get();

        }else if($hasDates == true && $customer_id != ''){
            $orders = Order::has('product')->whereHas('transaction', function($q) use ($customer_id){
                $q->where('customer_id', $customer_id);
            })->whereBetween('created_at',[$from, $to])->latest()->get();

        }else if($hasDates == false && $customer_id != ''){
            $orders = Order::has('product')->whereHas('transaction', function($q) use ($customer_id){
                $q->where('customer_id', $customer_id);
            })->latest()->get();

        }else {
            $orders = Order::has('product')->latest()->get();
        }
        
        $columns = array("Name","Category","Qnty","Price","Subtotal","Purchased On");

        $pdf = PDF::loadView('dashboard.general.export.orders', [
            'orders' => $orders,
            'customer' => $customer,
            'owner' => $owner,
            'columns' => $columns,
            'from' => $from,
            'to' => $to,
        ]);
        $date = Carbon::now();
        $pdfName = 'OrderReport'.$date.'.pdf';

        return $pdf->download($pdfName);
    }

    public function exportTransactions(Request $request){
        $from = '';
        $to = '';
        $hasDates = false;
        $customer_id = '';
        $customer = '';
        $owner = Customer::where('type', 'owner')->first();

        if ($request->has('from') && $request->has('to')) {
            $from = Carbon::parse($request->get('from'))->startOfDay();
            $to = Carbon::parse($request->get('to'))->endOfDay();
            $hasDates = true;
        }

        if ($request->has('customer_id')) {
            $customer_id = $request->get('customer_id');
            $customer = Customer::find($customer_id);
        }

        if ($hasDates == true && $customer_id == '') {
            $transactions = Transaction::where('supplier_id','=', null)->whereBetween('created_at',[$from, $to])->latest()->get();

        }else if($hasDates == true && $customer_id != ''){
            $transactions = Transaction::where('customer_id', $customer_id)->whereBetween('created_at',[$from, $to])->latest()->get();

        }else if($hasDates == false && $customer_id != ''){
            $transactions = Transaction::where('customer_id', $customer_id)->latest()->get();

        }else {
            $transactions = Transaction::where('supplier_id','=', null)->latest()->get();
        }
        
        $columns = array("Date","Type","Total","Cash","Balance","Change","Status");

        $pdf = PDF::loadView('dashboard.general.export.transactions', [
            'transactions' => $transactions,
            'customer' => $customer,
            'owner' => $owner,
            'columns' => $columns,
            'from' => $from,
            'to' => $to,
        ]);
        $date = Carbon::now();
        $pdfName = 'TransactionReport'.$date.'.pdf';

        return $pdf->download($pdfName);
    }

    public function exportProducts(Request $request){
        $products = Product::has('stock')->where('removed', false)->get();
        $owner = Customer::where('type', 'owner')->first();
        $columns = array("Name","Category","Supplier Price","Selling Price","Difference","Quantity");
        $date = Carbon::now()->toDateString();

        $pdf = PDF::loadView('dashboard.general.export.products', [
            'products' => $products,
            'owner' => $owner,
            'columns' => $columns,
            'date' => $date,
        ]);
        $date = Carbon::now();
        $pdfName = 'ProductList'.$date.'.pdf';

        return $pdf->download($pdfName);
    }
}
