@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <div class="ui stackable grid">
                <div class="ten wide column">
                    <div class="ui basic active tab segment">
                        <div class="ui segments">
                            <div class="ui inverted brown padded segment">
                                <h2 class="ui header">
                                    <i class="reply icon"></i>
                                    <div class="content">
                                        Return Product
                                    </div>
                                </h2>
                            </div>
                            <div class="ui padded segment">
                                @if ($order ?? '')
                                    <form class="ui form" action="{!! action('ReturnsController@update', $order->transaction_id) !!}" method="POST">
                                        @csrf
                                        <div class="field">
                                            <label>Product Name</label>
                                            <input type="text" name="product" id="product" value="{{$order->product->name}}" readonly>
                                        </div>
                                        <div class="equal width fields">
                                            <div class="field">
                                                <label>Order Quantity</label>
                                                <input type="text" name="quantity" id="quantity" value="{{$order->order_quantity}}" readonly>
                                            </div>
                                            <div class="field">
                                                <label>Price</label>
                                                <input type="text" name="price" id="price" value="{{$order->order_price}}" readonly>
                                            </div>
                                            <div class="field">
                                                <label>Subtotal</label>
                                                <input type="text" name="subtotal" id="subtotal" value="{{$order->subtotal}}" readonly>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label>No. of items to return</label>
                                            <input type="number" name="returned" id="returned" min="1" max="{{$order->order_quantity}}" required>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{$order->product_id}}">
                                        <input type="hidden" name="type" value="{{($order->transaction->supplier_id != null) ? 'restock' : 'buyer'}}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <a class="ui button" href="{{route('transactions.index')}}">Go back</a>
                                        
                                        <button class="ui blue right floated button" type="submit">Proceed</button>
                                    </form>
                                @else
                                    <div class="ui basic center aligned segment">
                                        Could not fetch transaction data
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="six wide column">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $(document).ready(function () {
            $('.blue.button').click(function () {
                $('.blue.button').addClass('loading disabled');
            });
        });
    </script>
@endpush