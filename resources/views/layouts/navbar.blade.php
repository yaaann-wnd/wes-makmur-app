<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wes Makmur | {{ Auth::user()->role == 'admin'? 'ADMIN':'EDITOR' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm mb-4">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="#">
                    Wes Makmur
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{ route('post.index') }}" class="nav-link {{ request()->is('post*')? 'active fw-semibold':'' }}">Post</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produk.index') }}" class="nav-link {{ request()->is('produk*')? 'active fw-semibold':'' }}">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->is('kategori*')? 'active fw-semibold':'' }}">Kategori</a>
                        </li>
                        @if(Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*')? 'active fw-semibold':'' }}">User</a>
                        </li>                            
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav me-3">
                            <span class="text-uppercase fw-semibold text-white">{{ Auth::user()->name }}</span>                        
                        <!-- Authentication Links -->
                        
                    </ul>
                    <div class="float-end">
                        <a class="btn btn-danger d-inline" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="container">
            @yield('content')
        </main>
    </div>

    <footer class="text-center text-secondary p-4">
        <div class="mb-1">
            &#169; Copyright Wes Makmur 2022. All rights reserved.
        </div>
        <div>
            Made with love by <span class="fw-semibold">Aftiyan</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
