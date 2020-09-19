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
                        <h2><i class="user icon"></i> Update Customer</h2>
                        <form class="ui equal width form" id="customer-form" action="{!! action('CustomerController@update', $customer->id) !!}" method="POST">
                            @csrf
                            <div class="fields">
                                <div class="field">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" id="firstname" value="{{$customer->firstname}}" required>
                                </div>
                                <div class="field">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" id="lastname" value="{{$customer->lastname}}" required>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Address</label>
                                    <input type="text" name="address" id="address" value="{{$customer->address}}" required>
                                </div>
                                <div class="field">
                                    <label>Customer type</label>
                                    <input type="text" name="type" id="type" value="{{$customer->type}}" required>
                                </div>
                            </div>
                            <a class="ui button" href="{{route('customers.index')}}"><i class="chevron left icon"></i> Back</a>
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