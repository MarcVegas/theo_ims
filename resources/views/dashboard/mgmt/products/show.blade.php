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
                        @if ($product->stock->quantity == 0 || $product->stock->quantity == null)
                            <div class="ui red right ribbon label">Out of Stock</div>
                        @endif
                        <h2><i class="box icon"></i>Product Details</h2>
                        <div class="ui equal width form">
                            <div class="field">
                                <label>Product Name</label>
                                <input type="text" name="name" id="name" value="{{$product->name}}" readonly>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Category</label>
                                    <input type="text" name="category" id="category" value="{{$product->category}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Supplier</label>
                                    <input type="text" name="supplier" id="supplier" value="{{$supplier->business_name}}" readonly>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" id="quantity" value="{{$product->stock->quantity}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Quantity per Bundle (optional)</label>
                                    <input type="text" name="quantity_bundle" id="quantity_bundle" value="{{$product->stock->quantity_per_bundle}}" readonly>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Supplier Price (Wholesale)</label>
                                    <input type="text" name="supplier_price" id="supplier_price" value="{{$product->stock->supplier_price}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Selling Price (Retail)</label>
                                    <input type="text" name="seller_price" id="seller_price" value="{{$product->selling_price}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Difference</label>
                                    <input type="text" name="difference" id="difference" value="{{$product->difference}}" readonly>
                                </div>
                            </div>
                            <br>
                            <div style="background-color: #f0dddd;border-radius:.5rem">
                                <div class="ui stackable three column padded grid">
                                    <div class="column">
                                        <h4 class="ui header">
                                            <i class="circle blue icon"></i>
                                            <div class="content">
                                                {{$product->stock->bundle_amount}}
                                                <div class="sub header">Total Amount</div>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="column">
                                        <h4 class="ui header">
                                            <i class="life ring orange icon"></i>
                                            <div class="content">
                                                {{$product->stock->gross_amount}}
                                                <div class="sub header">Gross Amount</div>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="column">
                                        <h4 class="ui header">
                                            <i class="life ring outline green icon"></i>
                                            <div class="content">
                                                {{$product->stock->net_amount}}
                                                <div class="sub header">Net Amount</div>
                                            </div>
                                        </h4>
                                    </div>
                                </div>
                            </div><br>
                            <a class="ui button" href="{{route('products.index')}}"><i class="chevron left icon"></i> Back</a>
                            <a class="ui blue right floated button" href="{{$product->id}}/edit"><i class="edit icon"></i> Edit</a>
                            <button class="ui inverted red icon right floated delete button"><i class="trash icon"></i> Delete</button>
                        </div>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui raised center aligned segment">
                        <br>
                        <img class="ui small rounded centered image" src="/storage/images/product.png" alt=""><br>
                        <input type="file" (change)="fileEvent($event)" form="product-form" class="inputfile" name="photo" id="photo"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui mini modal">
    <i class="close icon"></i>
    <div class="header"><i class="exclamation triangle red icon"></i> Remove product?</div>
    <div class="content">
        <strong>Are you sure you want to permanently remove this product? This action cannot be reversed.</strong>
    </div>
    <div class="actions">
        <form action="{!! action('ProductsController@destroy', $product->id) !!}" method="POST">
            <div class="ui deny button">
                No, I dont
            </div>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="ui inverted red button">
                Yes, proceed
            </button>
        </form>
    </div>
</div>
@endsection