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
                        <h2><i class="user icon"></i> New Customer</h2>
                        <form class="ui equal width form" id="customer-form" action="{{route('customers.store')}}" method="POST">
                            @csrf
                            <div class="fields">
                                <div class="field">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" id="firstname" required>
                                </div>
                                <div class="field">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" id="lastname" required>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Address</label>
                                    <input type="text" name="address" id="address" required>
                                </div>
                                <div class="field">
                                    <label>Customer type</label>
                                    <select class="ui dropdown" name="type" id="type">
                                        <option value="">Select Type</option>
                                        <option value="reseller">Reseller</option>
                                        <option value="owner">Owner (Me)</option>
                                    </select>
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