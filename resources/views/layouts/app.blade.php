<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                 data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                  aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto ">
                        @auth
                            @if(Auth::user()->role_id == 1)
                                <a class="nav-link active" aria-current="page" href="{{ url('users') }}">
                                    <i class="bi bi-person-fill"></i>
                                    Administrador de Usuarios
                                </a>
                            @endif
                        
                            @if(Auth::user()->role_id == 2)
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                     id="dropdownMenuButton2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-cash-coin"></i>
                                    Clientes
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item active" href="{{ url('clientes') }}">Solicitar
                                         crédito</a></li>
                                    <li><a class="dropdown-item" href="{{ url('creditos') }}">Ver solicitudes</a></li>
                                    <li><a class="dropdown-item" href="{{ url('creditos-aprobados') }}">
                                        Ver créditos aprobados</a></li>
                                     <li><a class="dropdown-item" href="{{ url('write') }}">
                                        Simular crédito OpenAI</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            @endif
                        
                            @if(Auth::user()->role_id == 3)
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                     id="dropdownMenuButton2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Asesor
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item active" href="{{ url('solicitudes') }}
                                        ">Solicitudes</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            @endif
                        
                            @if(Auth::user()->role_id == 4)
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle mg-4" type="button"
                                 id="dropdownMenuButton2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Gerencia general
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item active" href="{{ url('asesores') }}">Crear asesores</a></li>
                                <li><a class="dropdown-item" href="{{ url('pendientes') }}">Solicitudes
                                     pendientes</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                                </ul>
                            </div>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('layouts.flash-message')
            @yield('content')
        </main>
    </div>
    @yield('js_after')
</body>
</html>
