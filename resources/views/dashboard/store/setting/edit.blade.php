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
                    <div class="ten wide column">
                        <div class="ui raised segment">
                            <form class="ui form" id="category-edit" action="{!! action('CategoryController@update', $category->id) !!}" method="POST">
                                @csrf
                                <div class="field">
                                    <label>Category Name</label>
                                    <input type="text" name="category" id="category" value="{{$category->title}}" placeholder="Add a new category">
                                    <input type="hidden" name="_method" value="PUT">
                                </div>
                            </form><br>
                            <a class="ui button" href="/settings"><i class="angle left icon"></i> Back</a>
                            <button type="submit" form="category-edit" class="ui teal right floated button"><i class="save icon"></i> Save</button>
                            <button type="submit" form="category-delete" class="ui red right floated button"><i class="trash icon"></i> Remove</button>
                            <form id="category-delete" action="{!! action('CategoryController@destroy', $category->id) !!}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                        </div>
                    </div>
                    <div class="six wide column">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection