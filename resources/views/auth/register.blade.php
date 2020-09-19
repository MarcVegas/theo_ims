@extends('layouts.login')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <img src="/storage/images/theo_overruns.png" class="ui small centered image">
        <h2 class="ui teal header">
        <div class="content">
            Register a new account
        </div>
        </h2>
        <form class="ui large form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Fullname" required autofocus>
                    </div>
                    @error('name')
                        <span style="color:orangered" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="address card icon"></i>
                        <input type="email" name="email" id="email" placeholder="E-mail address" required>
                    </div>
                    @error('email')
                        <span style="color:orangered" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    @error('password')
                        <span style="color:orangered" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password_confirmation" id="password-confirm" placeholder="Confirm Password" required>
                    </div>
                    @error('password')
                        <span style="color:orangered" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="ui fluid large blue submit button">{{ __('Register') }}</button><br>
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
