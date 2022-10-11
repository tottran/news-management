<!DOCTYPE html>
<html lang="en" class="blue-grey darken-4">
    <head>
        <title>Login admin test</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
        />
        <!-- favicon -->
        <link
            rel="apple-touch-icon"
            sizes="57x57"
            href="{{ asset('admin/apple-icon-57x57.png') }}"
        />
        <link
            rel="apple-touch-icon"
            sizes="60x60"
            href="{{ asset('admin/apple-icon-60x60.png') }}"
        />
        <link
            rel="apple-touch-icon"
            sizes="72x72"
            href="{{ asset('admin/apple-icon-72x72.png') }}"
        />
        <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="{{ asset('admin/apple-icon-76x76.png') }}"
        />
        <link
            rel="apple-touch-icon"
            sizes="114x114"
            href="{{ asset('admin/apple-icon-114x114.png') }}"
        />
        <link
            rel="apple-touch-icon"
            sizes="120x120"
            href="{{ asset('admin/apple-icon-120x120.png') }}"
        />
        <link
            rel="apple-touch-icon"
            sizes="144x144"
            href="{{ asset('admin/apple-icon-144x144.png') }}"
        />
        <link
            rel="apple-touch-icon"
            sizes="152x152"
            href="{{ asset('admin/apple-icon-152x152.png') }}"
        />
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="{{ asset('admin/apple-icon-180x180.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="192x192"
            href="{{ asset('admin/android-icon-192x192.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="{{ asset('admin/favicon-32x32.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="96x96"
            href="{{ asset('admin/favicon-96x96.png') }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="{{ asset('admin/favicon-16x16.png') }}"
        />
        <link rel="manifest" href="/manifest.json" />
        <meta name="msapplication-TileColor" content="#ffffff" />
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" />
        <meta name="theme-color" content="#ffffff" />
        <!-- endfavicon -->
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
        <link rel="stylesheet" href="{{ asset('admin/css/pages/login.css') }}" />
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
        <div class="login">
            <div class="cover"></div>
            <div class="form">
                <div class="row rowForm">
                    <form class="col s12" method="POST" action="login">
                        @if(count($errors) > 0)
                        <div class="card-panel deep-orange lighten-2">
                            @foreach($errors->all() as $err)
                            {{ $err }}<br />
                            @endforeach
                        </div>
                        @endif @if(session('thongbao'))
                        <div class="card-panel deep-orange lighten-2">
                            {{ session("thongbao") }}
                        </div>
                        @endif
                        <input
                            type="hidden"
                            name="_token"
                            value="{{ csrf_token() }}"
                        />

                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Email"
                                    id="email"
                                    type="email"
                                    class="validate"
                                    name="email"
                                    autoFocus
                                />
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                    id="password"
                                    type="password"
                                    class="validate"
                                    name="password"
                                />
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="center-align">
                            <button
                                class="btn waves-effect waves-light"
                                type="submit"
                                name="action"
                            >
                                Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
