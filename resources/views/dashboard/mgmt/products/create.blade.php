@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            <div class="ui stackable padded grid">
                <div class="ten wide column">
                    <div class="ui raised segment">
                        @include('inc.messages')
                        <h2><i class="box icon"></i> New Product</h2>
                        <form class="ui equal width form" id="product-form" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="field">
                                <label>Product Name</label>
                                <input type="text" name="name" id="name" required>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Category</label>
                                    <select class="ui search dropdown" name="category" id="category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->title}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Supplier</label>
                                    <select class="ui search dropdown" name="supplier" id="supplier" required>
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->business_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="fields">
                                <div class="field">
                                    <label>Supplier Price (Wholesale)</label>
                                    <input type="text" name="supplier_price" id="supplier_price" required>
                                </div>
                                <div class="field">
                                    <label>Selling Price (Retail)</label>
                                    <input type="text" name="seller_price" id="seller_price" required>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Initial Quantity</label>
                                    <input type="number" name="quantity" id="quantity" min="1" required>
                                </div>
                                <div class="field">
                                    <label>Quantity per Bundle (optional)</label>
                                    <input type="number" name="quantity_bundle" id="quantity_bundle" min="1">
                                </div>
                            </div>
                            <a class="ui button" href="{{route('products.index')}}"><i class="chevron left icon"></i> Back</a>
                            <button type="submit" class="ui green right floated button"><i class="save icon"></i> Save</button>
                        </form>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui raised center aligned segment">
                        <br>
                        <img class="ui small rounded centered image" src="/storage/images/product.png" alt=""><br>
                        <input type="file" (change)="fileEvent($event)" form="product-form" class="inputfile" name="photo" id="photo"/>
                        <label for="photo" class="ui blue button">
                            <i class="camera icon"></i>
                            Upload Photo
                        </label><br>
                        <div class="ui tertiary segment">
                            <b>IMPORTANT:</b> Image size limit is 5mb. Images with larger sizes will take longer to upload.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $(document).ready(function () {
            $('.green.button').click(function () {
                $('.green.button').addClass('loading disabled');
            });
        });
    </script>
@endpush