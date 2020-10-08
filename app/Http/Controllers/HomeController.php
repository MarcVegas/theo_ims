<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Order;
use App\Expense;
use App\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $from = Carbon::now()->startOfMonth();
        $to = Carbon::now()->endOfMonth();
        $expires = Carbon::now()->addHours(24);

        $orderCount = Order::whereBetween('created_at',[$from, $to])->count();
        $miscellaneous = Expense::whereBetween('created_at',[$from, $to])->sum('amount');
        $restockExpense = Transaction::where('supplier_id','<>', null)->whereBetween('created_at',[$from, $to])->sum('cash');
        $expense = $miscellaneous + $restockExpense;
        /* $grossTotal = Order::whereHas('transaction', function($q){
            $q->where('supplier_id', null)->where('type','<>', 'credit');
        })->whereBetween('created_at',[$from, $to])->sum('subtotal'); */
        $grossTotal = Transaction::where('supplier_id', null)->whereBetween('created_at',[$from, $to])->sum('cash');
        $netTotal = $grossTotal - $expense;

        $bestProducts = cache()->remember('best-products', $expires, function () use ($from, $to){
            return Order::has('product')->whereHas('transaction', function($q){
                $q->where('supplier_id', null);
            })->whereBetween('created_at',[$from, $to])->selectRaw('sum(order_quantity) as sum,product_id')
            ->groupBy('product_id')->orderBy('sum', 'desc')->take(5)->get();
        });

        $bestCustomers = cache()->remember('best-customers', $expires, function () use ($from,$to){
            return Transaction::has('customer')->where('supplier_id', null)->whereBetween('created_at',[$from, $to])
            ->selectRaw('sum(cash) as sum,customer_id')->groupBy('customer_id')->orderBy('sum', 'desc')->take(5)->get();
        });

        return view('dashboard.general.dashboard')->with('bestProducts', $bestProducts)
        ->with('bestCustomers', $bestCustomers)->with('orderCount', $orderCount)
        ->with('expense', $expense)->with('gross', $grossTotal)
        ->with('net', $netTotal);
    }

}
