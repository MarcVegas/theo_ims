<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CacheMgmtController extends Controller
{
    public function clearCache(){
        cache()->forget('products-all');
        cache()->forget('transactions-all');
        cache()->forget('customers-all');
        cache()->forget('suppliers-all');
        cache()->forget('best-products');
        cache()->forget('best-customers');

        return redirect('/settings')->with('success', 'Cache cleared');
    }
}
