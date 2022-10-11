@extends('user.layouts.app')

@section('content')
    {{-- FB root init - START --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0&appId=629175208783346&autoLogAppEvents=1" nonce="ACXbUafS"></script>
    {{-- FB root init - END --}}
    
    <div id="app">
        {{-- FB Button --}}
        <div class="fb-login-button" data-width="270" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="true"></div>
    </div>
    
    {{-- FB Init - START --}}
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '{{ env('FB_APP_ID') }}',
                cookie     : true,
                xfbml      : true,
                version    : 'v2.8'
            });
            
            FB.AppEvents.logPageView();
            
            startWorkingWithFBAPI();// fn insign resources/js/pages/home.js
        };
        
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    {{-- FB Init - END --}}
@endsection
