@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <h2><i class="handshake icon"></i> Transaction Details</h2>
            <div class="ui grid stackable padded">
                <div class="four wide computer eight wide tablet sixteen wide mobile column">
                    <div class="ui form">
                        <div class="inline field">
                            <label>ID:</label>
                            <div class="ui green label"></div>
                        </div>
                        <div class="inline field">
                            <label>Customer:</label>
                            <input type="text" name="name" id="name" readonly>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile column">
                    <div class="ui form">
                        <div class="inline field">
                            <label>Order Total:</label>
                            <input type="text" name="total" id="total" readonly>
                        </div>
                        <div class="inline field">
                            <label>Cash Payment:</label>
                            <input type="text" name="cash" id="cash" readonly>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile column">
                    <div class="ui form">
                        <div class="inline field">
                            <label>Status:</label>
                            <input type="text" name="total" id="total" readonly>
                        </div>
                        <div class="inline field">
                            <label>Date:</label>
                            <input type="text" name="cash" id="cash" readonly>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile column">
                    <h1 class="ui blue header"></h1>
                </div>
            </div>
            <h3>Orders</h3>
            <div class="ui segment">
                <table class="ui tablet stackable selectable definition table" id="order-table">
                    <thead class="full-width">
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Navy Jeans</td>
                            <td>10</td>
                            <td>200</td>
                            <td>2000</td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('ajax')
<script>
    $(document).ready(function (){
        $('#transaction-table').DataTable({
            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
        });
    });
</script>
@endsection