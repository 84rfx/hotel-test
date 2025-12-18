@extends('layouts.admin')

@section('title', 'Admin - Edit Pengguna')

@section('content')
<div class="admin-edit-form">
  <h3 class="text-center mb-4"><i class="bi bi-person-gear me-2"></i>Edit Pengguna</h3>
  <form id="edit-user-form">
    <input type="hidden" id="user-id" value="">
    <div class="mb-3">
      <label class="form-label">ID Pengguna</label>
      <input type="text" id="user-id-display" class="form-control" readonly>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" id="user-name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" id="user-email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Avatar</label>
      <input type="file" id="user-avatar" accept="image/*" class="form-control">
      <img id="user-avatar-preview" src="{{ asset('assets/img/default-profile.png') }}" alt="avatar" class="avatar-preview mx-auto d-block mt-2">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
      <a href="{{ route('admin.users') }}" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>
@endsection
