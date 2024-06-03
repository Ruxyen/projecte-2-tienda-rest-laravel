<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>

.fixed-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #ffffff; /* Fondo blanco o el color que desees */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Agregar una sombra */
        z-index: 1000;
    }
    *{
  font-family: 'Lexend Deca';
}

</style>
<body>
<div id="app">
    <nav class="fixed-navbar">
        <div class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <div class="logo" style="position: fixed; top: 10px; left: 80px;">
                    <!-- Logo de la tienda -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="logo_nav.png" alt="Logo de la Tienda" style="height: 50px; margin-top:10px;">
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: -10px;">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div>
                        <form class="d-flex">
                          
                            <button class="btn btn-outline-dark" type="submit" style="margin-top:20%">
                                <i class="bi-cart-fill me-1"></i>
                                Cart
                                <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                            </button>
                        </form>
                        @if (Route::has('login'))
                        <div>
                            @auth
                            <a href="{{ url('/home') }}">Home</a>
                            @else
                            
                            @if (Route::has('register'))
                            <br>
                            @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>

</html>