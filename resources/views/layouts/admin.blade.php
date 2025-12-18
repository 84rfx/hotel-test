<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'admin')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        /* Header */
        .admin-header-nav {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            margin-right: 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(255,255,255,0.1);
        }

        .sidebar-toggle.collapsed i::before {
            content: "\f054"; /* right arrow */
        }

        .sidebar-toggle:not(.collapsed) i::before {
            content: "\f053"; /* left arrow */
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            margin-right: 1rem;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
        }

        .header-left h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-left: 1rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e3c72;
            font-weight: 600;
        }

        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-1px);
        }

        /* Sidebar */
        .admin-sidebar {
            background: #fff;
            height: calc(100vh - 60px);
            position: fixed;
            left: 0;
            top: 60px;
            width: 280px;
            padding: 2rem 0;
            z-index: 100;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            border-right: 1px solid #e9ecef;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all 0.3s ease;
            scrollbar-width: thin;
            scrollbar-color: #1e3c72 #f8f9fa;
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: #f8f9fa;
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: #1e3c72;
            border-radius: 3px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: #2a5298;
        }

        .admin-sidebar.collapsed {
            width: 70px;
        }

        .admin-sidebar.collapsed .sidebar-logo h3,
        .admin-sidebar.collapsed .sidebar-logo p,
        .admin-sidebar.collapsed .admin-nav a span:not(.icon) {
            display: none;
        }

        .admin-sidebar.collapsed .sidebar-logo {
            text-align: center;
            padding: 1rem 0;
        }

        .admin-sidebar.collapsed .admin-nav a {
            justify-content: center;
            padding: 1rem 0.5rem;
        }

        .admin-sidebar.collapsed .admin-nav .icon {
            margin-right: 0;
        }

        .sidebar-logo {
            text-align: center;
            padding: 0 2rem 2rem;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 2rem;
        }

        .sidebar-logo h3 {
            color: #1e3c72;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .sidebar-logo p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .admin-nav {
            list-style: none;
            padding: 0 1rem;
        }

        .admin-nav li {
            margin: 0.25rem 0;
        }

        .admin-nav a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #495057;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 0 0.5rem;
            font-weight: 500;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            transform: translateX(5px);
        }

        .admin-nav .icon {
            margin-right: 1rem;
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .admin-main {
            margin-left: 280px;
            padding: 2rem;
            padding-top: 80px;
            min-height: 100vh;
            overflow-y: auto;
        }

        .page-header {
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
        }

        .page-header h1 {
            color: #1e3c72;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 0;
        }

        .page-content {
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
        }

        /* Breadcrumb */
        .breadcrumb {
            margin-bottom: 2rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .breadcrumb a {
            color: #1e3c72;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb span {
            color: #6c757d;
            margin: 0 0.5rem;
        }

        /* Buttons */
        .btn-admin {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 60, 114, 0.3);
        }

        .btn-admin-sm {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
        }

        .btn-admin i,
        .btn-admin-sm i {
            font-size: 0.8rem;
        }

        /* Pagination buttons */
        .pagination {
            font-size: 0.9rem !important;
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            gap: 0.5rem !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .pagination .page-item {
            margin: 0 !important;
        }

        .pagination .page-link {
            font-size: 0.9rem !important;
            padding: 0.5rem 1rem !important;
            line-height: 1.4 !important;
            background-color: #1e3c72 !important;
            color: #fff !important;
            border: 1px solid #1e3c72 !important;
            border-radius: 8px !important;
            margin: 0 !important;
            transition: all 0.3s ease !important;
            display: inline-block !important;
            text-decoration: none !important;
            min-width: 2.5rem !important;
            text-align: center !important;
        }

        .pagination .page-link:hover {
            background-color: #2a5298 !important;
            border-color: #2a5298 !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
        }

        .pagination .page-item.active .page-link {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: #fff !important;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            color: #fff !important;
            opacity: 0.6 !important;
            cursor: not-allowed !important;
        }

        .pagination .page-link::before,
        .pagination .page-link::after {
            display: none !important;
        }

        .pagination .page-link i,
        .pagination .page-link svg,
        .pagination .page-link .fas,
        .pagination .page-link .fa,
        .pagination .page-link * {
            display: none !important;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .btn-success:hover {
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        }

        .btn-danger:hover {
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);
            color: #212529;
        }

        .btn-warning:hover {
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            color: #fff;
        }

        .btn-secondary:hover {
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.3);
        }

        /* Tables */
        .table-admin {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table-admin th,
        .table-admin td {
            padding: 1.2rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .table-admin th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-admin tr:hover {
            background: #f8f9fa;
        }

        .table-admin tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-approved, .status-confirmed, .status-active {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-rejected, .status-cancelled {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-preparing {
            background: #cce5ff;
            color: #004085;
            border: 1px solid #b3d7ff;
        }

        .status-ready {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .status-delivered {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Alerts */
        .alert-admin {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border-left-color: #ffc107;
        }

        /* Cards */
        .stats-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .stats-card .icon {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .stats-card h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .stats-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 0.5rem;
        }

        .stats-card .subtitle {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .stats-card a {
            color: #1e3c72;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .stats-card a:hover {
            text-decoration: underline;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
            outline: none;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .header-left h2 {
                margin-left: 0;
            }

            .admin-nav a {
                padding: 1rem;
                margin: 0.25rem 0.5rem;
            }

            .admin-nav a span:not(.icon) {
                display: none;
            }

            .page-header h1 {
                font-size: 1.8rem;
            }

            .stats-card .number {
                font-size: 1.5rem;
            }

            .admin-sidebar.collapsed {
                width: 280px;
            }

            .admin-sidebar.collapsed .sidebar-logo h3,
            .admin-sidebar.collapsed .sidebar-logo p,
            .admin-sidebar.collapsed .admin-nav a span:not(.icon) {
                display: block;
            }

            .admin-sidebar.collapsed .sidebar-logo {
                text-align: center;
                padding: 0 2rem 2rem;
            }

            .admin-sidebar.collapsed .admin-nav a {
                justify-content: flex-start;
                padding: 1rem 1.5rem;
            }

            .admin-sidebar.collapsed .admin-nav .icon {
                margin-right: 1rem;
            }

            .admin-main {
                margin-left: 280px;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Header Navigation -->
    <header class="admin-header-nav">
        <div class="header-content">
            <div class="header-left">
                <button class="sidebar-toggle">
                    <i class="fas fa-angle-left"></i>
                </button>
                <button class="hamburger">
                    <i class="fas fa-bars"></i>
                </button>
                <h2>Grand Bandung Hotel</h2>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-logo">
            <h3>Admin Panel</h3>
            <p>Management System</p>
        </div>
        <ul class="admin-nav">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt icon"></i><span>Dashboard</span></a></li>
            <li><a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}"><i class="fas fa-users icon"></i><span>Kelola Pengguna</span></a></li>
            <li><a href="{{ route('admin.rooms.index') }}" class="{{ request()->routeIs('admin.rooms*') ? 'active' : '' }}"><i class="fas fa-bed icon"></i><span>Kelola Kamar</span></a></li>
            <li><a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages*') ? 'active' : '' }}"><i class="fas fa-envelope icon"></i><span>Pesan Masuk</span></a></li>
            <li><a href="{{ route('admin.food-orders.index') }}" class="{{ request()->routeIs('admin.food-orders*') ? 'active' : '' }}"><i class="fas fa-utensils icon"></i><span>Pesanan Makanan</span></a></li>
            <li><a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations*') ? 'active' : '' }}"><i class="fas fa-calendar-check icon"></i><span>Reservasi Kamar</span></a></li>
            <li><a href="{{ route('admin.revenue.rooms') }}" class="{{ request()->routeIs('admin.revenue.rooms') ? 'active' : '' }}"><i class="fas fa-bed icon"></i><span>Pemasukan Kamar</span></a></li>
            <li><a href="{{ route('admin.revenue.food') }}" class="{{ request()->routeIs('admin.revenue.food') ? 'active' : '' }}"><i class="fas fa-utensils icon"></i><span>Pemasukan Makanan</span></a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="page-header">
            <h1>@yield('title', 'Admin Panel')</h1>
            <p>@yield('subtitle', 'Selamat datang di panel administrasi Grand Bandung Hotel')</p>
        </div>

        <div class="page-content">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Mobile sidebar toggle
        document.querySelector('.hamburger').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });

        // Sidebar collapse toggle
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.admin-sidebar');
            const toggleBtn = document.querySelector('.sidebar-toggle');

            sidebar.classList.toggle('collapsed');
            toggleBtn.classList.toggle('collapsed');

            // Adjust main content margin
            const mainContent = document.querySelector('.admin-main');
            if (sidebar.classList.contains('collapsed')) {
                mainContent.style.marginLeft = '70px';
            } else {
                mainContent.style.marginLeft = '280px';
            }
        });
    </script>
</body>
</html>
