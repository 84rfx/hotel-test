@extends('layouts.app')

@section('title', 'Daftar - StayEasy Hotel')

@section('content')
<main class="container my-5" style="max-width:540px;">
  <h3>Daftar</h3>
  <form id="register-form" class="mt-3">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input name="name" type="text" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input name="email" type="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input name="password" type="password" class="form-control" required>
    </div>
    <button class="btn btn-primary">Daftar</button>
  </form>
</main>
@endsection
