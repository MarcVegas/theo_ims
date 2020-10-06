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
                    <h2><i class="bell icon"></i> Notifications</h2>
                </div>
                <div class="six wide column">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection