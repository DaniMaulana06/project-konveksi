<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @livewireStyles
    @livewireScripts
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">

            <h5>Konveksi Pelajar</h5>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    {{-- Jika user belum login --}}
                    @guest
                        @if (request()->routeIs('login'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link active">Register</a>
                            </li>
                        @elseif (request()->routeIs('register'))
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link active">Login</a>
                            </li>
                        @endif
                    @endguest

                    {{-- Jika user sudah login --}}
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Admin
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="/order">Order</a></li>
                          <li><a class="dropdown-item" href="/product">Produk</a></li>
                          <li><a class="dropdown-item" href="/vendor">Vendor</a></li>
                        </ul>
                      </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Produksi
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="/bahan">Bahan</a></li>
                          <li><a class="dropdown-item" href="/produksi">Produksi</a></li>
                          <li><a class="dropdown-item" href="/vendor">Vendor</a></li>
                        </ul>
                      </li>
                        <li class="nav-item me-2 mt-2">
                            <span class="text-white me-2">Halo, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    {{$slot}}
</body>

</html>