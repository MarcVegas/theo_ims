<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class SettingController extends Controller
{
    public function index(){
        $categories = Category::where('removed', false)->get();

        return view('dashboard.store.setting.index')->with('categories', $categories);
    }
}
