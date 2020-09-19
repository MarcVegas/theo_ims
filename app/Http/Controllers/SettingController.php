<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class SettingController extends Controller
{
    public function index(){
        $categories = Category::all();

        return view('dashboard.store.setting.index')->with('categories', $categories);
    }
}
