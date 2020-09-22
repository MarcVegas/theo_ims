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
                        @if ($carts ?? '')
                            <table class="ui single line compact table">
                                <thead>
                                    <tr>
                                        <td>Product</td>
                                        <td>Qty</td>
                                        <td>Price</td>
                                        <td>Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->cart_quantity}}</td>
                                            <td>{{$item->selling_price}}</td>
                                            <td>{{$item->selling_price * $item->cart_quantity}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="ui basic center aligned segment">
                                <h3>You have no items on your cart.</h3>
                            </div>
                        @endif
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
                                <label>Payment Method</label>
                                <select class="ui dropdown" name="transaction_type" id="transaction_type">
                                    <option value="full">Full Payment</option>
                                    <option value="credit">Credit</option>
                                </select>
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