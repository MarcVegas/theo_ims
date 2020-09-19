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
                        <h2><i class="warehouse icon"></i> Update Supplier</h2>
                        <form class="ui equal width form" id="supplier-form" action="{!! action('SupplierController@update', $supplier->id) !!}" method="POST">
                            @csrf
                            <div class="field">
                                <label>Business Name</label>
                                <input type="text" name="name" id="name" value="{{$supplier->business_name}}" required>
                            </div>
                            <div class="field">
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="{{$supplier->address}}" required>
                            </div>
                            <br>
                            <h4>Optional Details</h4>
                            <div class="fields">
                                <div class="field">
                                    <label>Order Cutoff</label>
                                    <input type="date" name="order_cutoff" id="order_cutoff" value="{{$supplier->order_cutoff}}">
                                </div>
                                <div class="field">
                                    <label>Payment Cutoff</label>
                                    <input type="date" name="payment_cutoff" id="payment_cutoff" value="{{$supplier->payment_cutoff}}">
                                </div>
                                <div class="field">
                                    <label>Shipment Date</label>
                                    <input type="date" name="shipment_date" id="shipment_date" value="{{$supplier->shipment_date}}">
                                </div>
                            </div>
                            <input type="hidden" name="_method" value="PUT">
                            <a class="ui button" href="{{route('suppliers.index')}}"><i class="chevron left icon"></i> Back</a>
                            <button type="submit" class="ui green right floated button"><i class="save icon"></i> Save</button>
                        </form>
                    </div>
                </div>
                <div class="six wide column">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection