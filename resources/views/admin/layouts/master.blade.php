<!DOCTYPE html>
<html lang="en" class="blue-grey darken-4">
    <head>
        <title>Admin</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
        />

        @include('admin.layouts.components.favicons')

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap"
            rel="stylesheet"
        />
        <!--Import Google Icon Font-->
        <link
            href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('admin/libraries_frameworks/materialize/materialize.min.css') }}"
        />
        <script src="{{ asset('admin/libraries_frameworks/jquery/jquery-3.2.1.min.js') }}"></script>
        <script src="{{
                asset('admin/libraries_frameworks/materialize/materialize.min.js')
            }}"></script>
    </head>

    <body>
        @include('admin.layouts.header')

        <main class="mainContent white section">
            <!-- pretter-ignore -->
            @yield('mainContent')
        </main>

        <!-- pretter-ignore -->
        @include('admin.layouts.footer')

        <!-- pretter-ignore -->
        @yield('script')
    </body>
</html>
