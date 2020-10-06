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
                        <h2><i class="warehouse icon"></i> Supplier Details</h2>
                        <div class="ui equal width form">
                            <div class="field">
                                <label>Business Name</label>
                                <input type="text" name="name" id="name" value="{{$supplier->business_name}}" readonly>
                            </div>
                            <div class="field">
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="{{$supplier->address}}" readonly>
                            </div>
                            <br>
                            <h4>Optional Details</h4>
                            <div class="fields">
                                <div class="field">
                                    <label>Order Cutoff</label>
                                    <input type="date" name="order_cutoff" id="order_cutoff" value="{{$supplier->order_cutoff}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Payment Cutoff</label>
                                    <input type="date" name="payment_cutoff" id="payment_cutoff" value="{{$supplier->payment_cutoff}}" readonly>
                                </div>
                                <div class="field">
                                    <label>Shipment Date</label>
                                    <input type="date" name="shipment_date" id="shipment_date" value="{{$supplier->shipment_date}}" readonly>
                                </div>
                            </div>
                            <input type="hidden" name="_method" value="PUT">
                            <a class="ui button" href="{{route('suppliers.index')}}"><i class="chevron left icon"></i> Back</a>
                            <a class="ui blue right floated button" href="{{$supplier->id}}/edit"><i class="edit icon"></i> Edit</a>
                            <button class="ui inverted red icon right floated delete button"><i class="trash icon"></i> Delete</button>
                        </div>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui placeholder center aligned segment">
                        <div class="ui icon header">
                          <i class="cart plus red icon"></i>
                        </div>
                        <strong>Add new items to your inventory from this supplier</strong><br>
                        <a class="ui orange button" href="/restock/{{$supplier->id}}">Order Now</a>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui mini modal">
    <i class="close icon"></i>
    <div class="header"><i class="exclamation triangle red icon"></i> Remove supplier?</div>
    <div class="content">
        <strong>Are you sure you want to permanently remove this supplier? This action cannot be reversed.</strong>
        <br><br>
        @if (count($supplier->product) > 0)
            <div class="ui secondary inverted red segment">This supplier has several products associated with it.
                Please change the product's supplier or delete the product before removing this supplier.
            </div>
        @endif
    </div>
    <div class="actions">
        <form action="{!! action('SupplierController@destroy', $supplier->id) !!}" method="POST">
            @if (count($supplier->product) == 0)
                <div class="ui deny button">
                    No, I dont
                </div>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="ui inverted red button">
                    Yes, proceed
                </button>
            @else 
            <div class="ui deny button">
                Ok, got it
            </div>
            @endif
        </form>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        $('.mini.modal').modal('attach events', '.delete.button', 'show');
    });
</script>
@endpush