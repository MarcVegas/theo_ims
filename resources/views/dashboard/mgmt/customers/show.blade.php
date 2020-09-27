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
                            <button class="ui icon right floated delete button"><i class="trash alternate outline icon"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="ui right floated header teal">
                            <i class="icon credit card"></i>
                        </div>
                        <div class="header">
                            <div class="ui orange header">
                                @if ($receivable ?? '')
                                    {{$receivable}} Pesos
                                @else
                                    Zero Balance
                                @endif
                            </div>
                        </div>
                        <div class="meta">
                            Accounts Receivable
                        </div>
                        <div class="description">
                           As of {{date('d M Y', strtotime(Carbon\Carbon::now()))}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui secondary menu">
                <div class="header item">
                    Recent Credit Transaction
                </div>
                <div class="right menu">
                    <div class="item">
                        <a class="ui teal button" href="/shop/{{$customer->id}}"><i class="cart plus icon"></i> Order Now</a>
                    </div>
                </div>
            </div>
            <div class="ui segment">
                @if ($credits ?? '')
                    <table class="ui tablet stackable selectable definition table" id="transaction-table">
                        <thead class="full-width">
                            <tr>
                                <th>Transaction Date</th>
                                <th>Total</th>
                                <th>Cash</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($credits as $credit)
                                <tr>
                                    <td>{{date('d M Y, h:i a', strtotime($credit->created_at))}}</td>
                                    <td>{{$credit->total}}</td>
                                    <td>{{$credit->cash}}</td>
                                    <td>{{$credit->balance}}</td>
                                    <td><label class="{{($credit->status == 'credit') ? 'ui basic teal label' : 'ui basic green label'}}">{{$credit->status}}</label></td>
                                    <td class="center aligned">
                                        <a class="ui fluid button" href="{{$credit->id}}"><i class="eye icon"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="ui basic center aligned segment">
                        <h3>No Credit Transactions</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="ui mini modal">
    <i class="close icon"></i>
    <div class="header"><i class="exclamation triangle red icon"></i>Remove customer?</div>
    @if ($credits ?? '')
        <div class="content">
            <strong>Cannot delete customer with one or more unpaid or partialy paid credit transactions. Please resolve these transactions first</strong>
        </div>
        <div class="actions">
            <div class="ui deny button">Ok</div>
        </div>
    @else 
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
    @endif
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        $('.mini.modal').modal('attach events', '.delete.button', 'show');
    });
</script>
@endpush