@extends('layouts.admin')

@section('title', 'Admin - Manajemen Kamar')

@section('content')
<div class="admin-table-container">
  <div class="admin-table-header">
    <h4><i class="bi bi-house-door me-2"></i>Manajemen Kamar</h4>
    <div>
      <input type="text" id="rooms-search" class="form-control admin-table-search" placeholder="Cari kamar...">
      <button class="btn ms-2" onclick="window.location.href='/admin/rooms/add'">Tambah Kamar</button>
    </div>
  </div>
  <table class="table admin-table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="rooms-table-body">
      <!-- Dynamic rows -->
    </tbody>
  </table>
</div>
@endsection
