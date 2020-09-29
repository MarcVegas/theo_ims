@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <div class="ui stackable padded grid">
                <div class="ten wide column">
                    <div class="ui raised segment">
                        <h2><i class="user icon"></i> Profile</h2>
                        <div class="ui form">
                            <div class="field">
                                <label>Fullname</label>
                                <input type="text" name="name" id="name" value="{{$user->name}}" readonly>
                            </div>
                            <div class="field">
                                <label>Email Address</label>
                                <input type="text" name="email" id="email" value="{{$user->email}}" readonly>
                            </div><br>
                            <a class="ui blue right aligned button" href="/profile/{{$user->id}}/edit"><i class="edit icon"></i> Edit</a>
                        </div>
                    </div>
                    <div class="ui raised segment">
                        <h2><i class="address card outline icon"></i> Business Details</h2>
                        <div class="ui form">
                            <div class="field">
                                <label>Business Name</label>
                                <input type="text" name="business_name" id="business_name" value="{{$detail->firstname}}" readonly>
                            </div>
                            <div class="field">
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="{{$detail->address}}" readonly>
                            </div>
                            <div class="field">
                                <label>Contact</label>
                                <input type="text" name="contact" id="contact" value="{{$detail->contact}}" readonly>
                            </div>
                            <a class="ui blue right aligned button" href="/profile/{{$user->id}}/edit"><i class="edit icon"></i> Edit</a>
                        </div>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui raised padded segment">
                        <img class="ui centered small circular image" src="/storage/images/{{$user->avatar}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection