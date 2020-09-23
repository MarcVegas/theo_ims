@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            <h2><i class="cogs icon"></i> Settings</h2>
            @include('inc.messages')
            <div class="ui stackable grid">
                <div class="row">
                    <div class="six wide column">
                        <h3>Category</h3>
                        <p>These options are used to classify the type of item a product is.</p>
                    </div>
                    <div class="ten wide column">
                        <div class="ui raised segment">
                            <form class="ui form" action="{{route('category.store')}}" method="POST">
                                @csrf
                                <div class="fields">
                                    <div class="six wide field">
                                        <input type="text" name="category" id="category" placeholder="Add a new category">
                                    </div>
                                    <div class="four wide field">
                                        <button type="submit" class="ui black button">Add</button>
                                    </div>
                                </div>
                            </form><br>
                            <div style="background-color: #f0dddd;border-radius:.5rem">
                                @if ($categories ?? '')
                                    <div class="ui doubling ten column padded grid">
                                        @foreach ($categories as $category)
                                            <div class="column">
                                                <div class="ui grey label" href="">{{$category->title}}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else 
                                    <div class="ui basic center aligned segment">
                                        No categories added yet
                                    </div>
                                @endif
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="six wide column">
                        <h3>Customer Type</h3>
                        <p>These options are used to classify the type of customer</p>
                    </div>
                    <div class="ten wide column">
                        <div class="ui raised segment">
                            <form class="ui form" action="" method="POST">
                                <div class="fields">
                                    <div class="six wide field">
                                        <input type="text" name="customer_type" id="customer_type" placeholder="Add a new customer type">
                                    </div>
                                    <div class="four wide field">
                                        <button type="submit" class="ui black button">Add</button>
                                    </div>
                                </div>
                            </form><br>
                            <div style="background-color: #f0dddd;border-radius:.5rem">
                                <div class="ui doubling twelve column padded grid">
                                    <div class="column">
                                        <a class="ui grey label" href="">Item 1</a>
                                    </div>
                                    <div class="column">
                                        <a class="ui grey label" href="">Item 2</a>
                                    </div>
                                    <div class="column">
                                        <a class="ui grey label" href="">Item 3</a>
                                    </div>
                                    <div class="column">
                                        <a class="ui grey label" href="">Item 4</a>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection