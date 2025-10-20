@extends('layouts.app')

@section('title', 'FAQ - StayEasy Hotel')

@section('content')
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/img/room3.jpg') }}') center/cover no-repeat fixed; min-height: 50vh;">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <h1 class="display-5 mb-3 text-white">Pertanyaan yang Sering Diajukan</h1>
        <p class="lead text-white">Temukan jawaban untuk pertanyaan umum tentang layanan dan fasilitas StayEasy Hotel.</p>
      </div>
    </div>
  </div>
</section>

<section class="faq-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <!-- Search FAQ -->
        <div class="text-center mb-5" data-aos="fade-up">
          <div class="input-group input-group-lg" style="max-width: 500px; margin: 0 auto;">
            <input type="text" id="faq-search" class="form-control" placeholder="Cari pertanyaan...">
            <button class="btn btn-primary" type="button">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </div>

        <!-- FAQ Items -->
        <div id="faq-container">
          <!-- Reservation FAQs -->
          <div class="faq-category mb-4" data-aos="fade-up">
            <h3 class="text-primary mb-3"><i class="bi bi-calendar-check me-2"></i>Reservasi</h3>

            <div class="faq-item">
              <button class="faq-question">
                Bagaimana cara melakukan reservasi kamar?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Anda dapat melakukan reservasi melalui website kami dengan mengisi form reservasi, atau menghubungi tim reservasi kami di +62 123 456 789. Kami menerima reservasi 24 jam sehari.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Berapa lama waktu check-in dan check-out?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Check-in dimulai pukul 14:00 WIB dan check-out paling lambat pukul 12:00 WIB. Jika Anda membutuhkan early check-in atau late check-out, silakan hubungi resepsionis kami.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Apakah ada kebijakan pembatalan reservasi?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Pembatalan dapat dilakukan hingga 24 jam sebelum check-in tanpa biaya. Pembatalan kurang dari 24 jam akan dikenakan biaya 50% dari tarif kamar. No-show akan dikenakan biaya penuh.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Apakah anak-anak dapat menginap gratis?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Anak di bawah 6 tahun dapat menginap gratis dengan orang tua. Anak 6-12 tahun dikenakan biaya 50% dari tarif dewasa. Anak di atas 12 tahun dihitung sebagai dewasa.
              </div>
            </div>
          </div>

          <!-- Payment FAQs -->
          <div class="faq-category mb-4" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-success mb-3"><i class="bi bi-credit-card me-2"></i>Pembayaran</h3>

            <div class="faq-item">
              <button class="faq-question">
                Metode pembayaran apa yang diterima?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Kami menerima pembayaran tunai, kartu kredit (Visa, Mastercard, JCB), transfer bank, dan e-wallet (GoPay, OVO, Dana). Deposit 50% diperlukan untuk konfirmasi reservasi.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Kapan pembayaran harus dilakukan?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Deposit 50% dibayar saat konfirmasi reservasi. Pelunasan dapat dilakukan saat check-in atau melalui transfer sebelum kedatangan.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Apakah ada biaya tambahan?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Biaya tambahan meliputi: breakfast (termasuk dalam paket tertentu), parkir (gratis untuk tamu menginap), laundry, dan minibar. Semua biaya akan dijelaskan saat check-in.
              </div>
            </div>
          </div>

          <!-- Facilities FAQs -->
          <div class="faq-category mb-4" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-info mb-3"><i class="bi bi-house me-2"></i>Fasilitas</h3>

            <div class="faq-item">
              <button class="faq-question">
                Apakah tersedia WiFi gratis?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Ya, WiFi gratis dengan kecepatan tinggi tersedia di seluruh area hotel, termasuk kamar, lobi, restoran, dan kolam renang. Password WiFi akan diberikan saat check-in.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Apakah ada fasilitas untuk tamu difabel?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Ya, kami memiliki kamar khusus difabel dengan akses ramp, kamar mandi yang dapat diakses kursi roda, dan lift khusus. Silakan informasikan kebutuhan khusus saat reservasi.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Jam operasional restoran dan room service?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Restoran utama buka dari pukul 06:00 - 22:00 WIB. Room service tersedia 24 jam. Coffee shop buka dari pukul 07:00 - 23:00 WIB.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Apakah ada layanan laundry?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Ya, layanan laundry tersedia dengan harga terjangkau. Dry cleaning memerlukan waktu 24 jam, sedangkan cuci cepat selesai dalam 4-6 jam.
              </div>
            </div>
          </div>

          <!-- General FAQs -->
          <div class="faq-category mb-4" data-aos="fade-up" data-aos-delay="300">
            <h3 class="text-warning mb-3"><i class="bi bi-question-circle me-2"></i>Umum</h3>

            <div class="faq-item">
              <button class="faq-question">
                Apakah hewan peliharaan diperbolehkan?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Maaf, untuk kenyamanan semua tamu, hewan peliharaan tidak diperbolehkan masuk ke area hotel. Namun, kami dapat merekomendasikan pet hotel terdekat.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Kebijakan merokok di hotel?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Hotel kami non-smoking. Area khusus merokok tersedia di luar gedung. Denda Rp 500.000 akan dikenakan jika ditemukan merokok di area terlarang.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Apakah aman untuk wanita traveling solo?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Ya, keamanan tamu adalah prioritas utama kami. Semua area hotel dilengkapi CCTV, pintu kamar dengan double lock, dan resepsionis 24 jam. Kami memiliki kebijakan khusus untuk tamu wanita solo.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                Bagaimana jika ada keluhan selama menginap?
                <i class="bi bi-plus-circle faq-icon"></i>
              </button>
              <div class="faq-answer">
                Segera hubungi resepsionis atau manajer shift. Kami berkomitmen menyelesaikan keluhan dalam waktu 30 menit. Feedback Anda sangat berharga untuk perbaikan layanan.
              </div>
            </div>
          </div>
        </div>

        <!-- Contact CTA -->
        <div class="text-center mt-5" data-aos="fade-up">
          <div class="card border-0 shadow-sm p-4">
            <h4>Tidak menemukan jawaban yang Anda cari?</h4>
            <p class="text-muted mb-3">Tim customer service kami siap membantu Anda 24/7</p>
            <div class="d-flex justify-content-center gap-3">
              <a href="{{ route('contact') }}" class="btn btn-primary">
                <i class="bi bi-envelope me-2"></i>Hubungi Kami
              </a>
              <a href="tel:+62123456789" class="btn btn-outline-primary">
                <i class="bi bi-telephone me-2"></i>+62 123 456 789
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h2 class="mb-3">Berlangganan Newsletter</h2>
        <p class="mb-4">Dapatkan update terbaru tentang promo spesial, event hotel, dan tips traveling</p>
        <form class="newsletter-form">
          <div class="input-group">
            <input type="email" class="form-control" placeholder="Masukkan email Anda" required>
            <button class="btn" type="submit">Berlangganan</button>
          </div>
        </form>
        <small class="mt-2 d-block opacity-75">Kami menghargai privasi Anda. Email tidak akan disebarkan ke pihak ketiga.</small>
      </div>
    </div>
  </div>
</section>
@endsection
