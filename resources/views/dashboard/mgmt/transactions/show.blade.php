@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <br>
            <div class="ui stackable grid">
                <div class="ten wide column">
                    <div class="ui segments">
                        <div class="ui inverted teal padded segment">
                            <h2 class="ui header">
                                <i class="handshake icon"></i>
                                <div class="content">
                                    Transaction Details
                                </div>
                            </h2>
                        </div>
                        <div class="ui padded segment">
                            @if ($transaction ?? '')
                            <h4>Transaction ID: <label class="{{($transaction->type == 'full') ? 'ui green label' : 'ui blue label'}}">{{$transaction->id}}<div class="detail">{{$transaction->type}}</div></label></h4>
                                <div class="ui form">
                                    <div class="field">
                                        <label>Customer Name</label>
                                        <input type="text" name="customer" id="customer" value="{{$transaction->customer->firstname}} {{$transaction->customer->lastname}}" readonly>
                                    </div>
                                    <div class="equal width fields">
                                        <div class="field">
                                            <label>Order Total</label>
                                            <input type="text" name="total" id="total" value="{{$transaction->total}}" readonly>
                                        </div>
                                        <div class="field">
                                            <label>Transaction Date</label>
                                            <input type="text" name="date" id="date" value="{{date('d M Y', strtotime($transaction->transaction_date))}}" readonly>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>Cash or Deposit</label>
                                        <input type="text" name="cash" id="cash" value="{{$transaction->cash}}" readonly>
                                    </div>
                                    <div class="field">
                                        @if ($transaction->type == 'credit')
                                            <label>Balance</label>
                                            <input type="text" name="cash" id="cash" value="{{$transaction->balance}}" readonly>
                                        @else
                                            <label>Change</label>
                                            <input type="text" name="cash" id="cash" value="{{$transaction->change}}" readonly>
                                        @endif
                                    </div>
                                    <a class="ui button" href="{{route('transactions.index')}}">Go back</a>
                                    <a class="ui brown right floated button" href="/transaction/invoice/{{$transaction->id}}" target="_blank"><i class="file pdf outline icon"></i> Print Invoice</a>
                                    <button class="ui inverted secondary right floated {{($transaction->type == 'full' || $transaction->status == 'paid') ? 'disabled' : ''}} deposit button">Add Deposit</button>
                                </div>
                            @else
                                <div class="ui basic center aligned segment">
                                    Could not fetch transaction data
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="six wide column">
                    <div style="background-color: #f5f6f6;border-radius:.5rem;padding:2rem">
                        <div style="font-size: 1.5rem">Deposits</div>
                        @if ($deposits ?? '')
                            <table class="ui compact table">
                                <thead>
                                    <tr>
                                        <th>Balance</th>
                                        <th>Deposit</th>
                                        <th>Remaining</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deposits as $deposit)
                                        <tr>
                                            <td>{{$deposit->initial_balance}}</td>
                                            <td>{{$deposit->deposit}}</td>
                                            <td>{{$deposit->remaining_balance}}</td>
                                            <td>{{date('d M Y', strtotime($deposit->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="ui basic center aligned segment">
                                <h3>No Recent Deposits</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui mini deposit modal">
    <i class="close icon"></i>
    <div class="header"><i class="money alternate icon"></i> Add Deposit</div>
    <div class="content">
        <form class="ui form" action="{{route('deposit.store')}}" method="POST" id="deposit-form">
            @csrf
            <div class="field">
                <label>Remaining Balance</label>
                <input type="text" name="balance" id="balance" value="{{$transaction->balance}}" readonly>
            </div>
            <div class="field">
                <label>Deposit Amount</label>
                <input type="number" name="deposit" id="deposit" min="1" max="{{$transaction->balance}}" placeholder="Enter a valid amount">
            </div>
            <input type="hidden" name="transaction_id" id="transaction_id" value="{{$transaction->id}}">
        </form>
    </div>
    <div class="actions">
        <div class="ui deny button">
            Cancel Deposit
        </div>
        <button class="ui inverted green button" form="deposit-form" type="submit">
            Add Deposit
        </button>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        $('.deposit.modal').modal('attach events','.deposit.button','show');
    })
</script>
@endpush