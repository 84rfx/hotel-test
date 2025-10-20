@extends('layouts.app')

@section('title', 'Reservasi - StayEasy Hotel')

@section('content')
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/img/room3.jpg') }}') center/cover no-repeat fixed;">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <h1 class="display-4 mb-4 text-white">Book Your Stay at StayEasy Hotel</h1>
        <p class="lead text-white">Isi form di bawah untuk reservasi cepat dan aman. Upload KTP untuk verifikasi.</p>
        <a href="#reservation-form" class="btn btn-light btn-lg">Mulai Reservasi</a>
      </div>
    </div>
  </div>
</section>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="reservation-form" data-aos="fade-up">
        <h2 class="text-center mb-4">Form Reservasi</h2>
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
              <img id="room-img" src="{{ asset('assets/img/room1.jpg') }}" class="card-img-top" alt="room" style="height: 250px; object-fit: cover;">
              <div class="card-body">
                <h5 id="room-title" class="card-title">Superior</h5>
                <p id="room-benefits" class="card-text">Kamar nyaman untuk 2 orang dewasa dengan AC, TV, dan WiFi gratis.</p>
                <p class="card-text small">Pilih tanggal check-in dan check-out, lalu unggah foto KTP untuk validasi identitas.</p>
              </div>
            </div>
            <div class="mt-4 text-center">
              <h6>Pratinjau KTP</h6>
              <img id="ktp-preview" src="" alt="ktp preview" class="img-fluid form-ktp rounded shadow-sm" style="max-height: 150px;">
            </div>
          </div>
          <div class="col-lg-6">
            <form id="reserve-form" class="needs-validation" novalidate>
              <!-- Guest Info Section -->
              <div class="mb-4 p-3 bg-light rounded">
                <h5 class="mb-3"><i class="bi bi-person-circle text-primary me-2"></i>Informasi Tamu</h5>
                <div class="mb-3">
                  <label class="form-label"><i class="bi bi-person text-muted me-1"></i>Nama Tamu</label>
                  <input name="guest-name" class="form-control" required>
                  <div class="invalid-feedback">Nama wajib diisi.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label"><i class="bi bi-envelope text-muted me-1"></i>Email</label>
                  <input name="guest-email" type="email" class="form-control" required>
                  <div class="invalid-feedback">Email valid dibutuhkan.</div>
                </div>
              </div>

              <!-- Room & Dates Section -->
              <div class="mb-4 p-3 bg-light rounded">
                <h5 class="mb-3"><i class="bi bi-bed text-primary me-2"></i>Pilih Kamar & Tanggal</h5>
                <div class="mb-3">
                  <label class="form-label"><i class="bi bi-building text-muted me-1"></i>Tipe Kamar</label>
                  <select id="room-type" name="room-type" class="form-select" required>
                    <option value="">-- Pilih Tipe Kamar --</option>
                    <option>Superior</option>
                    <option>Deluxe</option>
                    <option>Suite</option>
                  </select>
                  <div class="invalid-feedback">Pilih tipe kamar.</div>
                </div>
                <div class="row g-2">
                  <div class="col">
                    <label class="form-label"><i class="bi bi-calendar-check text-muted me-1"></i>Check-in</label>
                    <input name="checkin" type="date" class="form-control" required>
                    <div class="invalid-feedback">Pilih tanggal check-in.</div>
                  </div>
                  <div class="col">
                    <label class="form-label"><i class="bi bi-calendar-x text-muted me-1"></i>Check-out</label>
                    <input name="checkout" type="date" class="form-control" required>
                    <div class="invalid-feedback">Pilih tanggal check-out.</div>
                  </div>
                </div>
                <div class="row g-2 mt-3">
                  <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-people text-muted me-1"></i>Jumlah Dewasa</label>
                    <input id="adults" name="adults" type="number" class="form-control" min="1" value="1" required>
                    <div class="invalid-feedback">Minimal 1 dewasa.</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-child text-muted me-1"></i>Jumlah Anak</label>
                    <input id="kids" name="kids" type="number" class="form-control" min="0" value="0" required>
                    <div class="invalid-feedback">Jumlah anak minimal 0.</div>
                  </div>
                </div>
                <div class="mt-3">
                  <label class="form-label"><i class="bi bi-house text-muted me-1"></i>Jumlah Kamar</label>
                  <select class="form-select" name="room-count" id="room-count">
                    <option value="1">1 Kamar</option>
                    <option value="2">2 Kamar</option>
                    <option value="3">3 Kamar</option>
                    <option value="4">4 Kamar</option>
                    <option value="5">5 Kamar</option>
                  </select>
                  <small class="text-muted">*Multi-room booking tersedia untuk reservasi grup</small>
                </div>
              </div>

              <!-- Upload & Promo Section -->
              <div class="mb-4 p-3 bg-light rounded">
                <h5 class="mb-3"><i class="bi bi-upload text-primary me-2"></i>Verifikasi & Promo</h5>
                <div class="mb-3">
                  <label class="form-label"><i class="bi bi-card-text text-muted me-1"></i>Unggah Foto KTP / ID</label>
                  <input id="ktp-file" name="ktp-file" type="file" accept="image/*" class="form-control" required>
                  <div class="invalid-feedback">KTP diperlukan untuk reservasi.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label"><i class="bi bi-tag text-muted me-1"></i>Kode Referral (Opsional)</label>
                  <input id="referral-code" name="referral-code" class="form-control" placeholder="Masukkan kode referral untuk diskon">
                </div>
              </div>

              <!-- Summary -->
              <div class="mb-4 p-3 bg-light rounded">
                <h5 class="mb-3"><i class="bi bi-currency-dollar text-primary me-2"></i>Ringkasan</h5>
                <div class="mb-3">
                  <h6>Harga Promo: <span id="promo-price">Rp 0</span></h6>
                  <small id="promo-note" class="text-muted"></small>
                </div>
                <div class="mb-3">
                  <h6>Kamar Tersedia: <span id="rooms-left">0</span></h6>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg px-5">Kirim Reservasi <i class="bi bi-send ms-2"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
