@extends('layouts.login')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <i class="exclamation triangle big red icon"></i>
        <h2 class="ui teal header">
            <div class="content">
                {{$error}}
            </div>
        </h2>
    </div>
</div>
@endsection
