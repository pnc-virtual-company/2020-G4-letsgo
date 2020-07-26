<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lets Go') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- icon link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div id="app">
    @if(auth::check())
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h5>Let's Go</h5>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        <a href="{{route('showExploreEventView')}}" class="nav-link">Explore Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('yourEventsView')}}" class="nav-link">Your Events</a>
                        </li>
                        @if(auth::user()->role == 1)
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Manage <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('events.index')}}">
                                        Events
                                    </a>
                                    <a class="dropdown-item" href="{{route('categories.index')}}">Categories</a>
                                </div>
                        </li>
                        @endif
                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstName }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#userProfile">Profile</a>
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#changePwd">Change Password</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@if(Auth::user())
<div class="modal fade" id="userProfile" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{route('users.update', Auth::id())}}" class="md-form" method="post" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <div class="container">
                    <h5>Edit Profile</h5>
                    <div class="row">
                        <div class="col-8">
                            <input type="text" name="firstName" id="firstName" placeholder="First Name" value="{{Auth::user()->firstName}}" class="form-control">
                            <input type="text" name="lastName" id="lastName" placeholder="Last Name" value="{{Auth::user()->lastName}}" class="form-control mt-4">
                            <input type="email" name="email" id="email" placeholder="Email" value="{{Auth::user()->email}}" class="form-control mt-4 mb-2">
                        </div>
                        <div class="col-4">
                            <div class="img">
                                <img src="{{asset('image/'.Auth::user()->profile)}}" alt="Not found" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                        <button class="btn btn-warning float-right" type="submit">Update</button>
                        <a href="#" class="btn btn-danger float-right mr-4" data-dismiss="modal">Discard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal change password-->
<div class="modal fade" id="changePwd" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{route('changePassword')}}" class="md-form" method="post">
                    @csrf
                    @method('put')
                    <div class="container">
                    <h5>Change Password</h5>
                        <input type="password" name="newPassword" id="newPassword" placeholder="New Password" class="form-control mt-3">
                        <input type="password" name="comfirmPassword" id="confirmPassword" placeholder="Comfirm New Password" class="form-control mt-3">
                        <button type="submit" class="btn btn-primary float-right mt-3">Change Password</button>
                        <button data-dismiss="modal" class="btn btn-danger mt-3">Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
</html>
