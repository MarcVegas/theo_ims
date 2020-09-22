@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <br><br>
            <div class="ui stackable grid">
                <div class="ten wide column">
                    <div class="ui basic padded segment">
                        <h2 class="ui header">
                            <i class="credit card icon"></i>
                            <div class="content">
                                Your Order
                                <div class="sub header">List of your selected items</div>
                            </div>
                        </h2>
                        <table class="ui single line table">
                            <thead>
                                <tr>
                                    <td>Product</td>
                                    <td>Qty</td>
                                    <td>Price</td>
                                    <td>Amount</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="six wide column">
                    <div style="background-color: #e0e1e3;border-radius:.5rem;padding:1rem">
                        <form class="ui form" action="">
                            <div class="field">
                                <label>Customer</label>
                                <input type="text" name="customer" id="customer" readonly>
                            </div>
                            <div class="field">
                                <label>Method</label>
                                <input type="text" name="payment_method" id="payment_method" readonly>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Total</label>
                                    <input type="text" name="total" id="total" readonly>
                                </div>
                                <div class="field">
                                    <label>Cash or Deposit</label>
                                    <input type="text" name="cash" id="cash" readonly>
                                </div>
                            </div>
                            <button class="ui blue fluid button">Confirm Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection