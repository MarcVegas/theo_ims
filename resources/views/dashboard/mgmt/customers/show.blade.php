@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic padded segment">
            @include('inc.messages')
            <div class="ui cards">
                <div class="card">
                    <div class="content">
                        <div class="ui blue right floated header">
                            <i class="user circle icon"></i>
                        </div>
                        <div class="header">
                            <div class="ui teal header">
                            {{$customer->firstname}} {{$customer->lastname}}
                            </div>
                        </div>
                        <div class="meta">
                            {{$customer->address}}
                        </div>
                        <div class="description">
                            <label class="ui blue label">{{$customer->type}}</label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="ui right floated header teal">
                            <i class="icon credit card"></i>
                        </div>
                        <div class="header">
                            <div class="ui teal header">
                                1500 Pesos
                            </div>
                        </div>
                        <div class="meta">
                            Accounts Receivable
                        </div>
                        <div class="description">
                           As of DateTime
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui secondary menu">
                <div class="header item">
                    Credit Transaction
                </div>
                <div class="right menu">
                    <div class="item">
                        <a class="ui teal button" href=""><i class="cart plus icon"></i> New Order</a>
                    </div>
                </div>
            </div>
            <div class="ui segment">
                <table class="ui tablet stackable selectable definition table" id="transaction-table">
                    <thead class="full-width">
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Total</th>
                            <th>Cash</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td><label class="ui teal label">credit</label></td>
                            <td>1000</td>
                            <td>500</td>
                            <td>500</td>
                            <td><label class="ui basic teal label">partial</label></td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Jane Doe</td>
                            <td><label class="ui green label">full</label></td>
                            <td>1000</td>
                            <td>1000</td>
                            <td>0</td>
                            <td><label class="ui basic green label">paid</label></td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="ui mini modal">
    <i class="close icon"></i>
    <div class="header"><i class="exclamation triangle red icon"></i> Remove customer?</div>
    <div class="content">
        <strong>Are you sure you want to permanently remove this customer? This action cannot be reversed.</strong>
    </div>
    <div class="actions">
        <form action="{!! action('CustomerController@destroy', $customer->id) !!}" method="POST">
            <div class="ui deny button">
                No, I dont
            </div>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="ui inverted red button">
                Yes, proceed
            </button>
        </form>
    </div>
</div>
@endsection