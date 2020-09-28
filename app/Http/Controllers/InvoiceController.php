<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Order;
use App\Customer;
use App\Transaction;

class InvoiceController extends Controller
{
    public function invoice(){
        $id = '631eeda7-de2a-4ae9-bfcb-0a3948574cb2';
        $orders = Order::has('product')->where('transaction_id', $id)->get();

        $transaction = Transaction::has('customer')->find($id);

        return view('dashboard.order.invoice')->with('orders', $orders)->with('customer', $transaction);
    }
}
