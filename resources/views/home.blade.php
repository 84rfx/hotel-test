@extends('layouts.app')

@section('title', 'StayEasy Hotel - Beranda')

@section('content')
<section class="hero-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 text-center">
        <div class="promo-banner" data-aos="fade-down">
          <h2 class="h3 h2-sm">EXCLUSIVE OFFER: 15% OFF</h2>
          <p class="lead lead-sm">Special discount for new guests. Book your stay until December 2025!</p>
        </div>
        <div class="search-container" data-aos="fade-up" data-aos-delay="200">
          <form action="{{ route('reservation') }}" method="GET" class="search-form">
            <div class="search-row row g-2 g-md-3">
              <div class="search-col col-12 col-sm-6 col-md-3">
                <label for="checkin" class="form-label">Check-in</label>
                <input type="date" id="checkin" name="checkin" class="form-control" required>
              </div>
              <div class="search-col col-12 col-sm-6 col-md-3">
                <label for="checkout" class="form-label">Check-out</label>
                <input type="date" id="checkout" name="checkout" class="form-control" required>
              </div>
              <div class="search-col col-12 col-sm-6 col-md-3">
                <label for="guests" class="form-label">Rooms & Guests</label>
                <select id="guests" name="guests" class="form-select">
                  <option value="1">1 Room, 1 Guest</option>
                  <option value="2">1 Room, 2 Guests</option>
                  <option value="3">2 Rooms, 3 Guests</option>
                  <option value="4">2 Rooms, 4 Guests</option>
                </select>
              </div>
              <div class="search-col col-12 col-sm-6 col-md-3">
                <label for="promo" class="form-label">Promo Code</label>
                <input type="text" id="promo" name="promo" class="form-control" placeholder="Enter code">
              </div>
            </div>
            <div class="row justify-content-center mt-3">
              <div class="col-12 col-md-8 text-center">
                <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto me-md-3 mb-2 mb-md-0">Cek Ketersediaan</button>
                <a href="tel:+62123456789" class="btn btn-light btn-lg w-100 w-md-auto">Chat dengan Kami <span class="phone-badge d-none d-md-inline">+62 123 456 789</span></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="rooms-section">
  <div class="container">
    <h3 class="text-center mb-5" data-aos="fade-up">Kamar Pilihan Kami</h3>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card card-room">
          <img src="{{ asset('assets/img/room1.jpg') }}" class="card-img-top" alt="Superior Room">
          <div class="card-body">
            <h5 class="card-title">Superior</h5>
            <p class="card-text">Kamar nyaman untuk 2 orang dengan fasilitas lengkap.</p>
            <a href="#" class="btn btn-outline-info me-2" data-bs-toggle="modal" data-bs-target="#modalSuperior">Discover More</a>
            <a href="{{ route('reservation', ['room' => 'Superior']) }}" class="btn btn-primary">Pesan Sekarang</a>
          </div>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card card-room">
          <img src="{{ asset('assets/img/room2.jpg') }}" class="card-img-top" alt="Deluxe Room">
          <div class="card-body">
            <h5 class="card-title">Deluxe</h5>
            <p class="card-text">Lebih luas dengan pemandangan kota yang indah.</p>
            <a href="#" class="btn btn-outline-info me-2" data-bs-toggle="modal" data-bs-target="#modalDeluxe">Discover More</a>
            <a href="{{ route('reservation', ['room' => 'Deluxe']) }}" class="btn btn-primary">Pesan Sekarang</a>
          </div>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card card-room">
          <img src="{{ asset('assets/img/room3.jpg') }}" class="card-img-top" alt="Suite Room">
          <div class="card-body">
            <h5 class="card-title">Suite</h5>
            <p class="card-text">Pilihan mewah dengan fasilitas premium dan eksklusif.</p>
            <a href="#" class="btn btn-outline-info me-2" data-bs-toggle="modal" data-bs-target="#modalSuite">Discover More</a>
            <a href="{{ route('reservation', ['room' => 'Suite']) }}" class="btn btn-primary">Pesan Sekarang</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Superior -->
<div class="modal fade" id="modalSuperior" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manfaat Kamar Superior</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('assets/img/room1.jpg') }}" class="img-fluid mb-3" alt="Superior Room">
        <ul>
          <li>Kamar nyaman untuk 2 orang dewasa</li>
          <li>Pendingin udara (AC)</li>
          <li>Televisi kabel</li>
          <li>Kamar mandi dalam dengan air panas</li>
          <li>WiFi gratis</li>
          <li>Lemari dan meja kerja</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Modal Deluxe -->
<div class="modal fade" id="modalDeluxe" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manfaat Kamar Deluxe</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('assets/img/room2.jpg') }}" class="img-fluid mb-3" alt="Deluxe Room">
        <ul>
          <li>Ruang lebih luas untuk 2-3 orang</li>
          <li>Pemandangan kota yang indah</li>
          <li>Mini bar dan kopi/teh gratis</li>
          <li>AC, TV, dan fasilitas kamar mandi premium</li>
          <li>WiFi cepat</li>
          <li>Meja kerja dan sofa</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Modal Suite -->
<div class="modal fade" id="modalSuite" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manfaat Kamar Suite</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('assets/img/room3.jpg') }}" class="img-fluid mb-3" alt="Suite Room">
        <ul>
          <li>Ruang luas dengan area terpisah (kamar tidur & ruang tamu)</li>
          <li>King size bed dan jacuzzi</li>
          <li>Fasilitas lengkap: AC, TV layar lebar, mini bar premium</li>
          <li>WiFi ultra cepat</li>
          <li>Layanan kamar 24 jam</li>
          <li>Akses eksklusif ke fasilitas hotel</li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
