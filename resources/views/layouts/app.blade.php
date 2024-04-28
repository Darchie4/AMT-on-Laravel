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
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('head')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img
                    id="MDB-logo"
                    src="https://mdbcdn.b-cdn.net/wp-content/uploads/2018/06/logo-mdb-jquery-small.png"
                    alt="MDB Logo"
                    draggable="false"
                    height="30"
                />
{{--{{ config('app.name', 'Laravel') }}--}}
</a>
<button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<!-- Left Side Of Navbar -->
<ul class="navbar-nav me-auto align-items-start">
    <li class="nav-item">
        <a class="nav-link mx-1 fs-5 text-bg-primary" href="{{url('/')}}">{{__('navigation.frontpage')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link mx-1 fs-5 text-bg-primary " href="{{route('lesson.index')}}">{{__('navigation.lessons')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link mx-1 fs-5 text-bg-primary " href="#">{{__('navigation.events')}}</a>
    </li>
    <!--About us dropdown-->
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle mx-1 fs-5 text-bg-primary" href="#" role="button"
           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.about') }}
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item " href="{{ route('instructors.public.index') }}">
                {{ __('navigation.instructors') }}
            </a>
            <a class="dropdown-item" href="{{ route('locations.public.index') }}">
                {{ __('navigation.locations') }}
            </a>
        </div>
    </li>



</ul>

<!-- Right Side Of Navbar -->
<ul class="navbar-nav ms-auto ">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link text-bg-primary fs-5" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item ms-3">
                <a class="btn btn-secondary btn-rounded fs-5" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-bg-primary fs-5" href="#" role="button"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @can('admin_dashboard')
                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                        {{ __('navigation.admin_settings') }}
                    </a>
                @endcan
                    <a class="dropdown-item" href="{{ route('home') }}">
                        {{ __('navigation.home') }}
                    </a>
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
@yield('nav-content')
<main class="py-4">
@yield('content')
</main>
</div>
@stack('scripts')
</body>
</html>
