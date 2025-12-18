@extends('layouts.navigation')

@section('content')
<section class="page-header">
    <div class="page-header-content">
        <h1>Kamar & Suite</h1>
        <p>Pilih kamar yang sesuai dengan kebutuhan Anda</p>
    </div>
</section>

<section class="rooms">
    <h2>Koleksi Kamar Kami</h2>
    <div class="room-slider">
        @forelse($rooms as $room)
            <div class="room-card">
                @php
                    $roomType = strtolower($room->type);
                    $imageMap = [
                        'deluxe' => 'deluxe-room.jpg',
                        'suite' => 'suite-room.jpg',
                        'standard' => 'standard-room.jpg'
                    ];
                    $imageName = $imageMap[$roomType] ?? 'standard-room.jpg';
                @endphp
                <img src="{{ asset('images/rooms/' . $imageName) }}" alt="{{ $room->name }}">
                <h3>{{ $room->name }}</h3>
                <p>{{ $room->type }}</p>
                <div class="room-features">
                    <span>👥 {{ $room->capacity }} orang</span>
                    <span>🛏️ {{ $room->type }}</span>
                    <span>📶 WiFi Gratis</span>
                </div>
                <div class="price">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}/malam</div>
                <a href="{{ route('booking') }}" class="btn">Pesan Sekarang</a>
            </div>
        @empty
            <div class="room-card">
                <div style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🏨</div>
                    <h3>Belum ada kamar tersedia</h3>
                    <p>Silakan hubungi kami untuk informasi lebih lanjut</p>
                </div>
            </div>
        @endforelse
    </div>
</section>

<section class="room-services">
    <h2>Layanan Kamar</h2>
    <div class="services-grid">
        <div class="service-item">
            <div class="service-icon">🧹</div>
            <h4>Pembersihan Harian</h4>
            <p>Layanan housekeeping 24 jam dengan standar internasional</p>
        </div>
        <div class="service-item">
            <div class="service-icon">🛎️</div>
            <h4>Room Service</h4>
            <p>Pesan makanan dan minuman langsung ke kamar Anda</p>
        </div>
        <div class="service-item">
            <div class="service-icon">🛏️</div>
            <h4>Turndown Service</h4>
            <p>Persiapan tempat tidur dengan sentuhan pribadi</p>
        </div>
        <div class="service-item">
            <div class="service-icon">📺</div>
            <h4>Entertainment</h4>
            <p>TV kabel, musik, dan akses internet cepat</p>
        </div>
    </div>
</section>
@endsection
