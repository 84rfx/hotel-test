@extends('layouts.navigation')

@section('title', 'Riwayat Reservasi - Grand Bandung Hotel')

@section('content')
<div class="min-h-screen bg-purple-50">
    <!-- Reservations Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Riwayat Reservasi</h2>
            <p class="text-lg text-gray-600">Kelola dan lihat semua reservasi Anda</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-8">
                {{ session('success') }}
            </div>
        @endif

        @if($reservations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($reservations as $reservation)
                    <a href="{{ route('reservation.show', $reservation) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 block">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 text-white">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-bed text-2xl"></i>
                                    <div>
                                        <h4 class="text-xl font-semibold">{{ $reservation->room->name }}</h4>
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                                            @if($reservation->status === 'confirmed') bg-green-200 text-green-800
                                            @elseif($reservation->status === 'checked_in') bg-blue-200 text-blue-800
                                            @elseif($reservation->status === 'completed') bg-gray-200 text-gray-800
                                            @elseif($reservation->status === 'cancelled') bg-red-200 text-red-800
                                            @else bg-yellow-200 text-yellow-800 @endif">
                                            @if($reservation->status === 'checked_in')
                                                Sedang Menginap
                                            @elseif($reservation->status === 'completed')
                                                Selesai
                                            @else
                                                {{ ucfirst($reservation->status) }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-calendar-check text-blue-500 w-5 text-center"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Check-in</p>
                                        <p class="text-gray-900">{{ $reservation->check_in->format('d M Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-calendar-times text-blue-500 w-5 text-center"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Check-out</p>
                                        <p class="text-gray-900">{{ $reservation->check_out->format('d M Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-users text-blue-500 w-5 text-center"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Tamu</p>
                                        <p class="text-gray-900">{{ $reservation->guests }} orang</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-money-bill-wave text-blue-500 w-5 text-center"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Total</p>
                                        <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                @if($reservation->special_requests && is_array($reservation->special_requests))
                                    <div class="flex items-start space-x-3">
                                        <i class="fas fa-sticky-note text-blue-500 w-5 text-center mt-1"></i>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-500">Informasi Tamu</p>
                                            <div class="text-sm text-gray-900">
                                                @if(isset($reservation->special_requests['guest_name']))
                                                    <p>Nama: {{ $reservation->special_requests['guest_name'] }}</p>
                                                @endif
                                                @if(isset($reservation->special_requests['guest_email']))
                                                    <p>Email: {{ $reservation->special_requests['guest_email'] }}</p>
                                                @endif
                                                @if(isset($reservation->special_requests['guest_phone']))
                                                    <p>Telepon: {{ $reservation->special_requests['guest_phone'] }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex justify-end items-center pt-4 border-t border-gray-200">
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>
                                        Dibuat: {{ $reservation->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">📅</div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">Belum ada reservasi</h3>
                <p class="text-gray-600 mb-8">Anda belum memiliki reservasi apapun. Mulai buat reservasi pertama Anda!</p>
                <a href="{{ route('booking') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors duration-200 inline-block">
                    Buat Reservasi
                </a>
            </div>
        @endif
    </div>

    <!-- Call to Action -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Butuh Bantuan?</h2>
            <p class="text-lg text-gray-600 mb-8">Hubungi kami untuk informasi lebih lanjut tentang reservasi Anda</p>
            <a href="{{ route('contact') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors duration-200">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .reservations-section {
        padding: 2rem 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1e3c72;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .section-subtitle {
        font-size: 1.2rem;
        color: #6c757d;
        text-align: center;
        margin-bottom: 3rem;
    }

    .reservations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .reservation-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .reservation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .reservation-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .room-icon {
        font-size: 2rem;
        opacity: 0.9;
    }

    .header-content h3 {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .status {
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-confirmed {
        background: #d4edda;
        color: #155724;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .reservation-details {
        padding: 1.5rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .detail-item i {
        color: #667eea;
        width: 20px;
        text-align: center;
    }

    .detail-item strong {
        color: #1e3c72;
        display: block;
        font-size: 0.85rem;
        margin-bottom: 0.2rem;
    }

    .reservation-actions {
        padding: 1rem 1.5rem;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .reservation-date {
        color: #6c757d;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: #667eea;
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #5a67d8;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1.8rem;
        color: #1e3c72;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #6c757d;
        margin-bottom: 2rem;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        border: 1px solid #c3e6cb;
    }

    @media (max-width: 768px) {
        .reservations-grid {
            grid-template-columns: 1fr;
        }

        .reservation-header {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }

        .reservation-actions {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .section-title {
            font-size: 2rem;
        }
    }
</style>
@endpush
