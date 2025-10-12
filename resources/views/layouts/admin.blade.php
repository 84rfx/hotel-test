<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Admin - StayEasy Hotel')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body onload="adminInit()">
<header class="admin-topbar-full d-flex align-items-center justify-content-between">
  <div class="d-flex align-items-center gap-3">
    <button class="btn btn-light d-md-none" id="admin-toggle-sidebar"><i class="bi bi-list"></i></button>
    <div class="brand">StayEasy Admin</div>
  </div>
  <div class="d-flex align-items-center gap-3">
    <div class="me-3 text-white">Hai, Admin</div>
    <div class="dropdown user-dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/img/default-profile.png') }}" alt="avatar">
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
        <li><a class="dropdown-item" href="#">Profil</a></li>
        <li><a class="dropdown-item" href="#" id="admin-logout-link">Logout</a></li>
      </ul>
    </div>
  </div>
</header>

<div class="d-flex">
  <div class="sidebar-overlay d-none d-md-none" id="sidebar-overlay"></div>
  <aside class="sidebar-compact d-none d-md-block" id="admin-sidebar">
    <nav class="nav flex-column">
      <a class="nav-link active" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
      <a class="nav-link" href="{{ route('admin.rooms') }}"><i class="bi bi-house-door me-2"></i>Manajemen Kamar</a>
      <a class="nav-link" href="{{ route('admin.users') }}"><i class="bi bi-people me-2"></i>Manajemen User</a>
      <a class="nav-link" href="{{ route('admin.reservations') }}"><i class="bi bi-calendar-check me-2"></i>Manajemen Reservasi</a>
    </nav>
  </aside>
  <main class="admin-content flex-grow-1">

  @yield('content')

  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/admin.js') }}"></script>
<script>
document.getElementById('admin-logout-link')?.addEventListener('click', function(e){ e.preventDefault(); localStorage.removeItem('se_user'); window.location.href='{{ route('login') }}'; });

// Enhanced sidebar toggle for mobile
const toggleBtn = document.getElementById('admin-toggle-sidebar');
const sidebar = document.getElementById('admin-sidebar');
const overlay = document.getElementById('sidebar-overlay');

if (toggleBtn && sidebar && overlay) {
  toggleBtn.addEventListener('click', function() {
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
  });

  overlay.addEventListener('click', function() {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
  });

  // Close sidebar on route change (for SPA-like behavior)
  window.addEventListener('popstate', function() {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
  });
}
</script>
</body>
</html>
