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
                                <i class="check circle icon"></i>
                                <div class="content">
                                    Order Complete!
                                    <div class="sub header">Your order has been successfuly processed</div>
                                </div>
                            </h2>
                        </div>
                        <div class="ui padded segment">
                            <h4>Transaction ID: <label class="ui green label"></label></h4>
                            <div class="ui form">
                                <div class="fields">
                                    <div class="field">
                                        <label>Customer Name</label>
                                        <input type="text" name="customer" id="customer" readonly>
                                    </div>
                                    <div class="field">
                                        <div class="ui blue label">Credit</div>
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="field">
                                        <label>Total</label>
                                        <input type="text" name="total" id="total" readonly>
                                    </div>
                                    <div class="field">
                                        <label>Transaction Date</label>
                                        <input type="text" name="date" id="date" readonly>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Cash or Deposit</label>
                                    <input type="text" name="cash" id="cash" readonly>
                                </div>
                                <div class="field">
                                    <label>Balance</label>
                                    <input type="text" name="balance" id="balance" readonly>
                                </div>
                                <a class="ui button" href="">Go to transactions</a>
                                <button class="ui teal right floated button"><i class="file pdf icon"></i> Print Invoice</button>
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

@push('ajax')
<script>
    $(document).ready(function (){
        
    })
</script>
@endpush