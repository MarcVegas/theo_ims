@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <h2><i class="boxes icon"></i> My Products</h2>
            <div class="ui secondary menu">
                <div class="item">
                    <select class="ui search dropdown" name="category" id="category">
                        <option value="">Filter category</option>
                    </select>
                </div>
                <div class="right menu">
                    <div class="item">
                        <a class="ui teal button" href="{{route('products.create')}}"><i class="plus icon"></i> Add Product</a>
                    </div>
                </div>
            </div>
            <div class="ui raised segment">
                @if ($products ?? '')
                    <table class="ui tablet stackable selectable definition table">
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
                                        <button class="ui icon delete button"><i class="trash icon"></i></button>
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
        </div>
    </div>
</div>
@endsection