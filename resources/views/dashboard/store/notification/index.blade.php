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
                    <h2><i class="bell icon"></i> Notifications</h2><br>
                    <div class="ui padded segment">
                        <div class="ui blue ribbon label">Just Now</div>
                        <br>
                        @if ($notifications ?? '')
                            <div class="ui middle aligned animated relaxed list">
                                @foreach ($notifications as $notification)
                                    <div class="item">
                                        <i class="box brown icon"></i>
                                        <div class="content">
                                            <div class="header"><a href="/products/{{$notification->product_id}}">{{$notification->product->name}}</a> {{$notification->description}}</div>
                                            <div class="description">{{date('d M Y', strtotime($notification->created_at))}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="ui basic center aliged segment">
                                <h3>No new notifications</h3>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="six wide column">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection