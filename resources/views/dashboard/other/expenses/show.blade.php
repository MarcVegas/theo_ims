@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <div class="ui stackable padded grid">
                <div class="ten wide column">
                    <div class="ui segments">
                        <div class="ui inverted teal padded segment">
                            <h2 class="ui header">
                                <i class="calculator icon"></i>
                                <div class="content">
                                    Expenses
                                    <div class="sub header" style="color: white">Record your business expenses</div>
                                </div>
                            </h2>
                        </div>
                        <div class="ui padded segment">
                            <div class="ui form">
                                <div class="field">
                                    <label>Expense Name</label>
                                    <input type="text" name="title" id="title" value="{{$expense->title}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Cost</label>
                                    <input type="number" name="amount" id="amount" min="1" value="{{$expense->amount}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Description (optional)</label>
                                    <textarea name="description" id="description" rows="3" readonly>
                                        {{$expense->description}}
                                    </textarea>
                                </div>
                                <button class="ui blue right floated button" type="submit"><i class="plus icon"></i> Add Expense</button><br><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="six wide column">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection