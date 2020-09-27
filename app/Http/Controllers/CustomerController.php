<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Transaction;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('dashboard.mgmt.customers.customer')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.mgmt.customers.create');
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
        ]);

        $customer_id = (string) Str::uuid();

        $customer = new Customer;
        $customer->id = $customer_id;
        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        $customer->address = $request->input('address');
        $customer->type = $request->input('type');
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer successfuly added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::with('transaction')->find($id);
        $credits = Transaction::where('status', 'credit')->find($id);
        $receivable = Transaction::where('status', 'credit')->sum('balance');

        return view('dashboard.mgmt.customers.show')->with('customer', $customer)
        ->with('credits', $credits)->with('receivable', $receivable);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        return view('dashboard.mgmt.customers.edit')->with('customer', $customer);
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
        ]);

        $customer = Customer::find($id);
        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        $customer->address = $request->input('address');
        $customer->type = $request->input('type');
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer successfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
