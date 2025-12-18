@extends('layouts.navigation')

@section('content')
<section id="home" class="hero">
    <div class="hero-content">
        <h1>Selamat Datang di Grand Bandung Hotel</h1>
        <p>Pengalaman menginap mewah dengan pemandangan kota Bandung yang memukau.</p>
        <p class="hero-subtitle">Terletak di jantung kota Bandung, hotel bintang 5 dengan layanan premium</p>
        <a href="{{ route('booking') }}" class="btn">Reservasi Kamar Anda</a>
    </div>
</section>

<section class="features">
    <div class="feature-grid">
        <div class="feature-card">
            <div class="feature-icon">🏨</div>
            <h3>Lokasi Strategis</h3>
            <p>Berada di pusat kota Bandung, mudah diakses dari bandara dan stasiun</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🍽️</div>
            <h3>Restoran Mewah</h3>
            <p>Menyajikan kuliner Indonesia dan internasional dengan chef berbintang</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🏊‍♂️</div>
            <h3>Kolam Renang Infinity</h3>
            <p>Kolam renang dengan pemandangan kota Bandung yang spektakuler</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🧘‍♀️</div>
            <h3>Spa & Wellness</h3>
            <p>Relaksasi total dengan treatment spa tradisional Indonesia</p>
        </div>
    </div>
</section>

<section class="testimonials">
    <h2>Apa Kata Tamu Kami</h2>
    <div class="testimonial-grid">
        <div class="testimonial-card">
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <p>"Hotel yang luar biasa! Pelayanan ramah dan fasilitas lengkap. Pasti akan kembali lagi."</p>
            <cite>- Sari, Jakarta</cite>
        </div>
        <div class="testimonial-card">
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <p>"Lokasi strategis, kamar nyaman, dan pemandangan kota Bandung yang indah dari balkon."</p>
            <cite>- Ahmad, Surabaya</cite>
        </div>
        <div class="testimonial-card">
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <p>"Restorannya menyajikan makanan Indonesia autentik dengan cita rasa yang luar biasa."</p>
            <cite>- Maya, Bandung</cite>
        </div>
    </div>
</section>
@endsection
