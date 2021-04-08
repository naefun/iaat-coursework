<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aston Animal Sanctuary') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="nav-main">
            <div class="nav-container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Aston Animal Sanctuary') }}
                </a>

                <div class="nav-sections" id="">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav-list">
                        @guest
                        @else
                            <!-- navigation that will show for all user types -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('animals') }}">Animals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('adoption_requests') }}">Adoption requests </a>
                            </li>
                            <!-- navigation for just the regular users -->
                            @if(Auth::user()->role == false)

                            <!-- navigation for just the admins -->
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('animals/create') }}">Add animal</a>
                                </li>
                            @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav-list">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item"><p class="nav-text">Welcome {{ Auth::user()->name }}</p></li>
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main">
            @yield('content')
        </main>
    </div>
</body>
</html>
