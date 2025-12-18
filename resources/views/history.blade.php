@extends('layouts.app')

@section('title', 'Riwayat Reservasi - StayEasy Hotel')

@section('content')
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/img/room2.jpg') }}') center/cover no-repeat fixed; min-height: 50vh;">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <h1 class="display-5 mb-3 text-white">Riwayat Reservasi Anda</h1>
        <p class="lead text-white">Lihat dan kelola reservasi sebelumnya di StayEasy Hotel.</p>
      </div>
    </div>
  </div>
</section>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="history-table" data-aos="fade-up" data-aos-delay="100">
        <div class="card border-0 shadow">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-clock-history me-2"></i>Reservasi Saya</h4>
          </div>
          <div class="card-body p-0">
            <div class="p-4">
              <!-- Search and Filter -->
              <div class="row mb-3">
                <div class="col-md-6">
                  <input type="text" id="search-input" class="form-control" placeholder="Cari reservasi (tipe kamar, tanggal)...">
                </div>
                <div class="col-md-3">
                  <select id="status-filter" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Pending">Pending</option>
                    <option value="Cancelled">Cancelled</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <button id="clear-filters" class="btn btn-outline-secondary w-100">Clear Filters</button>
                </div>
              </div>
              <div id="history-table-container">
                <div class="text-center py-5">
                  <i class="bi bi-person-circle display-1 text-muted mb-3"></i>
                  <h5 class="text-muted">Silakan login untuk melihat riwayat reservasi.</h5>
                  <p class="text-muted">Anda perlu akun untuk mengakses riwayat reservasi Anda.</p>
                  <a href="{{ route('login') }}" class="btn btn-primary">Login Sekarang</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const user = JSON.parse(localStorage.getItem('se_user') || 'null');
  const container = document.getElementById('history-table-container');
  
  if (!user) {
    container.innerHTML = '<p class="text-muted">Silakan login untuk melihat riwayat reservasi.</p>';
    return;
  }
  
  const reservations = JSON.parse(localStorage.getItem('se_reservations') || '[]');
  const userReservations = reservations.filter(r => r.email === user.email);
  
  if (userReservations.length === 0) {
    container.innerHTML = '<p class="text-muted">Belum ada riwayat reservasi.</p>';
    return;
  }
  
  let tableHTML = `
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Tipe Kamar</th>
          <th>Check-in</th>
          <th>Check-out</th>
          <th>Dewasa</th>
          <th>Anak</th>
          <th>Referral</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
  `;
  
  userReservations.forEach((res, index) => {
    const status = 'Confirmed'; // Dummy status
    tableHTML += `
      <tr>
        <td>${index + 1}</td>
        <td>${res.room}</td>
        <td>${res.checkin}</td>
        <td>${res.checkout}</td>
        <td>${res.adults || 1}</td>
        <td>${res.kids || 0}</td>
        <td>${res.referral || '-'}</td>
        <td><span class="badge bg-success">${status}</span></td>
      </tr>
    `;
  });
  
  tableHTML += '</tbody></table>';
  container.innerHTML = tableHTML;
});
</script>
@endsection
