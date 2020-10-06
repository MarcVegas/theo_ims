@extends('layouts.login')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <img src="/storage/images/theo_overruns.png" class="ui small centered image">
        <h2 class="ui teal header">
        <div class="content">
            {{ __('Reset Password') }}
        </div>
        </h2>
        <form class="ui large form" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="ui stacked segment">
                <div class="field">
                    <label>{{ __('E-Mail Address') }}</label>
                    <input type="email" name="email" placeholder="E-mail address" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <div class="ui negative message" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="field">
                    <label>{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" placeholder="New Password" required>
                    @error('password')
                        <div class="ui negative message" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="field">
                    <label>{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm New Password" required>
                    @error('password')
                        <div class="ui negative message" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <button type="submit" class="ui fluid large teal submit button">{{ __('Reset Password') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

