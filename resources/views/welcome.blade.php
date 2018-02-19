<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
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
                    <img src="{{asset('img/logo.png')}}" class="img_logo">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ url('/') }}">Home</a></li>
                    @unless (Auth::guest())
                        <li><a href="{{ url('/companies') }}">Companies</a></li>
                        <li><a href="{{ url('/containers') }}">Containers</a></li>
                    @endunless
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-user"></span> Login</a>
                        </li>
                        <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-log-in"></span>
                                Register</a>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
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

    <div class="wrapper">
        <div class="content">
            <div class="title m-b-md">
                DUMPSTER
            </div>
            <div class="row-fluid text-center">
                <p>Looking for ways to easily dispose your garbage?</p>
                <p>Locate the nearest truck drivers around you.</p>
                <p>Get your containers delivered and picked up in your selected location?</p>
            </div>
            <div class="row-fluid m-t-md">
                <a class="btn btn-primary" href="{{url('/create_company')}}">Create Company</a>
            </div>
        </div>
    </div>

</div>

<footer class="container-fluid center-small text-center fixed-bottom">
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
</footer>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
