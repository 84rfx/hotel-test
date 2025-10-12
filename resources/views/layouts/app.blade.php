<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'StayEasy Hotel')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    body {
      transition: opacity 0.3s ease-in-out;
    }
    body.fade-out {
      opacity: 0;
    }
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.6s ease-out;
    }
    .animate-on-scroll.animate-in {
      opacity: 1;
      transform: translateY(0);
    }
    .card-room {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-room:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .carousel-item img {
      transition: transform 0.5s ease;
    }
    .carousel-item.active img {
      transform: scale(1.05);
    }
  </style>
</head>
<body>
<!-- Navbar StayEasy Hotel -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">StayEasy Hotel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Tentang Kami</a></li>
      </ul>
      <ul class="navbar-nav" id="auth-links">
        <!-- dynamic links -->
      </ul>
    </div>
  </div>
</nav>

@yield('content')

<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <small>&copy; 2025 StayEasy Hotel. Demo tanpa backend.</small>
      </div>
      <div class="col-md-6 text-end">
        <small>Telepon: +62 123 456 789 | Email: info@stayeasy.com</small>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
  // Initialize AOS
  AOS.init({
    duration: 800,
    once: true,
    offset: 100
  });

  // Page transition animations
  document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const links = document.querySelectorAll('a[href^="/"]');

    links.forEach(link => {
      link.addEventListener('click', function(e) {
        if (this.href.includes('#') || this.target === '_blank') return;
        e.preventDefault();
        body.classList.add('fade-out');
        setTimeout(() => {
          window.location.href = this.href;
        }, 300);
      });
    });

    // Remove fade-out class when page loads
    setTimeout(() => {
      body.classList.remove('fade-out');
    }, 100);
  });
</script>
</body>
</html>
