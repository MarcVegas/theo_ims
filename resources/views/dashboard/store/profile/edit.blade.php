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
                        <form class="ui equal width form" action="{!! action('ProfileController@update', $user->id) !!}" method="POST" id="profile-form">
                            @csrf
                            <div class="field">
                                <label>Fullname</label>
                                <input type="text" name="name" id="name" value="{{$user->name}}">
                            </div>
                            <div class="field">
                                <label>Email Address</label>
                                <input type="text" name="email" id="email" value="{{$user->email}}">
                            </div>
                            <input type="hidden" name="_method" value="PUT">
                            <button class="ui green right floated button"><i class="save outline icon"></i> Save</button>
                            <br><br>
                        </form>
                    </div>
                    <div class="ui raised segment">
                        <h2><i class="address card outline icon"></i> Business Details</h2>
                        <form class="ui form" action="{!! action('CustomerController@update', $detail->id) !!}" method="POST">
                            @csrf
                            <div class="field">
                                <label>Business Name</label>
                                <input type="text" name="firstname" id="firstname" value="{{$detail->firstname}}">
                            </div>
                            <div class="field">
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="{{$detail->address}}">
                            </div>
                            <div class="field">
                                <label>Contact</label>
                                <input type="tel" name="contact" id="contact" value="{{$detail->contact}}" placeholder="+63 xxx xxx xxxx">
                            </div>
                            <input type="hidden" name="lastname" id="lastname" value="and more">
                            <input type="hidden" name="_method" value="PUT">
                            <button class="ui green right floated button" type="submit"><i class="save icon"></i> Save</button>
                            <br><br>
                        </form>
                    </div>
                    <a class="ui button" href="{{route('profile.index')}}">Go Back</a>
                </div>
                <div class="six wide column">
                    <div class="ui raised padded center aligned segment">
                        <img class="ui centered small circular image" src="/storage/images/{{$user->avatar}}" alt=""><br>
                        <input type="file" (change)="fileEvent($event)" form="profile-form" class="inputfile" name="photo" id="photo"/>
                        <label for="photo" class="ui blue button">
                            <i class="camera icon"></i>
                            Upload Photo
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection