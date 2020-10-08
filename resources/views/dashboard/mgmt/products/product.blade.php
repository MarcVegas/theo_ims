@extends('layouts.app')

@push('datatables')
  <script src="{{ asset('js/datatables.min.js') }}" defer></script>
@endpush
@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment">
            @include('inc.messages')
            <h2><i class="boxes icon"></i> My Products</h2>
            <div class="ui secondary menu">
                <div class="item active" data-tab="first">
                    Products
                </div>
                <div class="nostock item" data-tab="second">
                    Out of Stock <label class="ui orange label" id="nostock-count">0</label>
                </div>
                <div class="right menu">
                    <div class="item">
                        <a class="ui teal button" href="{{route('products.create')}}"><i class="plus icon"></i> Add Product</a>
                    </div>
                </div>
            </div>
            <div class="ui raised active tab segment" data-tab="first">
                @if ($products ?? '')
                    <table class="ui tablet stackable selectable definition table" id="product-table">
                        <thead class="full-width">
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Selling Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category}}</td>
                                    <td>{{$product->stock->quantity}}</td>
                                    <td>{{$product->selling_price}}</td>
                                    <td>
                                        @if ($product->stock->quantity > 0)
                                            <label class="ui green basic label">In Stock</label>
                                        @else
                                            <label class="ui orange basic label">Out of Stock</label>
                                        @endif
                                    </td>
                                    <td class="collapsing">
                                        <a class="ui icon button" href="products/{{$product->id}}"><i class="eye icon"></i></a>
                                        <a class="ui icon button" href="products/{{$product->id}}/edit"><i class="pencil alternate icon"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else 
                    <div class="us basic center aligned segment">
                        <h3>No Products Available</h3>
                    </div>
                @endif
            </div>
            <div class="ui raised tab segment" id="nostock-tab" data-tab="second">

            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        var count;

        $('#product-table').DataTable({
            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "order": [],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            }]
        });

        function getNoStocks() {
            $.ajax({
                    type: "GET",
                    url: '/product/nostock/all',
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#nostock-tab').html(data);
                        count = $('#stockcount').val();
                        $('#nostock-count').text(count);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        }

       getNoStocks();
    });
</script>
@endpush