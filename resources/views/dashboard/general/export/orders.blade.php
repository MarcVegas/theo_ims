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
        <h3>{{$owner->firstname}} Order List</h3>
        <small>Address: {{$owner->address}}</small><br>
        <small>Contact: {{$owner->contact}}</small>
    </div>
    <div class="container">
        @if ($customer ?? '')
            <p><strong>Customer:</strong> {{$customer->firstname}} {{$customer->lastname}}</p>
            <p><strong>Address:</strong> {{$customer->address}}</p>
        @endif
        @if ($from ?? '' && $to ?? '')
            <p><strong>Date: </strong>{{date('d M Y', strtotime($from))}} to {{date('d M Y', strtotime($to))}}</p>
        @endif
        <br>
        @if ($columns ?? '' && $orders ?? '')
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th>{{$column}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->product->category}}</td>
                            <td>{{$order->order_quantity}}</td>
                            <td>{{$order->order_price}}</td>
                            <td>{{$order->subtotal}}</td>
                            <td>{{date('d M Y, h:i A', strtotime($order->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="center-aligned">
                <h3>No Products Ordered</h3>
            </div>
        @endif
    </div>
</body>
</html>