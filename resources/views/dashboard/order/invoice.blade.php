<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            padding: .5rem;
        }
        .center-aligned {
            padding: 1rem;
            text-align: center;
        }
        .right-aligned {
            padding: 1rem;
            text-align: right;
        }
        .table {
            table-layout: auto;
            width: 100%;
        }
        .table thead th {
            padding: .5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="center-aligned">
        <h3>{{$owner->firstname}} Order Invoice</h3>
        <small>Address: {{$owner->address}}</small><br>
        <small>Contact: {{$owner->contact}}</small>
    </div>
    <div class="container">
        <p><strong>Customer:</strong> {{$transaction->customer->firstname}} {{$transaction->customer->lastname}}</p>
        <p><strong>Address:</strong> {{$transaction->customer->address}}</p>
        <p><strong>Transaction Type:</strong> {{($transaction->type == 'full') ? 'Fully Paid' : 'Credit'}}</p>
        <p><strong>Transaction Date:</strong> {{$transaction->created_at}}</p>
        <br>
        @if ($orders ?? '')
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->order_quantity}}</td>
                            <td>{{$order->order_price}}</td>
                            <td>{{$order->subtotal}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="center-aligned">
                <h3>No Products Ordered</h3>
            </div>
        @endif
        <br>
        <hr>
        <h3 style="color: gray">Returned Items</h3>
        @if ($returneds ?? '')
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Initial Qty</th>
                        <th>Returned</th>
                        <th>Remaining Qty</th>
                        <th>Returned On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returneds as $item)
                        <tr>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->initial_quantity}}</td>
                            <td>{{$item->returned}}</td>
                            <td>{{$item->remaining_quantity}}</td>
                            <td>{{date('d M Y, h:i s', strtotime($item->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="right-aligned">
            <p><strong>Order Total:</strong> {{$transaction->total}}</p>
            <p><strong>Payment Received:</strong> {{$transaction->cash}}</p>
            @if ($transaction->type == 'full')
                <p><strong>Change:</strong> {{$transaction->change}}</p>
            @else
                <p><strong>Balance:</strong> {{$transaction->balance}}</p>
            @endif
            @if ($transaction->refund != null)
                <p><strong>Refund Amount:</strong> {{$transaction->refund}}</p>
            @endif
        </div>
        <div style="text-align:center">
            <small>This serves as your receipt</small>
        </div>
    </div>
</body>
</html>