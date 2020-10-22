<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use App\Order;
use App\Customer;
use App\Transaction;
use App\Returned;

class InvoiceController extends Controller
{
    public function invoice($id){
        $orders = Order::with('product')->where('transaction_id', $id)->get();
        $transaction = Transaction::has('customer')->find($id);
        $returneds = Returned::has('product')->where('transaction_id', $id)->get();
        $owner = Customer::where('type', 'owner')->first();

        $pdf = PDF::loadView('dashboard.order.invoice', [
            'orders' => $orders,
            'transaction' => $transaction,
            'returneds' => $returneds,
            'owner' => $owner,
        ]);
        $date = Carbon::now();
        $pdfName = 'OrderInvoice'.$date.'.pdf';

        return $pdf->download($pdfName);
    }
}
