<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "Tôi thiết kế's Blog") }}</title>

    @include('layouts.components.favicons')

    <!-- Scripts -->
    <script src="{{ asset('js/blade-pages.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!--Import Google Icon Font-->
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet"
    />

    <!-- Styles -->
    <link href="{{ asset('css/blade-pages.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/libraries_frameworks/materialize/materialize.min.css') }}"/>
    <script src="{{ asset('admin/libraries_frameworks/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/libraries_frameworks/materialize/materialize.min.js') }}"></script>
</head>
<body>
    @include('layouts.components.header')
    <main>
        @yield('content')

        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
                <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
                <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
                <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
                <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
            </ul>
        </div>
    </main>
</body>
</html>
