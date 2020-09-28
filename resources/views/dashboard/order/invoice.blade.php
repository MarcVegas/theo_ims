@extends('layouts.app')

@section('content')
<div class="ui basic segment">
    <div class="ui basic center aligned segment">
        <h1>Theo's Overruns Order Invoice</h1>
        <p>Address: Brgy. Banat-i, San Isidro, Leyte</p>
        <p>Email: youremail@user.com</p>
        <p>Contact: 09xx xxx xxxx</p>
    </div>
    <br>
    <h3>Customer: {{$transaction->customer->firstname}} {{$transaction->customer->lastname}}</h3>
    <p><strong>Address:</strong> {{$transaction->customer->address}}</p>
    <p><strong>Transaction Type:</strong> {{($transaction->type == 'full') ? 'Fully Paid' : 'Credit'}}</p>
    <p><strong>Transaction Date:</strong> {{$transaction->created_at}}</p>
    <br>
    @if ($orders ?? '')
        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->order_quantity}}</td>
                        <td>{{$item->order_price}}</td>
                        <td>{{$item->subtotal}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="ui basic center aligned segment">
            <h3>No Products Ordered</h3>
        </div>
    @endif
    <div class="ui basic right aligned segment">
        <p><strong>Order Total:</strong> {{$transaction->total}}</p>
        <p><strong>Payment Received:</strong> {{$transaction->cash}}</p>
        @if ($transaction->type == 'full')
            <p><strong>Change:</strong> {{$transaction->change}}</p>
        @else
            <p><strong>Balance:</strong> {{$transaction->balance}}</p>
        @endif
    </div>
    <div class="text-align:center">
        <small>This serves as your receipt</small>
    </div>
</div>
@endsection