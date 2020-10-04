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
                    <label id="filter-label">Customer: </label>
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
                        <a class="ui blue button" href="/reports"><i class="redo alternate icon"></i> Reset</a>
                    </div>
                    <div class="item">
                        <a class="ui brown button" href="{{route('suppliers.create')}}"><i class="file pdf outline icon"></i> Export</a>
                    </div>
                </div>
            </div>
            <div class="ui raised segment" id="reports_table">
                <div class="ui basic center aligned segment">
                    <i class="notched circle loading big icon"></i>
                    <h3>Fetching data...</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        var customer_id;
        var type = 'Order';

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        function table(table) {
            $('#'+table).DataTable({
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
                "order": [],
                "columnDefs": [ {
                    "targets"  : 'no-sort',
                    "orderable": false,
                }]
            });
        }

        function getOrders() {
            $.ajax({
                    type: "GET",
                    url: '/reports/orders',
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#reports_table').html(data);
                        var tablename = 'order-table';
                        table(tablename);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        }

        getOrders();

        function getCustomerOrders(id) {
            $.ajax({
                    type: "GET",
                    url: '/reports/order/'+ id,
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#reports_table').html(data);
                        var tablename = 'order-table';
                        table(tablename);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        }

        function getTransactions() {
            $.ajax({
                    type: "GET",
                    url: '/reports/transactions',
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#reports_table').html(data);
                        var tablename = 'transaction-table';
                        table(tablename);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        }

        function getCustomerTransactions(id) {
            $.ajax({
                    type: "GET",
                    url: '/reports/transaction/'+ id,
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#reports_table').html(data);
                        var tablename = 'transaction-table';
                        table(tablename);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        }

        $('.type.dropdown').dropdown({
            onChange: function(value, text, $selectedItem) {
                type = value;
                if (value == 'Product') {
                    $('.customer.dropdown').toggle();
                    $('#filter-label').text('');
                }else if(value == 'Order' || value == 'Transaction') {
                    var isShown = $('.customer.dropdown').is(':visible');
                    $('.customer.dropdown').dropdown('restore defaults');
                    if (value == 'Transaction') {
                        getTransactions();
                    }else if(value == 'Order'){
                        getOrders();
                    }
                    if (isShown == false) {
                        $('.customer.dropdown').toggle();
                        $('#filter-label').text('Customer:');
                    }
                }
            }
        });

        $('.customer.dropdown').dropdown({
            onChange: function(value, text, $selectedItem) {
                customer_id = value;
                if (type == 'Order' && customer_id != '') {
                    getCustomerOrders(customer_id);
                } else if(type == 'Transaction' && customer_id != '') {
                    getCustomerTransactions(customer_id);
                }
            }
        });
    });
</script>
@endpush