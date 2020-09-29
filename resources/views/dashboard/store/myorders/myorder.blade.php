@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <h2><i class="cart plus icon"></i> New Order</h2>
            <div class="ui secondary menu">
                <div class="item">
                    <div class="ui form">
                        <div class="inline fields">
                            <div class="field">
                                <label>Supplier Name</label>
                                <input type="text" name="supplier" id="supplier" value="{{$supplier->business_name}}" readonly>
                            </div>
                            <div class="field">
                                <label>Current Total</label>
                                <input type="text" name="total" id="total" value="" placeholder="Order Total" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui secondary menu">
                <div class="item">
                    <button class="ui inverted red cancel button">Cancel Order</button>
                </div>
                <div class="right menu">
                    <div class="item">
                        <div class="ui floating dropdown icon teal button">
                        <i class="cart icon"></i>
                        <div class="floating ui small label" id="cart_count">0</div>
                            <div class="menu">
                                <div class="divider"></div>
                                <div class="header">
                                    <i class="shopping basket icon"></i>
                                    Your Cart
                                </div>
                                <div class="scrolling menu" id="cart_items">
        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <button class="ui blue icon labeled checkout disabled button"><i class="chevron right icon"></i> Checkout</button>
                    </div>
                </div>
            </div>
            <div class="ui segment">
                @if ($products ?? '')
                    <table class="ui tablet stackable selectable definition table">
                        <thead class="full-width">
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Remaining Qty</th>
                                <th>Supplier Price</th>
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
                                    <td>{{$product->stock->supplier_price}}</td>
                                    <td>
                                        @if ($product->stock->quantity > 0)
                                            <label class="ui green basic label">In Stock</label>
                                        @else
                                            <label class="ui orange basic label">Out of Stock</label>
                                        @endif
                                    </td>
                                    <td class="center aligned">
                                        @if ($product->stock->quantity > 0)
                                            <div class="ui orange fluid order button" id="{{$product->id}}">ORDER</div>
                                        @else
                                            <button class="ui orange fluid disabled button">ORDER</button>
                                        @endif
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
            <div class="ui tertiary segment">
                <p>Quantity and Status column refer to <b>your</b> inventory and <b>not</b> the supplier's inventory. You will have to contact your supplier for up-to-date 
                information regarding product availability.</p>
            </div>
        </div>
    </div>
</div>
<div class="ui tiny order modal">
    <i class="close icon"></i>
    <div class="content">
        <div class="ui stackable two column grid">
            <div class="column">
                <img class="ui centered small image" src="/storage/uploads/product.png" id="product_image" alt="">
            </div>
            <div class="column">
                <div class="ui form">
                    <div class="field">
                        <label>Product Name:</label>
                        <input type="text" name="product_name" id="product_name">
                    </div>
                    <div class="field">
                        <label>Order Quantity</label>
                        <input type="number" min="1" max="" id="cart_quantity">
                    </div>
                    <button class="ui blue right floated purchase button">Purchase</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui mini cancel modal">
    <i class="close icon"></i>
    <div class="header"><i class="exclamation triangle red icon"></i> Cancel Order?</div>
    <div class="content">
        <strong>Are you sure you want to cancel your order? All the items in your cart will be removed.</strong>
    </div>
    <div class="actions">
        <form action="{!! action('CartController@destroy', $customer->id) !!}" method="POST">
            @csrf
            <div class="ui deny button">
                No, I dont
            </div>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="ui inverted red button">
                Yes, cancel
            </button>
        </form>
    </div>
</div>
<div class="ui mini checkout modal">
    <i class="close icon"></i>
    <div class="header"><i class="shopping cart icon"></i> Confirm Checkout</div>
    <div class="content">
        <strong>Are you sure you want to checkout?</strong>
    </div>
    <div class="actions">
        <div class="ui deny button">
            No, continue shopping
        </div>
        <a class="ui inverted green button" href="/checkout/{{$customer->id}}">
            Yes, checkout
        </a>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        var product_id = '';
        var cart_quantity = 0;
        var customer_id = "{{$customer->id}}";
        var subtotal;

        $('.cancel.modal').modal('attach events', '.cancel.button', 'show');
        $('.checkout.modal').modal('attach events', '.checkout.button', 'show');

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        function getCart() {
            $.ajax({
                    type: "GET",
                    url: '/cart/' + customer_id,
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#cart_items').html(data);
                        subtotal = $('#subtotal').val();
                        $('#total').val(subtotal);
                        setOrdered();
                        getCartCount();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        }

        getCart();

        function getCartCount() {
            $.ajax({
                    type: "GET",
                    url: '/cart/count/' + customer_id,
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#cart_count').text(data)
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        }

        function setOrdered() {
            $.ajax({
                    type: "GET",
                    url: '/cart/ordered/' + customer_id,
                    data: "",
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        data.forEach(item => {
                            $('#'+item.product_id).addClass("disabled").text('ADDED TO CART');
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        }

        $('.order.button').click(function () {
            product_id = $(this).attr('id');
            $('#cart_quantity').val('');
            $.ajax({
                    type: "GET",
                    url: '/product/' + product_id,
                    data: "",
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        $('#product_name').val(data.name);
                        $('#cart_quantity').attr("max", data.stock.quantity);
                        $('#product_image').attr("src","/storage/uploads/"+data.image);
                        $('.order.modal').modal('show');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        });

        $('.purchase.button').click(function () {
            cart_quantity = $('#cart_quantity').val();
            var datastr = "product_id=" + product_id + "&cart_quantity=" + cart_quantity + "&customer_id=" + customer_id;

            $.ajax({
                    type: "POST",
                    url: '/cart',
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        $('.order.modal').modal('hide');
                        $('#'+product_id).addClass("disabled").text('ADDED TO CART');
                        getCart();
                        $('.checkout.button').removeClass('disabled');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
        });
    });
</script>
@endpush