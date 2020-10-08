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
        .table, th, td {
            border: 1px solid rgb(36, 35, 35);
            border-collapse: collapse;
        }
        td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="center-aligned">
        <h3>{{$owner->firstname}} Deposit Report</h3>
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
        @if ($columns ?? '' && $deposits ?? '')
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th>{{$column}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deposits as $deposit)
                        <tr>
                            <td>{{$deposit->id}}</td>
                            <td>{{$deposit->initial_balance}}</td>
                            <td>{{$deposit->deposit}}</td>
                            <td>{{$deposit->remaining_balance}}</td>
                            <td>{{$deposit->transaction->customer->firstname}} {{$deposit->transaction->customer->lastname}}</td>
                            <td>{{date('d M Y, h:i A', strtotime($deposit->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="center-aligned">
                <h3>No Deposits Made</h3>
            </div>
        @endif
    </div>
</body>
</html>