@extends('layouts.admin')

@section('title', 'Admin - Edit Kamar')

@section('content')
<div class="container">
  <h3>Edit Kamar</h3>
  <form id="edit-room-form">
    <input type="hidden" id="room-id" value="">
    <div class="mb-3">
      <label class="form-label">ID Kamar</label>
      <input type="number" id="room-id-display" class="form-control" readonly>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Tipe Kamar</label>
      <input type="text" id="room-name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi Kamar</label>
      <textarea id="room-description" class="form-control" rows="3" placeholder="Deskripsi fasilitas kamar..."></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga (Rp)</label>
      <input type="number" id="room-price" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Gambar Kamar</label>
      <input type="file" id="room-image" class="form-control" accept="image/*">
      <img id="room-image-preview" src="" alt="Preview" class="img-fluid mt-2" style="max-width: 200px;">
    </div>
    <button type="submit" class="btn btn-primary">Update Kamar</button>
    <a href="{{ route('admin.rooms') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
