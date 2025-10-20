@extends('layouts.app')

@section('title', 'Detail Kamar - StayEasy Hotel')

@section('content')
<section class="room-detail-hero">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <h1 class="display-4 mb-3 text-white" id="room-title">Superior Room</h1>
        <p class="lead text-white" id="room-subtitle">Kamar nyaman untuk 2 orang dengan fasilitas lengkap</p>
        <div class="rating-stars mb-3">
          ★★★★☆ <small class="text-white ms-2">(4.2 dari 156 ulasan)</small>
        </div>
        <div class="d-flex justify-content-center gap-3">
          <button class="btn btn-light btn-lg" onclick="addToWishlist()">
            <i class="bi bi-heart me-2"></i>Tambah ke Wishlist
          </button>
          <a href="{{ route('reservation') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-calendar-check me-2"></i>Reservasi Sekarang
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="room-detail-section">
  <div class="container">
    <div class="row g-5">
      <!-- Room Gallery -->
      <div class="col-lg-8" data-aos="fade-up">
        <div id="roomCarousel" class="carousel slide room-gallery" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('assets/img/room1.jpg') }}" class="d-block w-100" alt="Room view 1">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/img/room2.jpg') }}" class="d-block w-100" alt="Room view 2">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/img/room3.jpg') }}" class="d-block w-100" alt="Room view 3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>

        <!-- Room Thumbnails -->
        <div class="row g-2 mt-3">
          <div class="col-4">
            <img src="{{ asset('assets/img/room1.jpg') }}" class="img-fluid rounded cursor-pointer" onclick="changeSlide(0)" alt="Thumbnail 1">
          </div>
          <div class="col-4">
            <img src="{{ asset('assets/img/room2.jpg') }}" class="img-fluid rounded cursor-pointer" onclick="changeSlide(1)" alt="Thumbnail 2">
          </div>
          <div class="col-4">
            <img src="{{ asset('assets/img/room3.jpg') }}" class="img-fluid rounded cursor-pointer" onclick="changeSlide(2)" alt="Thumbnail 3">
          </div>
        </div>
      </div>

      <!-- Room Info -->
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="room-info-card">
          <h3 class="mb-3">Informasi Kamar</h3>

          <div class="mb-3">
            <h5>Harga per Malam</h5>
            <div class="d-flex align-items-center">
              <span class="h4 text-primary mb-0" id="room-price">Rp 350.000</span>
              <small class="text-muted ms-2">termasuk breakfast</small>
            </div>
          </div>

          <div class="mb-3">
            <h5>Kapasitas</h5>
            <p><i class="bi bi-people me-2"></i>2 Dewasa, 1 Anak</p>
          </div>

          <div class="mb-3">
            <h5>Luas Kamar</h5>
            <p><i class="bi bi-arrows-fullscreen me-2"></i>25 m²</p>
          </div>

          <div class="mb-4">
            <h5>Fasilitas</h5>
            <ul class="facility-list">
              <li><i class="bi bi-check-circle"></i>AC</li>
              <li><i class="bi bi-check-circle"></i>TV Kabel</li>
              <li><i class="bi bi-check-circle"></i>WiFi Gratis</li>
              <li><i class="bi bi-check-circle"></i>Kamar Mandi Dalam</li>
              <li><i class="bi bi-check-circle"></i>Air Panas</li>
              <li><i class="bi bi-check-circle"></i>Meja Kerja</li>
              <li><i class="bi bi-check-circle"></i>Lemari</li>
              <li><i class="bi bi-check-circle"></i>Brankas</li>
            </ul>
          </div>

          <div class="social-share">
            <span class="me-2">Bagikan:</span>
            <a href="#" class="social-btn facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="social-btn twitter" title="Twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="social-btn whatsapp" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Room Description -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="300">
      <div class="col-12">
        <div class="card border-0 shadow-sm p-4">
          <h3 class="mb-3">Deskripsi Kamar</h3>
          <p class="lead">Kamar Superior StayEasy Hotel menawarkan kenyamanan maksimal untuk Anda yang mencari pengalaman menginap yang berkesan. Dengan desain modern dan fasilitas lengkap, kamar ini cocok untuk traveler bisnis maupun liburan.</p>

          <div class="row mt-4">
            <div class="col-md-6">
              <h5>Keunggulan Kamar</h5>
              <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Pemandangan kota yang indah</li>
                <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Lokasi strategis di pusat kota</li>
                <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Interior modern dan elegan</li>
                <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Kebersihan terjamin</li>
              </ul>
            </div>
            <div class="col-md-6">
              <h5>Kebijakan Khusus</h5>
              <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-info-circle text-info me-2"></i>Check-in: 14:00 WIB</li>
                <li class="mb-2"><i class="bi bi-info-circle text-info me-2"></i>Check-out: 12:00 WIB</li>
                <li class="mb-2"><i class="bi bi-info-circle text-info me-2"></i>Extra bed tersedia</li>
                <li class="mb-2"><i class="bi bi-info-circle text-info me-2"></i>Pembatalan 24 jam sebelumnya</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Reviews Section -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="400">
      <div class="col-12">
        <div class="card border-0 shadow-sm p-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Ulasan Tamu</h3>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
              <i class="bi bi-star me-2"></i>Tulis Ulasan
            </button>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="text-center">
                <div class="h2 text-warning mb-1">4.2</div>
                <div class="rating-stars mb-2">★★★★☆</div>
                <small class="text-muted">156 ulasan</small>
              </div>
            </div>
            <div class="col-md-8">
              <div class="review-summary">
                <div class="d-flex justify-content-between mb-2">
                  <span>Kenyamanan</span>
                  <div class="rating-stars">★★★★☆</div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span>Kebersihan</span>
                  <div class="rating-stars">★★★★★</div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span>Lokasi</span>
                  <div class="rating-stars">★★★★☆</div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span>Fasilitas</span>
                  <div class="rating-stars">★★★★☆</div>
                </div>
                <div class="d-flex justify-content-between">
                  <span>Pelayanan</span>
                  <div class="rating-stars">★★★★★</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Individual Reviews -->
          <div class="reviews-list mt-4">
            <div class="review-card">
              <div class="d-flex justify-content-between mb-2">
                <strong>Sarah K.</strong>
                <div class="rating-stars">★★★★★</div>
              </div>
              <small class="text-muted">15 November 2024</small>
              <p class="mt-2">"Kamar sangat nyaman dan bersih. Pelayanan resepsionis sangat ramah dan membantu. Lokasi hotel sangat strategis, dekat dengan pusat perbelanjaan."</p>
            </div>

            <div class="review-card">
              <div class="d-flex justify-content-between mb-2">
                <strong>Budi S.</strong>
                <div class="rating-stars">★★★★☆</div>
              </div>
              <small class="text-muted">10 November 2024</small>
              <p class="mt-2">"Pengalaman menginap yang baik. Kamar sesuai dengan ekspektasi. Hanya saja WiFi kadang lambat di malam hari. Secara keseluruhan recommended."</p>
            </div>

            <div class="review-card">
              <div class="d-flex justify-content-between mb-2">
                <strong>Lina P.</strong>
                <div class="rating-stars">★★★★★</div>
              </div>
              <small class="text-muted">5 November 2024</small>
              <p class="mt-2">"Hotel yang sangat recommended untuk keluarga. Anak-anak senang dengan kolam renang dan playground. Staf hotel sangat friendly dan helpful."</p>
            </div>
          </div>

          <div class="text-center mt-3">
            <button class="btn btn-outline-primary">Lihat Semua Ulasan (156)</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Similar Rooms -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="500">
      <div class="col-12">
        <h3 class="text-center mb-4">Kamar Lainnya</h3>
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <div class="card card-room h-100">
              <div class="position-relative">
                <img src="{{ asset('assets/img/room2.jpg') }}" class="card-img-top" alt="Deluxe Room">
                <button class="wishlist-btn" onclick="toggleWishlist(this)">
                  <i class="bi bi-heart"></i>
                </button>
              </div>
              <div class="card-body">
                <h5 class="card-title">Deluxe Room</h5>
                <p class="card-text">Lebih luas dengan pemandangan kota yang indah.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="h6 text-primary mb-0">Rp 550.000/malam</span>
                  <a href="#" class="btn btn-primary btn-sm">Lihat Detail</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card card-room h-100">
              <div class="position-relative">
                <img src="{{ asset('assets/img/room3.jpg') }}" class="card-img-top" alt="Suite Room">
                <button class="wishlist-btn" onclick="toggleWishlist(this)">
                  <i class="bi bi-heart"></i>
                </button>
              </div>
              <div class="card-body">
                <h5 class="card-title">Suite Room</h5>
                <p class="card-text">Pilihan mewah dengan fasilitas premium dan eksklusif.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="h6 text-primary mb-0">Rp 950.000/malam</span>
                  <a href="#" class="btn btn-primary btn-sm">Lihat Detail</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tulis Ulasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="review-form">
          <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="rating-input">
              <input type="radio" name="rating" value="5" id="star5"><label for="star5">★</label>
              <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
              <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
              <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
              <input type="radio" name="rating" value="1" id="star1"><label for="star1">★</label>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Anda</label>
            <input type="text" class="form-control" name="reviewer-name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Ulasan Anda</label>
            <textarea class="form-control" name="review-text" rows="4" placeholder="Bagikan pengalaman Anda menginap di hotel ini..." required></textarea>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function changeSlide(index) {
  const carousel = new bootstrap.Carousel(document.getElementById('roomCarousel'));
  carousel.to(index);
}

function addToWishlist() {
  // Simulate adding to wishlist
  showToast('Kamar ditambahkan ke wishlist!', 'success');
}

function toggleWishlist(btn) {
  btn.classList.toggle('active');
  const icon = btn.querySelector('i');
  if (btn.classList.contains('active')) {
    icon.style.color = '#e74c3c';
    showToast('Ditambahkan ke wishlist!', 'success');
  } else {
    icon.style.color = '#666';
    showToast('Dihapus dari wishlist!', 'info');
  }
}

function showToast(message, type) {
  const toastContainer = document.querySelector('.toast-container') || createToastContainer();
  const toast = document.createElement('div');
  toast.className = `toast align-items-center text-white bg-${type} border-0`;
  toast.innerHTML = `
    <div class="d-flex">
      <div class="toast-body">${message}</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  `;
  toastContainer.appendChild(toast);
  const bsToast = new bootstrap.Toast(toast);
  bsToast.show();
  setTimeout(() => toast.remove(), 5000);
}

function createToastContainer() {
  const container = document.createElement('div');
  container.className = 'toast-container';
  document.body.appendChild(container);
  return container;
}

// Handle review form submission
document.getElementById('review-form')?.addEventListener('submit', function(e) {
  e.preventDefault();
  showToast('Terima kasih atas ulasan Anda!', 'success');
  bootstrap.Modal.getInstance(document.getElementById('reviewModal')).hide();
  this.reset();
});
</script>
@endsection
