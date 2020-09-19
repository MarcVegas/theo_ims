<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('dashboard.mgmt.suppliers.supplier')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.mgmt.suppliers.create');
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
            'address' => 'required|string',
            'order_cutoff' => 'nullable|date',
            'payment_cutoff' => 'nullable|date',
            'shipment_date' => 'nullable|date',
        ]);

        $supplier_id = (string) Str::uuid();

        $supplier = new Supplier;
        $supplier->id = $supplier_id;
        $supplier->business_name = $request->input('name');
        $supplier->address = $request->input('address');
        if ($request->has('order_cutoff')) {
            $supplier->order_cutoff = $request->input('order_cutoff');
        }
        if ($request->has('payment_cutoff')) {
            $supplier->payment_cutoff = $request->input('payment_cutoff');
        }
        if ($request->has('shipment_date')) {
            $supplier->shipment_date = $request->input('shipment_date');
        }
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        return view('dashboard.mgmt.suppliers.show')->with('supplier', $supplier);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);

        return view('dashboard.mgmt.suppliers.edit')->with('supplier', $supplier);
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
            'address' => 'required|string',
            'order_cutoff' => 'nullable|date',
            'payment_cutoff' => 'nullable|date',
            'shipment_date' => 'nullable|date',
        ]);

        $supplier = Supplier::find($id);
        $supplier->business_name = $request->input('name');
        $supplier->address = $request->input('address');
        if ($request->has('order_cutoff')) {
            $supplier->order_cutoff = $request->input('order_cutoff');
        }
        if ($request->has('payment_cutoff')) {
            $supplier->payment_cutoff = $request->input('payment_cutoff');
        }
        if ($request->has('shipment_date')) {
            $supplier->shipment_date = $request->input('shipment_date');
        }
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier has been removed');
    }
}
