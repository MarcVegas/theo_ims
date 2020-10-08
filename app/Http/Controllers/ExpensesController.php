<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Expense;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $from = Carbon::now()->startOfMonth();
        $to = Carbon::now()->endOfMonth();

        $expenses = cache()->remember('expenses-all', 60*60*24, function (){
            return Expense::all();
        });

        $total = Expense::whereBetween('created_at',[$from, $to])->sum('amount');

        return view('dashboard.other.expenses.index')->with('expenses', $expenses)->with('total',$total);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.other.expenses.create');
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
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $date = Carbon::now()->toDateString();

        $expense = new Expense;
        $expense->title = $request->input('title');
        $expense->amount = $request->input('amount');
        if ($request->has('description')) {
            $expense->description = $request->input('description');
        }
        $expense->expense_date = $date;
        $expense->save();

        cache()->forget('expenses-all');

        return redirect()->route('expenses.index')->with('success', 'Expense successfuly added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::find($id);

        return view('dashboard.other.expenses.show')->with('expense', $expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::find($id);

        return view('dashboard.other.expenses.edit')->with('expense', $expense);
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
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $expense = Expense::find($id);
        $expense->title = $request->input('title');
        $expense->amount = $request->input('amount');
        if ($request->has('description')) {
            $expense->description = $request->input('description');
        }
        $expense->save();

        cache()->forget('expenses-all');

        return redirect()->route('expenses.index')->with('success', 'Expense successfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense removed successfuly');
    }
}
