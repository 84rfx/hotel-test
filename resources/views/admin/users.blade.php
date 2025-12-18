@extends('layouts.admin')

@section('title', 'Admin - Manajemen User')

@section('content')
<div class="admin-table-container">
  <div class="admin-table-header">
    <h4><i class="bi bi-people me-2"></i>Manajemen Pengguna</h4>
    <div>
      <input type="text" id="users-search" class="form-control admin-table-search" placeholder="Cari pengguna...">
    </div>
  </div>
  <table class="table admin-table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="users-table-body">
      <!-- Dynamic rows -->
    </tbody>
  </table>
</div>
@endsection
