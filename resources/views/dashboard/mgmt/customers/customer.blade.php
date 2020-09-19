@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <h2><i class="users icon"></i> Suppliers</h2>
            <div class="ui secondary menu">
                <div class="item">
                    <div class="ui form">
                        <div class="field">
                            <input type="text" name="search" placeholder="Search customer">
                        </div>
                    </div>
                </div>
                <div class="right menu">
                    <div class="item">
                        <a class="ui teal button" href="{{route('customers.create')}}"><i class="plus icon"></i> Add Customer</a>
                    </div>
                </div>
            </div>
            <div class="ui raised segment">
                @if ($customers ?? '')
                    <table class="ui tablet stackable selectable definition table">
                        <thead class="full-width">
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Address</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{$customer->firstname}}</td>
                                    <td>{{$customer->lastname}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->type}}</td>
                                    <td class="collapsing">
                                        <a class="ui icon button" href="customers/{{$customer->id}}"><i class="eye icon"></i></a>
                                        <a class="ui icon button" href="customers/{{$customer->id}}/edit"><i class="pencil alternate icon"></i></a>
                                        <a class="ui icon button" href=""><i class="trash icon"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="ui basic center aligned segment">
                        <h3>No Customer Added Yet</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection