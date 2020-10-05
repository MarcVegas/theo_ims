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
                        <option value="order">Orders</option>
                        <option value="product">Products</option>
                        <option value="transaction">Transactions</option>
                    </select>
                </div>
                <div class="item">
                    <label class="filter-label">Customer: </label>
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
                        <a class="ui brown button" id="export-button" href="/reports/export/order" target="_blank"><i class="file pdf outline icon"></i> Export</a>
                    </div>
                </div>
            </div>
            <div class="ui secondary menu">
                <div class="item">
                    <div class="ui form">
                        <div class="inline field">
                            <label class="filter-label">Filter from:</label>
                            <input type="date" name="from" id="from">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ui form">
                        <div class="inline field">
                            <label class="filter-label">to:</label>
                            <input type="date" name="to" id="to">
                        </div>
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
        var type = 'order';
        var from = "";
        var to = "";
        var datastr = "";
        var exportUrl = '/reports/export/';
        var hasRoute = false;

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

        function getOrders(datastr) {
            $.ajax({
                    type: "GET",
                    url: '/reports/orders',
                    data: datastr,
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

        function getCustomerOrders(id,datastr) {
            $.ajax({
                    type: "GET",
                    url: '/reports/order/'+ id,
                    data: datastr,
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

        function getTransactions(datastr) {
            $.ajax({
                    type: "GET",
                    url: '/reports/transactions',
                    data: datastr,
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

        function getCustomerTransactions(id,datastr) {
            $.ajax({
                    type: "GET",
                    url: '/reports/transaction/'+ id,
                    data: datastr,
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

        function getProducts() {
            $.ajax({
                    type: "GET",
                    url: '/reports/products',
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#reports_table').html(data);
                        var tablename = 'product-table';
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
                if (value == 'product') {
                    $('.customer.dropdown').toggle();
                    $('.filter-label').text('');
                    $('#from').toggle();
                    $('#to').toggle();
                    getProducts();
                }else if(value == 'order' || value == 'transaction') {
                    var isShown = $('.customer.dropdown').is(':visible');
                    var dateShown = $('#from').is(':visible');
                    $('.customer.dropdown').dropdown('restore defaults');
                    if (value == 'transaction') {
                        getTransactions();
                    }else if(value == 'order'){
                        getOrders();
                    }
                    if (isShown == false) {
                        $('.customer.dropdown').toggle();
                        $('.filter-label').text('Customer:');
                    }
                    if (dateShown == false) {
                        $('#from').toggle();
                        $('#to').toggle();
                    }
                }
                $("input[type=date]").val("");

                exportUrl = '/reports/export/' + type + '?';
                hasRoute = true;
                $("#export-button").attr("href", exportUrl);
            }
        });

        $('.customer.dropdown').dropdown({
            onChange: function(value, text, $selectedItem) {
                customer_id = value;
                if (type == 'order' && customer_id != '') {
                    getCustomerOrders(customer_id,datastr);
                } else if(type == 'transaction' && customer_id != '') {
                    getCustomerTransactions(customer_id,datastr);
                }
                if (hasRoute == false) {
                    exportUrl = exportUrl + type + '?';
                }
                exportUrl = exportUrl + 'customer_id=' + customer_id + '&';
                hasRoute = true;
                $("#export-button").attr("href", exportUrl);
            }
        });

        $('#from').on('change', function () {
            from = $('#from').val();
            if (to != '' && customer_id == null && type == 'order') {
                datastr = 'from=' + from + '&to=' + to;
                getOrders(datastr);
            }else if(to != '' && customer_id != null && type == 'order'){
                datastr = 'from=' + from + '&to=' + to;
                getCustomerOrders(customer_id,datastr);
            }else if (to != '' && customer_id == null && type == 'transaction') {
                datastr = 'from=' + from + '&to=' + to;
                getTransactions(datastr);
            }else if(to != '' && customer_id != null && type == 'transaction'){
                datastr = 'from=' + from + '&to=' + to;
                getCustomerTransactions(customer_id,datastr);
            }

            if (to != '') {
                if (hasRoute == false) {
                    exportUrl = exportUrl + type + '?';
                }
                exportUrl = exportUrl + 'from=' + from + '&to=' + to + '&';
                $("#export-button").attr("href", exportUrl);
            }
        });

        $('#to').on('change', function () {
            to = $('#to').val();
            if (from != '' && customer_id == null && type == 'order') {
                datastr = 'from=' + from + '&to=' + to;
                getOrders(datastr);
            }else if(to != '' && customer_id != null && type == 'order'){
                datastr = 'from=' + from + '&to=' + to;
                getCustomerOrders(customer_id,datastr);
            }else if (to != '' && customer_id == null && type == 'transaction') {
                datastr = 'from=' + from + '&to=' + to;
                getTransactions(datastr);
            }else if(to != '' && customer_id != null && type == 'transaction'){
                datastr = 'from=' + from + '&to=' + to;
                getCustomerTransactions(customer_id,datastr);
            }

            if (from != '') {
                if (hasRoute == false) {
                    exportUrl = exportUrl + type + '?';
                }
                exportUrl = exportUrl + 'from=' + from + '&to=' + to + '&';
                $("#export-button").attr("href", exportUrl);
            }
        });
    });
</script>
@endpush