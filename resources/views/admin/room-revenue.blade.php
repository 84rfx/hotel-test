@extends('layouts.admin')

@section('title', 'Laporan Pemasukan Kamar')
@section('subtitle', 'Pantau dan ekspor data pemasukan kamar hotel')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span> <span>Laporan Pemasukan Kamar</span>
</div>

<!-- Export Button -->
<div class="mb-6">
    <a href="{{ route('admin.revenue.export') }}" class="btn-admin btn-admin-primary">
        <i class="fas fa-download mr-2"></i> Ekspor ke Spreadsheet (CSV)
    </a>
</div>

<!-- Total Room Revenue Card -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="stats-card">
        <i class="fas fa-bed text-blue-500 icon"></i>
        <h4>Total Pemasukan Kamar</h4>
        <div class="number">Rp {{ number_format($reservationRevenue, 0, ',', '.') }}</div>
        <div class="subtitle">Dari semua reservasi kamar</div>
    </div>

    <div class="stats-card">
        <i class="fas fa-calendar-alt text-green-500 icon"></i>
        <h4>Pemasukan Bulan Ini</h4>
        <div class="number">Rp {{ number_format(collect($monthlyRevenue)->last() ?? 0, 0, ',', '.') }}</div>
        <div class="subtitle">Bulan berjalan</div>
    </div>

    <div class="stats-card">
        <i class="fas fa-chart-line text-purple-500 icon"></i>
        <h4>Rata-rata Bulanan</h4>
        <div class="number">Rp {{ number_format(collect($monthlyRevenue)->avg() ?? 0, 0, ',', '.') }}</div>
        <div class="subtitle">12 bulan terakhir</div>
    </div>
</div>

<!-- Monthly Revenue Chart -->
<div class="stats-card mb-8">
    <h4 class="mb-6 flex items-center">
        <i class="fas fa-chart-line text-blue-500 mr-2"></i>
        Pemasukan Kamar Bulanan (12 Bulan Terakhir)
    </h4>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemasukan Kamar</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($monthlyRevenue as $month => $revenue)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $month }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($revenue, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Revenue Information -->
<div class="stats-card">
    <h4 class="mb-4 flex items-center">
        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
        Informasi Pemasukan Kamar
    </h4>
    <div class="text-sm text-gray-600 space-y-3">
        <p><i class="fas fa-bed text-blue-500 mr-2"></i> Data pemasukan dihitung berdasarkan reservasi kamar yang telah dikonfirmasi, check-in, atau check-out</p>
        <p><i class="fas fa-calculator text-green-500 mr-2"></i> Perhitungan menggunakan jumlah malam menginap dikalikan harga per malam</p>
        <p><i class="fas fa-calendar text-purple-500 mr-2"></i> Data bulanan mencakup 12 bulan terakhir dari tanggal saat ini</p>
        <p><i class="fas fa-download text-red-500 mr-2"></i> Tombol ekspor di atas akan mengunduh data gabungan semua pemasukan</p>
    </div>
</div>
@endsection
