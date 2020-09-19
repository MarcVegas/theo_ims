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
                        <h2><i class="user icon"></i> Profile</h2>
                        <div class="ui equal width form">
                            <div class="fields">
                                <div class="field">
                                    <label>Fullname</label>
                                    <input type="text" name="name" id="name" readonly>
                                </div>
                                <div class="field">
                                    <label>Email Address</label>
                                    <input type="text" name="email" id="email" readonly>
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
                            <a class="ui blue right floated button"><i class="edit icon"></i> Edit</a>
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