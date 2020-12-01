<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Order;
use App\Expense;
use App\Transaction;
use Illuminate\Support\Facades\Artisan;

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

        $fromDaily = Carbon::now()->startOfDay();
        $toDaily = Carbon::now()->endOfDay();

        $expires = Carbon::now()->addHours(24);

        //Monthly Statistics
        $orderCount = Order::whereBetween('created_at',[$from, $to])->count();
        $miscellaneous = Expense::whereBetween('created_at',[$from, $to])->sum('amount');
        $refund = Transaction::where('supplier_id', null)->whereBetween('created_at',[$from, $to])->sum('refund');
        $change = Transaction::where('supplier_id', null)->whereBetween('created_at',[$from, $to])->sum('change');
        $restockExpense = Transaction::where('supplier_id','<>', null)->whereBetween('created_at',[$from, $to])->sum('cash');
        $restockChange = Transaction::where('supplier_id','<>', null)->whereBetween('created_at',[$from, $to])->sum('change');
        $restock = $restockExpense - $restockChange;
        $expense = $miscellaneous + $restock;
        $total = Transaction::where('supplier_id', null)->whereBetween('created_at',[$from, $to])->sum('cash');
        $deductables = $refund + $change;
        $grossTotal = $total - $deductables;
        $netTotal = $grossTotal - $expense;

        //Daily Statistics
        $orderCountDaily = Order::whereBetween('created_at',[$fromDaily, $toDaily])->count();
        $miscellaneousDaily = Expense::whereBetween('created_at',[$fromDaily, $toDaily])->sum('amount');
        $refundDaily = Transaction::where('supplier_id', null)->whereBetween('created_at',[$fromDaily, $toDaily])->sum('refund');
        $changeDaily = Transaction::where('supplier_id', null)->whereBetween('created_at',[$fromDaily, $toDaily])->sum('change');
        $restockExpenseDaily = Transaction::where('supplier_id','<>', null)->whereBetween('created_at',[$fromDaily, $toDaily])->sum('cash');
        $restockChangeDaily = Transaction::where('supplier_id','<>', null)->whereBetween('created_at',[$fromDaily, $toDaily])->sum('change');
        $restockDaily = $restockExpenseDaily - $restockChangeDaily;
        $expenseDaily = $miscellaneousDaily + $restockDaily;
        $totalDaily = Transaction::where('supplier_id', null)->whereBetween('created_at',[$fromDaily, $toDaily])->sum('cash');
        $deductablesDaily = $refundDaily + $changeDaily;
        $grossTotalDaily = $totalDaily - $deductablesDaily;
        $netTotalDaily = $grossTotalDaily - $expenseDaily;

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
        ->with('net', $netTotal)->with('orderCountDaily', $orderCountDaily)
        ->with('expenseDaily', $expenseDaily)->with('grossDaily', $grossTotalDaily)
        ->with('netDaily', $netTotalDaily);
    }

    public function home(){
        return redirect('/login');
    }

    public function createLink(){
        Artisan::call('storage:link',[]);
        return 'success';
    }

}
