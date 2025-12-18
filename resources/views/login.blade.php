@extends('layouts.app')

@section('title', 'Masuk - StayEasy Hotel')

@section('content')
<main class="container my-5" style="max-width:540px;">
  <h3>Masuk</h3>
  <form id="login-form" class="mt-3">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input name="email" type="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input name="password" type="password" class="form-control" required>
    </div>
    <div class="mb-3 text-muted"><small>Untuk akses admin gunakan <b>admin@hotel.com</b> / <b>admin</b></small></div>
    <button class="btn btn-primary">Masuk</button>
  </form>
</main>
@endsection
