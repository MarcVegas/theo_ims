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
            <h2><i class="cart plus icon"></i> New Order</h2>
            <div class="ui secondary menu">
                <div class="item">
                    <div class="ui form">
                        <div class="inline fields">
                            <div class="field">
                                <label>Customer</label>
                                <input type="text" name="customer" id="customer" value="{{$customer->firstname}} {{$customer->lastname}}" readonly>
                            </div>
                            <div class="field">
                                <label>Current Total</label>
                                <input type="text" name="total" id="total" value="" placeholder="Order Total" readonly>
                            </div>
                        </div>
                        <input type="hidden" name="customer_id" id="customer_id" value="{{$customer->id}}">
                    </div>
                </div>
            </div>
            <div class="ui secondary menu">
                <div class="item">
                    <button class="ui inverted red cancel disabled button">Cancel Order</button>
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
                    <table class="ui tablet stackable selectable definition table" id="shop-table">
                        <thead class="full-width">
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
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
                                    <td class="center aligned">
                                        @if ($product->stock->quantity > 0)
                                            <div class="ui orange order button" id="{{$product->id}}">ORDER</div>
                                        @else
                                            <button class="ui orange disabled button">ORDER</button>
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
<div class="ui tiny checkout modal">
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
        var order_type = "buy";

        $('.cancel.modal').modal('attach events', '.cancel.button', 'show');
        $('.checkout.modal').modal('attach events', '.checkout.button', 'show');

        $('#shop-table').DataTable({
            "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
            "order": [],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            }]
        });

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
                        if (data != '') {
                            $('.checkout.button').removeClass('disabled');
                            $('.cancel.button').removeClass('disabled');
                        }
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
            var datastr = "product_id=" + product_id + "&cart_quantity=" + cart_quantity + "&customer_id=" + customer_id + "&order_type=" + order_type;

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