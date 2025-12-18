@extends('layouts.navigation')

@section('content')
<section class="page-header">
    <div class="page-header-content">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu Anda</p>
    </div>
</section>

<section class="contact-section">
    <div class="contact-container">
        <div class="contact-info">
            <h2>Informasi Kontak</h2>
            <div class="contact-details">
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div class="contact-text">
                        <h4>Alamat</h4>
                        <p>Jl. Asia Afrika No. 123<br>Bandung 40111, Indonesia</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-text">
                        <h4>Telepon</h4>
                        <p>+62 22 1234 5678</p>
                        <p>+62 22 1234 5679 (Reservasi)</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <div class="contact-text">
                        <h4>Email</h4>
                        <p>info@grandbandunghotel.com</p>
                        <p>reservation@grandbandunghotel.com</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">🕒</div>
                    <div class="contact-text">
                        <h4>Jam Operasional</h4>
                        <p>Resepsionis: 24 jam</p>
                        <p>Restoran: 06:00 - 22:00</p>
                        <p>Spa: 09:00 - 21:00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <h2>Kirim Pesan</h2>
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="department">Departemen</label>
                    <select id="department" name="department" required>
                        <option value="">Pilih Departemen</option>
                        <option value="reservation">Reservasi</option>
                        <option value="restaurant">Restoran</option>
                        <option value="spa">Spa & Wellness</option>
                        <option value="events">Event</option>
                        <option value="general">Umum</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject">Subjek</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Pesan</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn">Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>

<section class="location-section">
    <div class="location-content">
        <div class="location-info">
            <h3>Lokasi Strategis</h3>
            <p>Grand Bandung Hotel terletak di jantung kota Bandung, mudah diakses dari berbagai tempat strategis.</p>
            <div class="transport-options">
                <div class="transport-item">
                    <div class="transport-icon">✈️</div>
                    <div class="transport-details">
                        <h4>Bandara</h4>
                        <p>15 menit dari Bandara Internasional Husein Sastranegara</p>
                    </div>
                </div>
                <div class="transport-item">
                    <div class="transport-icon">🚆</div>
                    <div class="transport-details">
                        <h4>Stasiun</h4>
                        <p>10 menit dari Stasiun Bandung dan Stasiun Hall</p>
                    </div>
                </div>
                <div class="transport-item">
                    <div class="transport-icon">🛍️</div>
                    <div class="transport-details">
                        <h4>Shopping</h4>
                        <p>5 menit dari pusat perbelanjaan dan kuliner</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="map-placeholder">
            <div class="map-icon">🗺️</div>
            <h3>Peta Lokasi</h3>
            <p>Jl. Asia Afrika No. 123, Bandung 40111</p>
            <a href="#" class="btn">Buka di Google Maps</a>
        </div>
    </div>
</section>

<section class="nearby-attractions">
    <h2>Tempat Menarik Terdekat</h2>
    <div class="attractions-grid">
        <div class="attraction-item">
            <div class="attraction-icon">🏛️</div>
            <h4>Gedung Sate</h4>
            <p>5 menit berkendara</p>
        </div>
        <div class="attraction-item">
            <div class="attraction-icon">🌸</div>
            <h4>Kebun Binatang</h4>
            <p>10 menit berkendara</p>
        </div>
        <div class="attraction-item">
            <div class="attraction-icon">🏞️</div>
            <h4>Taman Hutan Raya</h4>
            <p>15 menit berkendara</p>
        </div>
        <div class="attraction-item">
            <div class="attraction-icon">🛍️</div>
            <h4>Cihampelas Walk</h4>
            <p>8 menit berkendara</p>
        </div>
    </div>
</section>
@endsection
