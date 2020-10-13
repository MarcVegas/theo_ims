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
                                        <button type="submit" class="ui teal button">Add</button>
                                    </div>
                                </div>
                            </form><br>
                            <div style="background-color: #f0dddd;border-radius:.5rem">
                                @if ($categories ?? '')
                                    <div class="ui doubling ten column padded grid">
                                        @foreach ($categories as $category)
                                            <div class="column">
                                                <a class="ui grey label" href="/category/{{$category->id}}/edit">{{$category->title}}</a>
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
                        <div class="six wide column">
                            <h3>Clear Cache</h3>
                            <p>The cache stores results in memory for a day to improve performance. Clearing the 
                                cache will destroy the results in memory and fetches new results from the 
                                database.
                            </p>
                        </div>
                    </div>
                    <div class="ten wide column">
                        <div class="ui raised padded right aligned segment">
                            <a class="ui black button" href="/settings/clearcache">Clear Cache</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="six wide column">
                        <div class="six wide column">
                            <h3>Backup Database</h3>
                            <p>An file of the database will be downloaded. You can upload this to any backup storage.
                            </p>
                        </div>
                    </div>
                    <div class="ten wide column">
                        <div class="ui raised padded right aligned segment">
                            <a class="ui black button" href="/backup">Backup</a>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="six wide column">
                        <div class="six wide column">
                            <h3>Password Reset</h3>
                            <p>Use a strong password with 8 characters or more</p>
                        </div>
                    </div>
                    <div class="ten wide column">
                        <div class="ui raised padded right aligned segment">
                            <a class="ui black button" href="{{ route('password.request') }}">Reset Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection