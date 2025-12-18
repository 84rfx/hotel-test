@extends('layouts.navigation')

@section('content')
<section class="page-header">
    <div class="page-header-content">
        <h1>Fasilitas & Layanan</h1>
        <p>Nikmati pengalaman menginap yang tak terlupakan</p>
    </div>
</section>

<section class="amenities">
    <h2>Fasilitas Hotel</h2>
    <div class="amenity-list">
        <div class="amenity">
            <div class="amenity-icon">🏊‍♂️</div>
            <h4>Kolam Renang Infinity</h4>
            <p>Kolam renang outdoor dengan pemandangan kota Bandung yang spektakuler</p>
            <div class="amenity-features">
                <span>🌅 Pemandangan Kota</span>
                <span>🪑 Lounge Area</span>
                <span>🍹 Pool Bar</span>
            </div>
        </div>
        <div class="amenity">
            <div class="amenity-icon">🍽️</div>
            <h4>Restoran & Bar</h4>
            <p>Restoran fine dining dengan menu internasional dan bar rooftop</p>
            <div class="amenity-features">
                <span>👨‍🍳 Chef Berbintang</span>
                <span>🍷 Wine Collection</span>
                <span>🌆 City View</span>
            </div>
        </div>
        <div class="amenity">
            <div class="amenity-icon">🧘‍♀️</div>
            <h4>Spa & Wellness</h4>
            <p>Center wellness dengan treatment tradisional Indonesia</p>
            <div class="amenity-features">
                <span>💆‍♀️ Traditional Massage</span>
                <span>🛁 Jacuzzi</span>
                <span>🌿 Herbal Treatment</span>
            </div>
        </div>
        <div class="amenity">
            <div class="amenity-icon">💪</div>
            <h4>Fitness Center</h4>
            <p>Gym lengkap dengan equipment modern dan personal trainer</p>
            <div class="amenity-features">
                <span>🏋️ Modern Equipment</span>
                <span>👨‍💼 Personal Trainer</span>
                <span>🥤 Protein Bar</span>
            </div>
        </div>
    </div>
</section>

<section class="additional-services">
    <h2>Layanan Tambahan</h2>
    <div class="services-overview">
        <div class="service-category">
            <h3>🏨 Layanan Kamar</h3>
            <ul>
                <li>Room service 24 jam</li>
                <li>Housekeeping harian</li>
                <li>Turndown service</li>
                <li>Laundry & dry cleaning</li>
            </ul>
        </div>
        <div class="service-category">
            <h3>🚗 Transportasi</h3>
            <ul>
                <li>Airport transfer</li>
                <li>Car rental service</li>
                <li>Valet parking</li>
                <li>Tour arrangement</li>
            </ul>
        </div>
        <div class="service-category">
            <h3>💼 Business Center</h3>
            <ul>
                <li>Meeting rooms</li>
                <li>Business center</li>
                <li>High-speed internet</li>
                <li>Secretarial service</li>
            </ul>
        </div>
    </div>
</section>
@endsection
