<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use App\Order;
use App\Customer;
use App\Transaction;

class InvoiceController extends Controller
{
    public function invoice($id){
        $orders = Order::with('product')->where('transaction_id', $id)->get();

        $transaction = Transaction::has('customer')->find($id);

        $pdf = PDF::loadView('dashboard.order.invoice', [
            'orders' => $orders,
            'transaction' => $transaction
        ]);
        $date = Carbon::now();
        $pdfName = 'OrderInvoice'.$date.'.pdf';

        return $pdf->download($pdfName);
        //return view('dashboard.order.invoice')->with('orders', $orders)->with('transaction', $transaction);
    }
}
