@extends('layouts.login')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal header">
        <div class="content">
            {{ __('Reset Password') }}
        </div>
        </h2>
        <form class="ui large form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="ui stacked segment">
                <div class="field">
                    <label>{{ __('E-Mail Address') }}</label>
                    <input type="email" name="email" placeholder="youremail@user.com" required autofocus>
                    @error('email')
                        <div class="ui negative message" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <button type="submit" class="ui fluid large blue submit button">{{ __('Send Password Reset Link') }}</button>
            </div>
            <a href="/settings">Back to Settings</a>
        </form>
    </div>
</div>
@endsection
