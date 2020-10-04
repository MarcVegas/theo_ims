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

    public function orders(){
        $orders = Order::has('product')->latest()->get();
        $customers = Customer::where('type', 'reseller')->get();
        $columns = array("Name","Category","Qnty","Price","Subtotal");

        return view('dashboard.general.report')->with('orders', $orders)
        ->with('columns', $columns)->with('customers', $customers);
    }

    public function customerOrders($id){
        
    }

    public function products(){
        
    }

    public function transactions(){
        
    }
}
