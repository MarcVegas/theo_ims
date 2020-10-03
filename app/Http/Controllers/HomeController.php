<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

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
        $orders = Order::has('product')->paginate(5);

        return view('dashboard.general.dashboard')->with('orders', $orders);
    }
}
