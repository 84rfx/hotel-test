@extends('layouts.app')

@section('title', 'Kontak Kami - StayEasy Hotel')

@section('content')
<section class="contact-hero">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8" data-aos="fade-up">
        <h1 class="display-4 mb-4">Hubungi Kami</h1>
        <p class="lead">Kami siap membantu Anda dengan pertanyaan atau reservasi. Jangan ragu untuk menghubungi kami kapan saja.</p>
      </div>
    </div>
  </div>
</section>

<section class="contact-section">
  <div class="container">
    <div class="row g-5">
      <!-- Contact Form -->
      <div class="col-lg-8" data-aos="fade-up">
        <div class="contact-form">
          <h2 class="mb-4">Kirim Pesan</h2>
          <form id="contact-form">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label"><i class="bi bi-person text-muted me-1"></i>Nama Lengkap</label>
                <input type="text" class="form-control" name="name" required>
                <div class="invalid-feedback">Nama wajib diisi.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label"><i class="bi bi-envelope text-muted me-1"></i>Email</label>
                <input type="email" class="form-control" name="email" required>
                <div class="invalid-feedback">Email valid dibutuhkan.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label"><i class="bi bi-telephone text-muted me-1"></i>Telepon</label>
                <input type="tel" class="form-control" name="phone">
              </div>
              <div class="col-md-6">
                <label class="form-label"><i class="bi bi-tag text-muted me-1"></i>Subjek</label>
                <select class="form-select" name="subject">
                  <option value="">Pilih subjek</option>
                  <option value="reservation">Reservasi</option>
                  <option value="complaint">Keluhan</option>
                  <option value="inquiry">Pertanyaan</option>
                  <option value="feedback">Umpan Balik</option>
                  <option value="other">Lainnya</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label"><i class="bi bi-chat-text text-muted me-1"></i>Pesan</label>
                <textarea class="form-control" name="message" rows="5" required placeholder="Tuliskan pesan Anda di sini..."></textarea>
                <div class="invalid-feedback">Pesan wajib diisi.</div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-lg px-5">
                  <i class="bi bi-send me-2"></i>Kirim Pesan
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="contact-info">
          <h4><i class="bi bi-info-circle me-2"></i>Informasi Kontak</h4>

          <div class="contact-item">
            <i class="bi bi-geo-alt"></i>
            <div>
              <h6>Alamat</h6>
              <p>Jl. Sudirman No. 123<br>Jakarta Pusat, DKI Jakarta 10220<br>Indonesia</p>
            </div>
          </div>

          <div class="contact-item">
            <i class="bi bi-telephone"></i>
            <div>
              <h6>Telepon</h6>
              <p>+62 123 456 789<br>+62 987 654 321</p>
            </div>
          </div>

          <div class="contact-item">
            <i class="bi bi-envelope"></i>
            <div>
              <h6>Email</h6>
              <p>info@stayeasy.com<br>reservation@stayeasy.com</p>
            </div>
          </div>

          <div class="contact-item">
            <i class="bi bi-clock"></i>
            <div>
              <h6>Jam Operasional</h6>
              <p>Resepsionis: 24 Jam<br>Restoran: 06:00 - 22:00<br>Fitness Center: 05:00 - 22:00</p>
            </div>
          </div>

          <div class="contact-item">
            <i class="bi bi-share"></i>
            <div>
              <h6>Ikuti Kami</h6>
              <div class="social-share mt-2">
                <a href="#" class="social-btn facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social-btn twitter" title="Twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social-btn instagram" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="social-btn whatsapp" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Map Section -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="300">
      <div class="col-12">
        <div class="card border-0 shadow">
          <div class="card-body p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.816666!3d-6.200000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x1234567890abcdef!2sStayEasy%20Hotel!5e0!3m2!1sen!2sid!4v1690000000000!5m2!1sen!2sid" width="100%" height="400" style="border:0; border-radius: 15px;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
        <div class="text-center mt-3">
          <p class="lead">Lokasi strategis di pusat kota Jakarta, mudah diakses dari bandara dan stasiun.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Weather Widget -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center" data-aos="fade-up">
      <div class="col-md-6 col-lg-4">
        <div class="weather-widget" id="weather-widget">
          <div class="weather-loading">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Memuat cuaca...</p>
          </div>
          <div class="weather-content" style="display: none;">
            <div class="weather-icon" id="weather-icon">☀️</div>
            <div class="weather-temp" id="weather-temp">28°C</div>
            <div class="weather-desc" id="weather-desc">Cerah</div>
            <small class="mt-2 d-block opacity-75" id="weather-location">Jakarta, Indonesia</small>
            <div class="weather-details mt-3">
              <div class="row text-center">
                <div class="col-4">
                  <small class="text-muted">Kelembaban</small>
                  <div class="fw-bold" id="weather-humidity">65%</div>
                </div>
                <div class="col-4">
                  <small class="text-muted">Angin</small>
                  <div class="fw-bold" id="weather-wind">15 km/h</div>
                </div>
                <div class="col-4">
                  <small class="text-muted">UV Index</small>
                  <div class="fw-bold" id="weather-uv">6</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
