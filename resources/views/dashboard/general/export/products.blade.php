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
        <h3>{{$owner->firstname}} Product List</h3>
        <small>Address: {{$owner->address}}</small><br>
        <small>Contact: {{$owner->contact}}</small>
    </div>
    <div class="container">
        <br>
        @if ($columns ?? '' && $products ?? '')
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th>{{$column}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->stock->supplier_price}}</td>
                            <td>{{$product->selling_price}}</td>
                            <td>{{$product->difference}}</td>
                            <td>{{$product->stock->quantity}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="center-aligned">
                <h3>No Products Added</h3>
            </div>
        @endif
    </div>
</body>
</html>