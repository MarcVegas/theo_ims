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
                                            <input type="text" name="date" id="date" value="{{$transaction->transaction_date}}" readonly>
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
                                    <a class="ui button" href="{{route('transactions.index')}}">Go to transactions</a>
                                    <a class="ui orange right floated button"><i class="file pdf icon"></i> Print Invoice</a>
                                    <button class="ui inverted violet right floated button">Add Deposit</button>
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        
    })
</script>
@endpush