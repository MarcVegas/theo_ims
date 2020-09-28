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
                            <form class="ui form" action="" method="POST">
                                <div class="field">
                                    <label>Expense Name</label>
                                    <input type="text" name="title" id="title" value="{{$expense->title}}">
                                </div>
                                <div class="field">
                                    <label>Cost</label>
                                    <input type="number" name="amount" id="amount" min="1" value="{{$expense->amount}}">
                                </div>
                                <div class="field">
                                    <label>Description (optional)</label>
                                    <textarea name="description" id="description" rows="3">
                                        {{$expense->description}}
                                    </textarea>
                                </div>
                                <input type="hidden" name="_method" value="PUT">
                                <button class="ui blue right floated button" type="submit"><i class="edit icon"></i> Update</button><br><br>
                            </form>
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