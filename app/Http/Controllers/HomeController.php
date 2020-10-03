<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Order;
use App\Expense;

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

        $orderCount = Order::whereBetween('created_at',[$from, $to])->count();
        $expense = Expense::whereBetween('created_at',[$from, $to])->sum('amount');
        $grossTotal = Order::whereBetween('created_at',[$from, $to])->sum('subtotal');
        //$grossTotal = Order::where('created_at','>', $from)->where('created_at','<', $to)->sum('subtotal');
        $netTotal = $grossTotal - $expense;

        return view('dashboard.general.dashboard')->with('orderCount', $orderCount)
        ->with('expense', $expense)->with('gross', $grossTotal)->with('net', $netTotal);
    }
}
