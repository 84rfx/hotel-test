@extends('layouts.admin')

@section('title', 'Admin - Dashboard')

@section('content')
<div class="admin-dashboard">
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card stat-card mb-3">
        <div class="card-body">
          <i class="bi bi-people"></i>
          <h6>Pengguna Terdaftar</h6>
          <h2 id="stat-users">0</h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card stat-card mb-3">
        <div class="card-body">
          <i class="bi bi-house-door"></i>
          <h6>Jumlah Kamar</h6>
          <h2 id="stat-rooms">0</h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card stat-card mb-3">
        <div class="card-body">
          <i class="bi bi-calendar-check"></i>
          <h6>Reservasi</h6>
          <h2 id="stat-reservations">0</h2>
        </div>
      </div>
    </div>
  </div>
  <h5 class="mt-4 mb-3"><i class="bi bi-bar-chart-line me-2"></i>Statistik Harian Reservasi</h5>
  <table class="table table-striped">
    <thead>
      <tr>
        <th><i class="bi bi-calendar me-1"></i>Tanggal</th>
        <th><i class="bi bi-graph-up me-1"></i>Jumlah Reservasi</th>
      </tr>
    </thead>
    <tbody id="daily-stats-body">
      <!-- Dynamic rows -->
    </tbody>
  </table>
  <div class="card log-card mt-4">
    <div class="card-body">
      <h5><i class="bi bi-info-circle me-2"></i>Log Singkat</h5>
      <p>Demo admin panel — semua data disimpan di browser (localStorage). Kelola pengguna, kamar, dan reservasi dengan mudah.</p>
    </div>
  </div>
</div>
@endsection
