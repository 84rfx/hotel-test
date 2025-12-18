<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Grand Bandung Hotel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="antialiased">
    <header>
        <nav>
            <div class="logo">
                <a href="{{ route('home') }}">
                    <i class="fas fa-hotel"></i>
                    Grand Bandung Hotel
                </a>
            </div>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('rooms') }}" class="{{ request()->routeIs('rooms') ? 'active' : '' }}">Kamar</a></li>
                <li><a href="{{ route('amenities') }}" class="{{ request()->routeIs('amenities') ? 'active' : '' }}">Fasilitas</a></li>
                <li><a href="{{ route('food') }}" class="{{ request()->routeIs('food') ? 'active' : '' }}">Pesan Makanan</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>
                @auth
                <li><a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">Profil</a></li>
                @endauth

                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            {{ explode(' ', Auth::user()->name)[0] }}
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('reservations') }}">Reservasi Saya</a></li>
                            <li><a href="{{ route('food-orders.index') }}">Pesanan Makanan Saya</a></li>
                            @if(Auth::user()->role === 'user')
                                <li><a href="{{ route('profile.edit') }}">Profil</a></li>
                            @endif
                            @if(in_array(Auth::user()->role, ['admin', 'owner']))
                                <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            @endif
                            <li class="divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="logout-btn">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-small">Daftar</a></li>
                @endauth
            </ul>

            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Grand Bandung Hotel</h3>
                <p>Hotel bintang 5 di jantung kota Bandung dengan layanan premium dan pemandangan spektakuler.</p>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
            <p><i class="fas fa-phone"></i> +62 22 1234 5678</p>
            <p><i class="fas fa-envelope"></i> info@grandbandunghotel.com</p>
            <p><i class="fas fa-map-marker-alt"></i> Jl. Asia Afrika No. 123, Bandung</p>
        </div>
        <div class="footer-section">
            <h3>Ikuti Kami</h3>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Grand Bandung Hotel. All rights reserved.</p>
    </div>
</footer>

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>
</html>
