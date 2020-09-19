@extends('layouts.login')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <img src="/storage/images/theo_overruns.png" class="ui small centered image">
        <h2 class="ui teal header">
        <div class="content">
            Log-in to your account
        </div>
        </h2>
        <form class="ui large form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="email" name="email" placeholder="E-mail address" required>
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
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    @error('password')
                        <span style="color:orangered" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="ui fluid large teal submit button">{{ __('Login') }}</button><br>
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        </form>

        @if (Route::has('password.request'))
            <div class="ui message">
                {{ __('Forgot Your Password?') }} <a href="{{ route('password.request') }}">Click here</a>
            </div>
        @endif
    </div>
</div>
@endsection
