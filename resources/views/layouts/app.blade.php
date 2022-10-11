<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', "Tôi thiết kế's Blog") }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.components.favicons')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        window.Laravel = {!! json_encode([
            'baseUrl' => url('/'),
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <!-- Scripts -->
    @env('local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endenv
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    @yield('content')
</body>
</html>
