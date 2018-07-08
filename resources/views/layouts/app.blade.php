<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dumpster') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    @if($_SERVER['HTTP_HOST'] == 'localhost')
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    @else
        <link href="{{asset('public/css/app.css')}}" rel="stylesheet" type="text/css">
    @endif

    @if($_SERVER['HTTP_HOST'] == 'localhost')
        <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
    @else
        <link href="{{asset('public/css/custom.css')}}" rel="stylesheet" type="text/css">
    @endif

    @yield('css')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if($_SERVER['HTTP_HOST'] == 'localhost')
                        <img src="{{asset('img/logo.png')}}" class="img_logo">
                    @else
                        <img src="{{asset('public/img/logo.png')}}" class="img_logo">
                    @endif
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <ul class="nav navbar-nav">

                    @unless (Auth::guest())
                    <!-- Left Side Of Navbar -->&nbsp;
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/companies') }}">Companies</a></li>
                    @endunless
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                        </li>
                        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span>
                                Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profile') }}"><span class="glyphicon glyphicon-user"></span>
                                        Profile</a>
                                </li>

                                <li><a href="{{ url('/change_password') }}"><span
                                                class="glyphicon glyphicon-lock"></span>
                                        Change Password</a>
                                </li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span class="glyphicon glyphicon-log-out"></span> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>


<footer class="center-small text-center fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p class="copyright">&copy; Copyright 2018</p>
            </div>
            <div class="col-md-3">
                <a href="{{url('/support')}}">Support</a>
            </div>
            <div class="col-md-3">
                <a href="{{url('/terms-and-conditions')}}">Terms and Conditions</a>
            </div>
            <div class="col-md-3">
                <a href="{{url('/privacy-policy')}}">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
@if($_SERVER['HTTP_HOST'] == 'localhost')
    <script src="{{ asset('js/app.js') }}"></script>
@else
    <script src="{{ asset('public/js/app.js') }}"></script>
@endif
@yield('script')
</body>
</html>
