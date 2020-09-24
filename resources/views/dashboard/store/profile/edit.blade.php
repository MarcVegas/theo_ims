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
                        <form class="ui equal width form" id="profile-form">
                            @csrf
                            <div class="field">
                                <label>Fullname</label>
                                <input type="text" name="name" id="name" value="{{$user->name}}" readonly>
                            </div>
                            <div class="field">
                                <label>Email Address</label>
                                <input type="text" name="email" id="email" value="{{$user->email}}" readonly>
                            </div>
                            <a class="ui blue right floated button" href=""><i class="edit icon"></i> Edit</a>
                        </form>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui raised padded segment">
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