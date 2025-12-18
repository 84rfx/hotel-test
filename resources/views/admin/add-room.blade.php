@extends('layouts.admin')

@section('title', 'Admin - Tambah Kamar')

@section('content')
<div class="admin-edit-form">
  <h3 class="text-center mb-4"><i class="bi bi-house-plus me-2"></i>Tambah Kamar Baru</h3>
  <form id="add-room-form">
    <div class="mb-3">
      <label class="form-label">Nama Kamar</label>
      <input type="text" id="room-name" class="form-control" placeholder="e.g., Superior Deluxe" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi Kamar</label>
      <textarea id="room-description" class="form-control" rows="3" placeholder="Deskripsi fasilitas kamar, e.g., Kamar nyaman dengan AC, TV, WiFi..."></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga (Rp)</label>
      <input type="number" id="room-price" class="form-control" min="100000" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Gambar Kamar</label>
      <input type="file" id="room-image" accept="image/*" class="form-control">
      <img id="room-image-preview" src="{{ asset('assets/img/default-room.png') }}" alt="preview" class="avatar-preview mx-auto d-block mt-2" style="width: 200px; height: 150px; object-fit: cover; border-radius: 10px;">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary me-2">Tambah Kamar</button>
      <a href="{{ route('admin.rooms') }}" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>
@endsection
