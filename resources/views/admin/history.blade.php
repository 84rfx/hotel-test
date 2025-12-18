@extends('layouts.admin')

@section('title', 'Admin - Riwayat Reservasi')

@section('content')
<div class="admin-table-container">
  <div class="admin-table-header">
    <h4><i class="bi bi-clock-history me-2"></i>Riwayat Reservasi</h4>
    <div>
      <input type="text" id="history-search" class="form-control admin-table-search" placeholder="Cari riwayat...">
    </div>
  </div>
  <table class="table admin-table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Kamar</th>
        <th>Check-in → Check-out</th>
        <th>Dewasa</th>
        <th>Anak</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="history-table-body">
      <!-- Dynamic rows -->
    </tbody>
  </table>
</div>
@endsection
