@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('subtitle', 'Pantau dan kelola semua aspek Grand Bandung Hotel')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span> <span>Dashboard</span>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
    <div class="stats-card">
        <i class="fas fa-users text-blue-500 icon"></i>
        <h4>Total Pengguna</h4>
        <div class="number">{{ $stats['total_users'] }}</div>
        <div class="subtitle">Akun terdaftar</div>
        <a href="{{ route('admin.users.index') }}"><i class="fas fa-arrow-right"></i> Kelola</a>
    </div>

    <div class="stats-card">
        <i class="fas fa-bed text-green-500 icon"></i>
        <h4>Total Kamar</h4>
        <div class="number">{{ $stats['total_rooms'] }}</div>
        <div class="subtitle">Kamar tersedia</div>
        <a href="{{ route('admin.rooms.index') }}"><i class="fas fa-arrow-right"></i> Kelola</a>
    </div>

    <div class="stats-card">
        <i class="fas fa-envelope text-yellow-500 icon"></i>
        <h4>Pesan Masuk</h4>
        <div class="number">{{ $stats['total_messages'] }}</div>
        <div class="subtitle">{{ $stats['unread_messages'] }} belum dibaca</div>
        <a href="{{ route('admin.messages.index') }}"><i class="fas fa-arrow-right"></i> Lihat</a>
    </div>

    <div class="stats-card">
        <i class="fas fa-calendar-check text-indigo-500 icon"></i>
        <h4>Reservasi Aktif</h4>
        <div class="number">{{ $stats['active_reservations'] ?? 0 }}</div>
        <div class="subtitle">{{ $stats['pending_reservations'] ?? 0 }} pending</div>
        <a href="{{ route('admin.reservations.index') }}"><i class="fas fa-arrow-right"></i> Kelola</a>
    </div>

    <div class="stats-card">
        <i class="fas fa-utensils text-purple-500 icon"></i>
        <h4>Pesanan Makanan</h4>
        <div class="number">{{ $stats['total_food_orders'] }}</div>
        <div class="subtitle">{{ $stats['pending_food_orders'] }} pending</div>
        <a href="{{ route('admin.food-orders.index') }}"><i class="fas fa-arrow-right"></i> Kelola</a>
    </div>


</div>

<!-- Revenue Statistics -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="stats-card">
        <i class="fas fa-calendar-day text-emerald-500 icon"></i>
        <h4>Pemasukan Hari Ini</h4>
        <div class="number">Rp {{ number_format($revenueStats['daily_total'], 0, ',', '.') }}</div>
        <div class="subtitle">Kamar: Rp {{ number_format($revenueStats['daily_reservations'], 0, ',', '.') }} | Makanan: Rp {{ number_format($revenueStats['daily_food'], 0, ',', '.') }}</div>
    </div>

    <div class="stats-card">
        <i class="fas fa-calendar-week text-cyan-500 icon"></i>
        <h4>Pemasukan Minggu Ini</h4>
        <div class="number">Rp {{ number_format($revenueStats['weekly_total'], 0, ',', '.') }}</div>
        <div class="subtitle">Kamar: Rp {{ number_format($revenueStats['weekly_reservations'], 0, ',', '.') }} | Makanan: Rp {{ number_format($revenueStats['weekly_food'], 0, ',', '.') }}</div>
    </div>

    <div class="stats-card">
        <i class="fas fa-calendar-alt text-teal-500 icon"></i>
        <h4>Pemasukan Bulan Ini</h4>
        <div class="number">Rp {{ number_format($revenueStats['monthly_total'], 0, ',', '.') }}</div>
        <div class="subtitle">Kamar: Rp {{ number_format($revenueStats['monthly_reservations'], 0, ',', '.') }} | Makanan: Rp {{ number_format($revenueStats['monthly_food'], 0, ',', '.') }}</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="stats-card">
        <h4 class="mb-4 flex items-center">
            <i class="fas fa-plus-circle text-blue-500 mr-2"></i>
            Aksi Cepat
        </h4>
        <div class="space-y-3">
            <a href="{{ route('admin.users.create') }}" class="btn-admin btn-admin-sm w-full justify-center">
                <i class="fas fa-user-plus"></i> Tambah Pengguna
            </a>
            <a href="{{ route('admin.rooms.create') }}" class="btn-admin btn-admin-sm w-full justify-center">
                <i class="fas fa-bed"></i> Tambah Kamar
            </a>
            <a href="{{ route('admin.messages.index') }}" class="btn-admin btn-admin-sm w-full justify-center">
                <i class="fas fa-envelope"></i> Lihat Pesan
            </a>
        </div>
    </div>

    <div class="stats-card">
        <h4 class="mb-4 flex items-center">
            <i class="fas fa-chart-line text-green-500 mr-2"></i>
            Status Sistem
        </h4>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-sm">Database</span>
                <span class="status-badge status-approved">Online</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm">Server</span>
                <span class="status-badge status-approved">Running</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm">Migrations</span>
                <span class="status-badge status-approved">Updated</span>
            </div>
        </div>
    </div>

    <div class="stats-card">
        <h4 class="mb-4 flex items-center">
            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
            Tips & Info
        </h4>
        <div class="text-sm text-gray-600 space-y-2">
            <p><i class="fas fa-info-circle text-blue-500 mr-1"></i> Pastikan semua data ter-update</p>
            <p><i class="fas fa-clock text-orange-500 mr-1"></i> Cek pesanan pending secara berkala</p>
            <p><i class="fas fa-shield-alt text-green-500 mr-1"></i> Backup database mingguan</p>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="stats-card">
        <h4 class="mb-4 flex items-center">
            <i class="fas fa-history text-blue-500 mr-2"></i>
            Aktivitas Terbaru
        </h4>
        <div class="space-y-4">
            <div class="flex items-start space-x-3">
                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                <div>
                    <p class="text-sm font-medium">Sistem Admin Diinisialisasi</p>
                    <p class="text-xs text-gray-500">Panel admin berhasil dibuat dan dikonfigurasi</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                <div>
                    <p class="text-sm font-medium">Database Migration Selesai</p>
                    <p class="text-xs text-gray-500">Semua tabel database berhasil dibuat</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2 flex-shrink-0"></div>
                <div>
                    <p class="text-sm font-medium">Menunggu Data Awal</p>
                    <p class="text-xs text-gray-500">Siap untuk menambahkan data kamar dan pengguna</p>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-card">
        <h4 class="mb-4 flex items-center">
            <i class="fas fa-question-circle text-purple-500 mr-2"></i>
            Panduan Admin
        </h4>
        <div class="space-y-3 text-sm">
            <div class="flex items-start">
                <i class="fas fa-users text-blue-500 mr-3 mt-1"></i>
                <div>
                    <strong>Kelola Pengguna:</strong>
                    <p class="text-gray-600">Tambah, edit, hapus akun pelanggan & admin</p>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-bed text-green-500 mr-3 mt-1"></i>
                <div>
                    <strong>Kelola Kamar:</strong>
                    <p class="text-gray-600">Atur detail kamar, harga, dan ketersediaan</p>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-envelope text-yellow-500 mr-3 mt-1"></i>
                <div>
                    <strong>Pesan Masuk:</strong>
                    <p class="text-gray-600">Baca & tanggapi pertanyaan pelanggan</p>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-utensils text-purple-500 mr-3 mt-1"></i>
                <div>
                    <strong>Pesanan Makanan:</strong>
                    <p class="text-gray-600">Pantau & update status pesanan restoran</p>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-calendar-alt text-red-500 mr-3 mt-1"></i>
                <div>
                    <strong>Reservasi Acara:</strong>
                    <p class="text-gray-600">Kelola booking untuk wedding & event</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
