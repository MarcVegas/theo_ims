@if (count($errors) > 0)
    <div class="ui warning message">
        <i class="close icon"></i>
            <div class="header">
                Oops! Something went wrong
            </div>
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        </div>
@endif

@if (session('success'))
    <div class="ui success message">
    <i class="close icon"></i>
        <div class="header">
            {{session('success')}}
        </div>
    </div>
@endif

@if (session('error'))
<div class="ui success message">
    <i class="close icon"></i>
        <div class="header">
            {{session('error')}}
        </div>
    </div>
@endif