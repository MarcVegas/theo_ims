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
                        <div class="ui middle aligned animated relaxed list">
                            <div class="item">
                                <i class="box brown icon"></i>
                                <div class="content">
                                    <div class="header"><a href="">Jogging Pants</a> from J and T is out of stock</div>
                                    <div class="description">On 02 Oct 2020</div>
                                </div>
                            </div>
                            <div class="item">
                                <i class="box brown icon"></i>
                                <div class="content">
                                    <div class="header">Christian</div>
                                    <div class="description">On 02 Oct 2020</div>
                                </div>
                            </div>
                            <div class="item">
                                <i class="box brown icon"></i>
                                <div class="content">
                                    <div class="header">Daniel</div>
                                    <div class="description">On 02 Oct 2020</div>
                                </div>
                            </div>
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