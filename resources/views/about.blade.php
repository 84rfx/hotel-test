@extends('layouts.app')

@section('title', 'Tentang Kami - StayEasy Hotel')

@section('content')
<section class="about-hero">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <h1 class="display-4 mb-4">Tentang StayEasy Hotel</h1>
        <p class="lead">Kami berkomitmen untuk memberikan pengalaman menginap yang nyaman dan tak terlupakan di lokasi strategis Jakarta.</p>
      </div>
    </div>
  </div>
</section>

<main class="container my-5">
  <!-- History Section -->
  <section class="mb-5" data-aos="fade-up">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h2 class="mb-4">Sejarah Kami</h2>
        <p>Didirikan pada tahun 2015, StayEasy Hotel mulai sebagai penginapan kecil di pusat kota Jakarta. Dengan dedikasi untuk kenyamanan tamu, kami berkembang menjadi hotel modern dengan 100+ kamar, fasilitas lengkap, dan layanan 24/7. Visi kami adalah menjadi pilihan utama untuk traveler bisnis dan liburan.</p>
      </div>
      <div class="col-md-6">
        <img src="{{ asset('assets/img/room1.jpg') }}" alt="Hotel History" class="img-fluid rounded shadow">
      </div>
    </div>
  </section>

  <!-- Visi & Misi -->
  <section class="mb-5" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
      <div class="col-md-6">
        <h2 class="mb-3">Visi Kami</h2>
        <p class="lead">Menjadi hotel terdepan dalam menyediakan layanan akomodasi yang berkualitas tinggi dengan harga terjangkau, sambil menjaga keberlanjutan lingkungan.</p>
      </div>
      <div class="col-md-6">
        <h2 class="mb-3">Misi Kami</h2>
        <ul class="list-unstyled">
          <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Menyediakan kamar yang bersih dan nyaman dengan fasilitas modern.</li>
          <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Melatih staf kami untuk memberikan pelayanan terbaik dan personal.</li>
          <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Menggunakan teknologi untuk memudahkan proses reservasi dan check-in.</li>
          <li><i class="bi bi-check-circle text-success me-2"></i>Menjaga kepuasan tamu sebagai prioritas utama melalui feedback berkelanjutan.</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Facilities -->
  <section class="mb-5" data-aos="fade-up" data-aos-delay="200">
    <h2 class="text-center mb-5">Fasilitas Kami</h2>
    <div class="row g-4">
      <div class="col-md-4 text-center">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <i class="bi bi-wifi display-1 text-primary mb-3"></i>
            <h5 class="card-title">WiFi Gratis</h5>
            <p class="card-text">Internet berkecepatan tinggi di seluruh area hotel, termasuk kamar dan lobi.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 text-center">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <i class="bi bi-cup-hot display-1 text-success mb-3"></i>
            <h5 class="card-title">Restoran & Cafe</h5>
            <p class="card-text">Makanan lezat dengan berbagai pilihan menu lokal dan internasional, sarapan gratis.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 text-center">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-body">
            <i class="bi bi-car-front display-1 text-info mb-3"></i>
            <h5 class="card-title">Parkir Gratis</h5>
            <p class="card-text">Area parkir yang aman dan luas untuk tamu dengan kendaraan pribadi.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="mb-5" data-aos="fade-up" data-aos-delay="300">
    <h2 class="text-center mb-5">Apa Kata Tamu Kami</h2>
    <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <blockquote class="blockquote">
                  <p>"Pengalaman menginap yang luar biasa! Kamar bersih, staf ramah, dan lokasi strategis."</p>
                  <footer class="blockquote-footer">Sarah K., Tamu Bisnis</footer>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <blockquote class="blockquote">
                  <p>"Fasilitas lengkap dan nyaman untuk keluarga. WiFi cepat dan makanan enak!"</p>
                  <footer class="blockquote-footer">Budi S., Tamu Liburan</footer>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <blockquote class="blockquote">
                  <p>"Layanan check-in cepat, kamar suite mewah. Sangat direkomendasikan!"</p>
                  <footer class="blockquote-footer">Lina P., Tamu VIP</footer>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </section>

  <!-- Location -->
  <section data-aos="fade-up" data-aos-delay="400">
    <h2 class="text-center mb-4">Lokasi Kami</h2>
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card border-0 shadow">
          <div class="card-body p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.816666!3d-6.200000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x1234567890abcdef!2sStayEasy%20Hotel!5e0!3m2!1sen!2sid!4v1690000000000!5m2!1sen!2sid" width="100%" height="400" style="border:0; border-radius: 0 0 15px 15px;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-3">
      <p class="lead">Jl. Sudirman No. 123, Jakarta Pusat | Dekat MRT dan pusat perbelanjaan.</p>
    </div>
  </section>
</main>
@endsection
