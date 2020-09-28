@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <div class="ui stackable three column padded grid">
                <div class="column">
                    <div class="ui horizontal segments">
                        <div class="ui inverted blue center aligned padded segment">
                            <i class="money bill alternate outline huge icon"></i>
                        </div>
                        <div class="ui segment">
                            <h2 class="ui header">
                            1000
                                <div class="sub header">Monthly Gross Income</div>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui horizontal segments">
                        <div class="ui inverted teal center aligned padded segment">
                            <i class="dollar sign huge icon"></i>
                        </div>
                        <div class="ui segment">
                            <h2 class="ui header">
                            500
                                <div class="sub header">Monthly Total Expenses</div>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui horizontal segments">
                        <div class="ui inverted orange center aligned padded segment">
                            <i class="bullseye huge icon"></i>
                        </div>
                        <div class="ui segment">
                            <h2 class="ui header">
                            500
                                <div class="sub header">Monthly Net Amount</div>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui secondary menu">
                <div class="right menu">
                    <div class="item">
                        <a class="ui teal button" href="{{route('expenses.create')}}"><i class="plus icon"></i> Add Expense</a>
                    </div>
                </div>
            </div>
            <div class="ui basic padded segment">
                <table class="ui tablet stackable selectable definition table">
                    <thead class="full-width">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Expense Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Delivery Fee</td>
                            <td>500</td>
                            <td>Sep 22, 2020</td>
                            <td class="collapsing">
                                <a class="ui icon button" href=""><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection