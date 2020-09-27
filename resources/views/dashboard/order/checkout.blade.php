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
                    <div class="ui basic padded segment">
                        <h2 class="ui teal header">
                            <i class="cart arrow down icon"></i>
                            <div class="content">
                                Your Order
                                <div class="sub header">List of your selected items</div>
                            </div>
                        </h2>
                        @if ($carts ?? '')
                            <table class="ui single line table">
                                <thead>
                                    <tr>
                                        <td><b>Product</b></td>
                                        <td><b>Qty</b></td>
                                        <td><b>Price</b></td>
                                        <td><b>Amount</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->cart_quantity}}</td>
                                            <td>{{$item->selling_price}}</td>
                                            <td>{{$item->selling_price * $item->cart_quantity}}</td>
                                            <td><button class="ui inverted red icon remove button"><i class="trash alternate icon"></i></button></td>
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
                    <div style="background-color: #f5f6f6;border-radius:.5rem;padding:2rem">
                        <label>Customer</label>
                        <div style="font-size: 1.5rem">{{$customer->firstname}} {{$customer->lastname}}</div><br>
                        <form class="ui form" action="{{route('orders.store')}}" method="POST">
                            @csrf
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
                                    <input type="text" name="total" id="total" value="{{$total}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Cash or Deposit</label>
                                    <input type="text" name="cash" id="cash" placeholder="Enter cash amount">
                                </div>
                            </div>
                            <input type="hidden" name="customer_id" id="customer_id" value="{{$customer->id}}">
                            <br>
                            <button type="submit" class="ui blue fluid button">Confirm Payment</button>
                        </form>
                    </div>
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