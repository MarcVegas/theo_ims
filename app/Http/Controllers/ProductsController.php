<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Stock;
use App\Supplier;
use App\Category;
use App\Notification;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = cache()->remember('products-all', 60*60*24, function (){
            return Product::has('stock')->where('removed', false)->get();
        });
        
        return view('dashboard.mgmt.products.product')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::where('removed', false)->get();
        $categories = Category::select('title')->get();

        return view('dashboard.mgmt.products.create')->with('suppliers', $suppliers)->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required|string',
            'supplier' => 'required|string',
            'supplier_price' => 'required|numeric',
            'seller_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'quantity_bundle' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/uploads', $fileNameToStore);
        }

        //Compute price differece
        $seller_price = $request->input('seller_price');
        $supplier_price = $request->input('supplier_price');
        $difference = $seller_price - $supplier_price;

        //Generate product ID
        $product_id = (string) Str::uuid();

        //Save product
        $product = new Product;
        $product->id = $product_id;
        $product->name = $request->input('name');
        $product->category = $request->input('category');
        if ($request->hasFile('photo')) {
            $product->image = $fileNameToStore;
        }
        $product->selling_price = $seller_price;
        $product->difference = $difference;
        $product->supplier_id = $request->input('supplier');
        $product->save();

        //Compute amount
        $quantity = $request->input('quantity');
        $bundle_amount = $quantity * $supplier_price;
        $gross_amount = $seller_price * $quantity;
        $net_amount = $gross_amount - $bundle_amount;

        //Save stock
        $stock = new Stock;
        $stock->quantity = $quantity;
        if ($request->has('quantity_bundle')) {
            $stock->quantity_per_bundle = $request->input('quantity_bundle');
        }
        $stock->supplier_price = $supplier_price;
        $stock->bundle_amount = $bundle_amount;
        $stock->gross_amount = $gross_amount;
        $stock->net_amount = $net_amount;
        $stock->product_id = $product_id;
        $stock->save();

        cache()->forget('products-all');

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::has('stock')->find($id);
        $supplier_id = $product->supplier_id;
        $supplier = Supplier::find($supplier_id);
        

        return view('dashboard.mgmt.products.show')->with('product', $product)
        ->with('supplier', $supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::has('stock')->find($id);
        $suppliers = Supplier::all();
        $categories = Category::select('title')->get();

        return view('dashboard.mgmt.products.edit')->with('product', $product)
        ->with('suppliers', $suppliers)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required|string',
            'supplier' => 'required|string',
            'supplier_price' => 'required|numeric',
            'seller_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'quantity_bundle' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/uploads', $fileNameToStore);
        }

        //Compute price differece
        $seller_price = $request->input('seller_price');
        $supplier_price = $request->input('supplier_price');
        $difference = $seller_price - $supplier_price;

        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->category = $request->input('category');
        if ($request->hasFile('photo')) {
            $product->image = $fileNameToStore;
        }
        $product->selling_price = $seller_price;
        $product->difference = $difference;
        $product->supplier_id = $request->input('supplier');
        $product->save();

        //Compute amount
        $quantity = $request->input('quantity');
        $bundle_amount = $quantity * $supplier_price;
        $gross_amount = $seller_price * $quantity;
        $net_amount = $gross_amount - $bundle_amount;

        //Save stock
        $stock = Stock::where('product_id','=', $id)->first();
        $stock->quantity = $quantity;
        if ($request->has('quantity_bundle')) {
            $stock->quantity_per_bundle = $request->input('quantity_bundle');
        }
        $stock->supplier_price = $supplier_price;
        $stock->bundle_amount = $bundle_amount;
        $stock->gross_amount = $gross_amount;
        $stock->net_amount = $net_amount;
        $stock->save();

        cache()->forget('products-all');

        return redirect()->route('products.index')->with('success', 'Product updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->removed = true;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product removed successfully');
    }

    public function getProduct($id){
        $product = Product::with('stock')->find($id)->toJson();

        return $product;
    }

    public function getNoStock(){
        $nostocks = Product::whereHas('stock', function ($q) {
            $q->where('quantity', 0);
        })->where('removed', false)->get();

        return view('dashboard.mgmt.products.nostock')->with('nostocks', $nostocks);
    }
}
