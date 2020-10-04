@extends('layouts.app')

@push('datatables')
  <script src="{{ asset('js/datatables.min.js') }}" defer></script>
@endpush
@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <h2><i class="chart bar outline icon"></i> Reports</h2>
            <div class="ui secondary menu">
                <div class="item">
                    <label>Type: </label>
                    <select class="ui type dropdown" name="type" id="">
                        <option value="Order">Orders</option>
                        <option value="Product">Products</option>
                        <option value="Transaction">Transactions</option>
                    </select>
                </div>
                <div class="item">
                    <label>Customer: </label>
                    <select class="ui search customer dropdown" name="customer" id="">
                        <option value="">All</option>
                        @if ($customers ?? '')
                            @foreach ($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->firstname}} {{$customer->lastname}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="right menu">
                    <div class="item">
                        <a class="ui brown button" href="{{route('suppliers.create')}}"><i class="file pdf outline icon"></i> Export</a>
                    </div>
                </div>
            </div>
            <div class="ui raised segment">
                @if ($columns ?? '' && $orders ?? '')
                    <table class="ui tablet stackable selectable definition table" id="reports-table">
                        <thead class="full-width">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        $('#reports-table').DataTable({
            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "order": [],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            }]
        });

        $('.type.dropdown').dropdown({
            onChange: function(value, text, $selectedItem) {
                console.log('You selected '+ text + 'with the value ' + value);
            }
        });

        $('.customer.dropdown').dropdown({
            onChange: function(value, text, $selectedItem) {
                console.log('You selected '+ text + 'with the value ' + value);
            }
        });
    });
</script>
@endpush