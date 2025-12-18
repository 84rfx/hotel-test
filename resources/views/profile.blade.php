@extends('layouts.app')

@section('title', 'Profil - StayEasy Hotel')

@section('content')
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/img/room1.jpg') }}') center/cover no-repeat fixed; min-height: 50vh;">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <h1 class="display-5 mb-3 text-white">Kelola Profil Anda</h1>
        <p class="lead text-white">Perbarui informasi pribadi dan avatar untuk pengalaman yang lebih personal di StayEasy Hotel.</p>
      </div>
    </div>
  </div>
</section>

<section class="profile-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow" data-aos="fade-up" data-aos-delay="100">
          <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>Edit Profil</h4>
          </div>
          <div class="card-body p-4">
            <div class="text-center mb-4">
              <img id="profile-avatar-img" src="{{ asset('assets/img/default-profile.png') }}" alt="avatar" class="profile-avatar-large rounded-circle shadow mb-3">
            </div>
            <form id="profile-form">
              <div class="mb-3">
                <label class="form-label"><i class="bi bi-person text-muted me-1"></i>Nama Lengkap</label>
                <input id="profile-name" name="profile-name" type="text" class="form-control" required>
                <div class="invalid-feedback">Nama wajib diisi.</div>
              </div>
              <div class="mb-3">
                <label class="form-label"><i class="bi bi-envelope text-muted me-1"></i>Email</label>
                <input id="profile-email" name="profile-email" type="email" class="form-control" required>
                <div class="invalid-feedback">Email valid dibutuhkan.</div>
              </div>
              <div class="mb-3">
                <label class="form-label"><i class="bi bi-image text-muted me-1"></i>Unggah Avatar Baru</label>
                <input id="profile-avatar" name="profile-avatar" type="file" accept="image/*" class="form-control">
                <div class="form-text">Pilih gambar untuk avatar profil Anda (JPG, PNG, max 2MB).</div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-4">Simpan Perubahan <i class="bi bi-check-circle ms-2"></i></button>
              </div>
            </form>
          </div>
        </div>
        <div class="text-center mt-4">
          <a href="{{ route('history') }}" class="btn btn-outline-primary">Lihat Riwayat Reservasi</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
