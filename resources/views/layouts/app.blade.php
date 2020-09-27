<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Theo IMS') }}</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/semantic.min.css')}}" rel="stylesheet">
    <link rel="preload" href="{{ asset('css/semantic.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/semantic.min.css')}}"></noscript>
    <link href="{{ asset('css/dashboard.css')}}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css')}}" rel="stylesheet">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}" defer></script>
    <script src="{{ asset('js/master-semantic.min.js') }}" defer></script>
    @stack('datatables')
</head>
<body>
    @yield('content')
    @stack('ajax')
</body>
</html>
