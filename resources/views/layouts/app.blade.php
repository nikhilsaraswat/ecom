<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ecombynik') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../../js/adminpanel/forchartusinggoogle.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="max-width: 100vw;overflow-x:hidden;">
    <div id="app d-flex position-relative " style="width:100vw;">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-dark " style="height:3vh; width:100vw; padding:1vh;">
            <div class="container-fluid " style="margin-left: 5vw; margin-right: 5vw;">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'ecombynik') }}
                </a>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto text-white">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item text-white">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown ">
                        <a
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle text-white"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            v-pre
                        >
                        <img
                            src="{{ asset('storage/images/' . Auth::user()->image) }}"
                            alt="Example Image"
                            class="rounded-circle img-thumbnail"
                            style="width: 2vw; height: 2vh;"
                        >
                            {{ Auth::user()->name }}
                        </a>


                                <div class="dropdown-menu dropdown-menu-end" style="width:10vw;" aria-labelledby="navbarDropdown">
                                    <div class="dorpdown-item row" style="padding-left: 2vw;">
                                      <img
                                        src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                        alt="Example Image"
                                        class="rounded-circle img-thumbnail col-md-1"
                                        style="width: 5vw; height: 5vh;"
                                    >
                                    <div class="col-md-1">
                                    {{ Auth::user()->name }} </br><a href="#" 
                                    onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                                    onmouseout="$(this).addClass('bg-light');"
                                    >Edit</a>
                                        <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <div>
                                    

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
    @stack('script')
</body>
</html>
