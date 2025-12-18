@extends('layouts.admin')

@section('title', 'Laporan Pemasukan')
@section('subtitle', 'Pantau dan ekspor data pemasukan hotel')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span> <span>Laporan Pemasukan</span>
</div>

<!-- Export Button -->
<div class="mb-6">
    <a href="{{ route('admin.revenue.export') }}" class="btn-admin btn-admin-primary">
        <i class="fas fa-download mr-2"></i> Ekspor ke Spreadsheet (CSV)
    </a>
</div>

<!-- Total Revenue Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="stats-card">
        <i class="fas fa-money-bill-wave text-green-500 icon"></i>
        <h4>Total Pemasukan</h4>
        <div class="number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        <div class="subtitle">Keseluruhan</div>
    </div>

    <div class="stats-card">
        <i class="fas fa-bed text-blue-500 icon"></i>
        <h4>Pemasukan Kamar</h4>
        <div class="number">Rp {{ number_format($reservationRevenue, 0, ',', '.') }}</div>
        <div class="subtitle">Dari reservasi</div>
    </div>

    <div class="stats-card">
        <i class="fas fa-utensils text-purple-500 icon"></i>
        <h4>Pemasukan Makanan</h4>
        <div class="number">Rp {{ number_format($foodOrderRevenue, 0, ',', '.') }}</div>
        <div class="subtitle">Dari pesanan makanan</div>
    </div>

    <div class="stats-card">
        <i class="fas fa-calendar-alt text-red-500 icon"></i>
        <h4>Pemasukan Acara</h4>
        <div class="number">Rp {{ number_format($eventReservationRevenue, 0, ',', '.') }}</div>
        <div class="subtitle">Dari reservasi acara</div>
    </div>
</div>

<!-- Monthly Revenue Chart -->
<div class="stats-card mb-8">
    <h4 class="mb-6 flex items-center">
        <i class="fas fa-chart-line text-blue-500 mr-2"></i>
        Pemasukan Bulanan (12 Bulan Terakhir)
    </h4>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemasukan</th>
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

<!-- Revenue Breakdown -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="stats-card">
        <h4 class="mb-4 flex items-center">
            <i class="fas fa-chart-pie text-green-500 mr-2"></i>
            Breakdown Pemasukan
        </h4>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium">Reservasi Kamar</span>
                <div class="flex items-center">
                    <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $totalRevenue > 0 ? ($reservationRevenue / $totalRevenue) * 100 : 0 }}%"></div>
                    </div>
                    <span class="text-sm text-gray-600">{{ $totalRevenue > 0 ? round(($reservationRevenue / $totalRevenue) * 100, 1) : 0 }}%</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium">Pesanan Makanan</span>
                <div class="flex items-center">
                    <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $totalRevenue > 0 ? ($foodOrderRevenue / $totalRevenue) * 100 : 0 }}%"></div>
                    </div>
                    <span class="text-sm text-gray-600">{{ $totalRevenue > 0 ? round(($foodOrderRevenue / $totalRevenue) * 100, 1) : 0 }}%</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium">Reservasi Acara</span>
                <div class="flex items-center">
                    <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                        <div class="bg-red-500 h-2 rounded-full" style="width: {{ $totalRevenue > 0 ? ($eventReservationRevenue / $totalRevenue) * 100 : 0 }}%"></div>
                    </div>
                    <span class="text-sm text-gray-600">{{ $totalRevenue > 0 ? round(($eventReservationRevenue / $totalRevenue) * 100, 1) : 0 }}%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-card">
        <h4 class="mb-4 flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
            Informasi Ekspor
        </h4>
        <div class="text-sm text-gray-600 space-y-3">
            <p><i class="fas fa-file-csv text-green-500 mr-2"></i> File CSV dapat dibuka dengan Excel, Google Sheets, atau aplikasi spreadsheet lainnya</p>
            <p><i class="fas fa-calendar text-blue-500 mr-2"></i> Data ekspor mencakup pemasukan bulanan 12 bulan terakhir</p>
            <p><i class="fas fa-chart-bar text-purple-500 mr-2"></i> Termasuk breakdown per kategori pemasukan</p>
            <p><i class="fas fa-download text-red-500 mr-2"></i> Klik tombol ekspor di atas untuk mengunduh file</p>
        </div>
    </div>
</div>
@endsection
