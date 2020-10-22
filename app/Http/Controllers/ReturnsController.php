<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Transaction;
use App\Returned;
use App\Stock;

class ReturnsController extends Controller
{
    public function show(Request $request){
        if ($request->has('transaction_id') && $request->has('product_id')) {
            $transaction_id = $request->get('transaction_id');
            $product_id = $request->get('product_id');
        }

        $order = Order::has('product')->where('product_id', $product_id)->where('transaction_id', $transaction_id)->first();

        return view('dashboard.mgmt.transactions.return')->with('order', $order);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'product_id' => 'string|required',
            'returned' => 'integer|required'
        ]);

        $product_id = $request->input('product_id');
        $returned = $request->input('returned');

        $order = Order::where('product_id', $product_id)->where('transaction_id', $id)->first();
        $init_quantity = $order->order_quantity;
        $price = $order->order_price;
        
        if ($returned <= $init_quantity) {
            $new_quantity = $init_quantity - $returned;
            $new_subtotal = $new_quantity * $price;

            $order->order_quantity = $new_quantity;
            $order->subtotal = $new_subtotal;

            $this->saveReturned($product_id,$init_quantity,$returned, $id);
            $order->save();
            $this->recalculateTransaction($id);
            $this->addToStock($product_id, $returned);
            cache()->forget('transactions-all');
            return redirect('/transactions/'.$id)->with('success', 'Items have been returned successfuly');
        }else {
            return redirect('/transactions/'.$id)->with('error', 'Returned quantity cannot be greater than ordered quantity');
        }
    }

    public function saveReturned($product_id, $init_quantity, $returned_items, $transaction_id){
        $returning = new Returned;
        $returning->product_id = $product_id;
        $returning->initial_quantity = $init_quantity;
        $returning->returned = $returned_items;
        $returning->remaining_quantity = $init_quantity - $returned_items;
        $returning->transaction_id = $transaction_id;
        $returning->save();
    }

    public function recalculateTransaction($transaction_id){
        $transaction = Transaction::find($transaction_id);
        $new_total = Order::where('transaction_id', $transaction_id)->sum('subtotal');

        $cash = $transaction->cash;
        $type = $transaction->type;

        $transaction->total = $new_total;
        if ($type == 'credit') {
            $new_balance = $new_total - $cash;
            if ($new_balance < 0) {
                $refund = abs($new_balance);
                $new_balance = 0;
                $transaction->balance = $new_balance;
                $transaction->refund = $refund;
            } else {
                $transaction->balance = $new_balance;
            }
            if ($new_balance == 0) {
                $transaction->status = 'paid';
            }

            $transaction->save();
        } elseif ($type == 'full') {
            $new_change = $cash - $new_total;
            $transaction->change = $new_change;

            $transaction->save();
        }
    }

    public function addToStock($product_id, $returned_items){
        $stock = Stock::where('product_id', $product_id)->first();
        $quantity = $stock->quantity;
        $new_quantity = $quantity + $returned_items;
        $stock->quantity = $new_quantity;
        $stock->save();
    }
}
