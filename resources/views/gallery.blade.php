@extends('layouts.app')

@section('title', 'Galeri - StayEasy Hotel')

@section('content')
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/img/room2.jpg') }}') center/cover no-repeat fixed; min-height: 50vh;">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <h1 class="display-5 mb-3 text-white">Galeri StayEasy Hotel</h1>
        <p class="lead text-white">Jelajahi keindahan dan fasilitas hotel kami melalui galeri foto yang menakjubkan.</p>
      </div>
    </div>
  </div>
</section>

<section class="gallery-section">
  <div class="container">
    <!-- Gallery Navigation -->
    <div class="row justify-content-center mb-5" data-aos="fade-up">
      <div class="col-lg-8">
        <ul class="nav nav-pills justify-content-center gallery-nav" id="gallery-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="rooms-tab" data-bs-toggle="pill" data-bs-target="#rooms" type="button" role="tab">Kamar</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="facilities-tab" data-bs-toggle="pill" data-bs-target="#facilities" type="button" role="tab">Fasilitas</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="restaurant-tab" data-bs-toggle="pill" data-bs-target="#restaurant" type="button" role="tab">Restoran</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="events-tab" data-bs-toggle="pill" data-bs-target="#events" type="button" role="tab">Event</button>
          </li>
        </ul>
      </div>
    </div>

    <!-- Gallery Content -->
    <div class="tab-content" id="gallery-tab-content">
      <!-- Rooms Gallery -->
      <div class="tab-pane fade show active" id="rooms" role="tabpanel">
        <div class="row g-4">
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="gallery-item">
              <img src="{{ asset('assets/img/room1.jpg') }}" alt="Superior Room" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="{{ asset('assets/img/room1.jpg') }}" data-title="Superior Room" data-description="Kamar superior dengan pemandangan kota yang indah">
              <div class="gallery-overlay">
                <h5>Superior Room</h5>
                <p>Kamar nyaman untuk 2 orang</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="gallery-item">
              <img src="{{ asset('assets/img/room2.jpg') }}" alt="Deluxe Room" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="{{ asset('assets/img/room2.jpg') }}" data-title="Deluxe Room" data-description="Kamar deluxe dengan fasilitas premium">
              <div class="gallery-overlay">
                <h5>Deluxe Room</h5>
                <p>Lebih luas dengan pemandangan kota</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="gallery-item">
              <img src="{{ asset('assets/img/room3.jpg') }}" alt="Suite Room" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="{{ asset('assets/img/room3.jpg') }}" data-title="Suite Room" data-description="Suite mewah dengan jacuzzi pribadi">
              <div class="gallery-overlay">
                <h5>Suite Room</h5>
                <p>Pilihan mewah dengan fasilitas eksklusif</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Facilities Gallery -->
      <div class="tab-pane fade" id="facilities" role="tabpanel">
        <div class="row g-4">
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800&h=600&fit=crop" alt="Swimming Pool" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=1200&h=800&fit=crop" data-title="Kolam Renang" data-description="Kolam renang outdoor dengan pemandangan kota yang indah, dilengkapi dengan area berjemur dan bar kolam renang">
              <div class="gallery-overlay">
                <h5>Kolam Renang</h5>
                <p>Outdoor pool dengan city view</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&h=600&fit=crop" alt="Fitness Center" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1200&h=800&fit=crop" data-title="Fitness Center" data-description="Gym modern dengan equipment lengkap dari Life Fitness, tersedia 24 jam untuk tamu hotel">
              <div class="gallery-overlay">
                <h5>Fitness Center</h5>
                <p>Gym dengan equipment lengkap</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800&h=600&fit=crop" alt="Spa" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=1200&h=800&fit=crop" data-title="Spa & Wellness" data-description="Spa dengan treatment tradisional dan modern, menggunakan bahan-bahan alami berkualitas tinggi">
              <div class="gallery-overlay">
                <h5>Spa & Wellness</h5>
                <p>Treatment relaksasi premium</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Restaurant Gallery -->
      <div class="tab-pane fade" id="restaurant" role="tabpanel">
        <div class="row g-4">
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&h=600&fit=crop" alt="Main Restaurant" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&h=800&fit=crop" data-title="Restoran Utama" data-description="Restoran utama dengan suasana elegan, menyajikan menu internasional dan lokal dengan bahan-bahan segar pilihan">
              <div class="gallery-overlay">
                <h5>Restoran Utama</h5>
                <p>Menu internasional dan lokal</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800&h=600&fit=crop" alt="Coffee Shop" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=1200&h=800&fit=crop" data-title="Coffee Shop" data-description="Coffee shop cozy dengan berbagai specialty coffee, pastry, dan camilan ringan untuk menemani hari Anda">
              <div class="gallery-overlay">
                <h5>Coffee Shop</h5>
                <p>Specialty coffee dan pastry</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1572116469696-31de0f17cc34?w=800&h=600&fit=crop" alt="Bar & Lounge" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1572116469696-31de0f17cc34?w=1200&h=800&fit=crop" data-title="Bar & Lounge" data-description="Bar & lounge dengan koleksi cocktail premium, live music setiap malam, dan suasana yang sempurna untuk bersantai">
              <div class="gallery-overlay">
                <h5>Bar & Lounge</h5>
                <p>Cocktail dan live entertainment</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Events Gallery -->
      <div class="tab-pane fade" id="events" role="tabpanel">
        <div class="row g-4">
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=800&h=600&fit=crop" alt="Wedding Ceremony" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&h=800&fit=crop" data-title="Pernikahan" data-description="Venue pernikahan dengan ballroom elegan, catering premium, dan layanan wedding planner profesional untuk acara spesial Anda">
              <div class="gallery-overlay">
                <h5>Pernikahan</h5>
                <p>Venue elegan untuk acara spesial</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop" alt="Conference Room" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=1200&h=800&fit=crop" data-title="Ruang Konferensi" data-description="Ruang konferensi modern dengan kapasitas hingga 200 orang, dilengkapi proyektor, sound system, dan WiFi berkecepatan tinggi">
              <div class="gallery-overlay">
                <h5>Ruang Konferensi</h5>
                <p>Fasilitas meeting profesional</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="gallery-item">
              <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800&h=600&fit=crop" alt="Birthday Party" class="img-fluid gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=1200&h=800&fit=crop" data-title="Ulang Tahun" data-description="Paket ulang tahun dengan dekorasi tematis, kue ulang tahun premium, dan berbagai pilihan menu untuk merayakan momen spesial">
              <div class="gallery-overlay">
                <h5>Ulang Tahun</h5>
                <p>Celebrasi spesial untuk Anda</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="galleryModalTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <img id="galleryModalImg" src="" alt="" class="img-fluid rounded">
        <p id="galleryModalDesc" class="mt-3"></p>
      </div>
    </div>
  </div>
</div>
@endsection
