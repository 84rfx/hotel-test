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
        <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Galeri</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="global-search-btn">
            <i class="bi bi-search"></i> Cari
          </a>
        </li>
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

  // Global Search Modal
  document.addEventListener('DOMContentLoaded', function() {
    const searchBtn = document.getElementById('global-search-btn');
    if(searchBtn){
      searchBtn.addEventListener('click', function(e){
        e.preventDefault();
        showGlobalSearchModal();
      });
    }
  });

  function showGlobalSearchModal(){
    // Create modal if it doesn't exist
    let modal = document.getElementById('global-search-modal');
    if(!modal){
      modal = document.createElement('div');
      modal.className = 'modal fade';
      modal.id = 'global-search-modal';
      modal.innerHTML = `
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="bi bi-search me-2"></i>Global Search</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="text" class="form-control mb-3" id="global-search-input" placeholder="Cari kamar, fasilitas, atau informasi hotel...">
              <div id="search-results" class="search-results">
                <div class="text-muted">Ketik untuk mencari...</div>
              </div>
            </div>
          </div>
        </div>
      `;
      document.body.appendChild(modal);
    }

    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();

    // Focus on search input
    setTimeout(() => {
      document.getElementById('global-search-input').focus();
    }, 500);

    // Search functionality
    const searchInput = document.getElementById('global-search-input');
    const resultsDiv = document.getElementById('search-results');

    searchInput.addEventListener('input', function(){
      const query = this.value.toLowerCase().trim();
      if(query.length < 2){
        resultsDiv.innerHTML = '<div class="text-muted">Ketik minimal 2 karakter...</div>';
        return;
      }

      // Mock search results (in real app, this would be API call)
      const mockResults = [
        {type: 'Kamar', title: 'Superior Room', desc: 'Kamar nyaman untuk 2 orang', link: '/room-detail?id=1'},
        {type: 'Kamar', title: 'Deluxe Room', desc: 'Kamar premium dengan pemandangan kota', link: '/room-detail?id=2'},
        {type: 'Fasilitas', title: 'Kolam Renang', desc: 'Kolam renang outdoor dengan pemandangan', link: '/gallery#facilities'},
        {type: 'Fasilitas', title: 'Fitness Center', desc: 'Gym lengkap dengan equipment modern', link: '/gallery#facilities'},
        {type: 'Restoran', title: 'Restoran Utama', desc: 'Sajian internasional dan lokal', link: '/gallery#restaurant'},
        {type: 'Event', title: 'Ruang Konferensi', desc: 'Ruang meeting untuk 50-100 orang', link: '/gallery#events'}
      ];

      const filtered = mockResults.filter(item =>
        item.title.toLowerCase().includes(query) ||
        item.desc.toLowerCase().includes(query) ||
        item.type.toLowerCase().includes(query)
      );

      if(filtered.length === 0){
        resultsDiv.innerHTML = '<div class="text-muted">Tidak ada hasil ditemukan.</div>';
        return;
      }

      resultsDiv.innerHTML = filtered.map(item => `
        <div class="search-result-item p-3 border-bottom">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <small class="text-primary">${item.type}</small>
              <h6 class="mb-1">${item.title}</h6>
              <p class="mb-0 text-muted small">${item.desc}</p>
            </div>
            <a href="${item.link}" class="btn btn-sm btn-outline-primary">Lihat</a>
          </div>
        </div>
      `).join('');
    });
  }
</script>
</body>
</html>
