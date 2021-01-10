<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use App\Transaction;

class DepositController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'balance' => 'required|numeric',
            'deposit' => 'required|numeric',
            'transaction_id' => 'required|string',
        ]);
        
        $initial_balance = $request->input('balance');
        $deposit_amount = $request->input('deposit');
        $transaction_id = $request->input('transaction_id');

        if ($deposit_amount <= $initial_balance) {
            $remaining_balance = $initial_balance - $deposit_amount;

            $deposit = new Deposit;
            $deposit->initial_balance = $initial_balance;
            $deposit->deposit = $deposit_amount;
            $deposit->remaining_balance = $remaining_balance;
            $deposit->transaction_id = $transaction_id;
            $deposit->save();

            $this->updateBalance($transaction_id,$remaining_balance, $deposit_amount);
            cache()->forget('transactions-all');
            cache()->forget('myorders-all');
            return redirect('/transactions/'.$transaction_id)->with('success', 'Deposit has been successfuly recorded');
        }else {
            return redirect('/transactions/'.$transaction_id)->with('error', 'Deposit amount cannot be greater than remaining balance');
        }
    }

    public function updateBalance($transaction_id, $remaining_balance, $deposit_amount){
        $transaction = Transaction::find($transaction_id);
        $cash = $transaction->cash;
        $addedCash = $cash + $deposit_amount;

        $transaction->cash = $addedCash;
        $transaction->balance = $remaining_balance;
        if ($remaining_balance == 0) {
            $transaction->status = 'paid';
        }
        $transaction->save();
    }
}
