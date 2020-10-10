<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Customer;
use App\Transaction;
use App\User;
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
        $expires = Carbon::now()->addHours(24);
        $customers = cache()->remember('customers-all', $expires, function (){
            return Customer::where('type','=', 'reseller')->where('removed', false)->get();
        });

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

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/uploads', $fileNameToStore);
        }

        $customer = new Customer;
        $customer->id = $customer_id;
        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        if ($request->hasFile('photo')) {
            $customer->avatar = $fileNameToStore;
        }
        $customer->address = $request->input('address');
        $customer->type = $request->input('type');
        $customer->save();

        cache()->forget('customers-all');

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
        $credits = Transaction::where('type', 'credit')->where('status','<>', 'paid')->where('customer_id', $id)->latest()->get();
        $receivable = Transaction::where('type', 'credit')->where('customer_id', $id)->sum('balance');

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
            'contact' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/uploads', $fileNameToStore);
        }

        $customer = Customer::find($id);
        $type = $customer->type;
        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        if ($request->hasFile('photo')) {
            $customer->avatar = $fileNameToStore;
        }
        $customer->address = $request->input('address');
        $customer->contact = $request->input('contact');
        $customer->save();

        cache()->forget('customers-all');

        if ($type == 'owner') {
            return redirect()->route('profile.index')->with('success', 'Business info successfuly updated');
        }else{
            return redirect()->route('customers.index')->with('success', 'Customer successfuly updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->removed = true;
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer successfuly removed');
    }
}
