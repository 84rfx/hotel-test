@extends('layouts.navigation')

@section('title', 'Reservation Details - Grand Bandung Hotel')
@section('subtitle', 'Detail Reservasi Anda')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white py-16" style="margin-top: 80px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">📋 Detail Reservasi</h1>
            <p class="text-xl md:text-2xl mb-8">Lihat detail lengkap reservasi Anda</p>
            <p class="text-lg">Informasi lengkap tentang pemesanan kamar Anda</p>
        </div>
    </div>

    <!-- Reservation Details -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Room Header Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="md:flex">
                <div class="md:w-1/3">
                    @php
                        $roomTypeImages = [
                            'deluxe' => '/images/rooms/deluxe-room.jpg',
                            'suite' => '/images/rooms/suite-room.jpg',
                            'standard' => '/images/rooms/standard-room.jpg'
                        ];
                        $roomType = strtolower(explode(' ', $reservation->room->name)[0]);
                        $imageUrl = $roomTypeImages[$roomType] ?? ($reservation->room->image ? asset('images/rooms/' . $reservation->room->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&h=250&fit=crop&crop=center');
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $reservation->room->name }}" class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="md:w-2/3 p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2 md:mb-0">{{ $reservation->room->name }}</h2>
                        <div class="status-badge status-{{ $reservation->status }} inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold">
                            @if($reservation->status === 'checked_in')
                                <i class="fas fa-bed mr-2"></i> Sedang Menginap
                            @elseif($reservation->status === 'completed')
                                <i class="fas fa-check-circle mr-2"></i> Selesai
                            @elseif($reservation->status === 'confirmed')
                                <i class="fas fa-clock mr-2"></i> Dikonfirmasi
                            @elseif($reservation->status === 'pending')
                                <i class="fas fa-hourglass-half mr-2"></i> Menunggu
                            @else
                                <i class="fas fa-times-circle mr-2"></i> {{ ucfirst($reservation->status) }}
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 text-lg mb-6">{{ $reservation->room->description ?? 'Kamar nyaman dengan fasilitas lengkap untuk pengalaman menginap yang menyenangkan' }}</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <i class="fas fa-calendar-check text-orange-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-600">Check-in</p>
                            <p class="font-semibold text-gray-900">{{ $reservation->check_in->format('d M Y') }}</p>
                        </div>
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <i class="fas fa-calendar-times text-orange-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-600">Check-out</p>
                            <p class="font-semibold text-gray-900">{{ $reservation->check_out->format('d M Y') }}</p>
                        </div>
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <i class="fas fa-users text-orange-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-600">Tamu</p>
                            <p class="font-semibold text-gray-900">{{ $reservation->guests }} orang</p>
                        </div>
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <i class="fas fa-moon text-orange-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-600">Malam</p>
                            <p class="font-semibold text-gray-900">{{ $reservation->check_in->diffInDays($reservation->check_out) }} malam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Cost Breakdown -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-dollar-sign text-orange-500 mr-3"></i> Rincian Biaya
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-700">Kamar ({{ $reservation->check_in->diffInDays($reservation->check_out) }} malam)</span>
                        <span class="font-semibold text-gray-900">Rp {{ number_format($reservation->room->price_per_night * $reservation->check_in->diffInDays($reservation->check_out), 0, ',', '.') }}</span>
                    </div>

                    @if(isset($reservation->additional_services['breakfast']) && $reservation->additional_services['breakfast'])
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-700">Breakfast ({{ $reservation->guests }} tamu x {{ $reservation->check_in->diffInDays($reservation->check_out) }} malam)</span>
                        <span class="font-semibold text-gray-900">Rp {{ number_format(75000 * $reservation->guests * $reservation->check_in->diffInDays($reservation->check_out), 0, ',', '.') }}</span>
                    </div>
                    @endif

                    @if(isset($reservation->additional_services['spa']) && $reservation->additional_services['spa'])
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-700">Spa ({{ $reservation->guests }} tamu)</span>
                        <span class="font-semibold text-gray-900">Rp {{ number_format(250000 * $reservation->guests, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    @if(isset($reservation->additional_services['airport_transfer']) && $reservation->additional_services['airport_transfer'])
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-700">Airport Transfer</span>
                        <span class="font-semibold text-gray-900">Rp {{ number_format(150000, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between items-center py-4 border-t-2 border-orange-500 bg-orange-50 px-4 rounded-lg">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-xl font-bold text-orange-600">Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Status & Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-clock text-orange-500 mr-3"></i> Status & Aksi
                </h3>
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-700 font-medium">Status:</span>
                        <span class="font-semibold text-gray-900">
                            @if($reservation->status === 'checked_in')
                                Sedang Menginap
                            @elseif($reservation->status === 'completed')
                                Selesai
                            @else
                                {{ ucfirst($reservation->status) }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-700 font-medium">Dibuat:</span>
                        <span class="font-semibold text-gray-900">{{ $reservation->created_at->format('d M Y H:i') }}</span>
                    </div>
                    @if($reservation->updated_at != $reservation->created_at)
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-700 font-medium">Diupdate:</span>
                        <span class="font-semibold text-gray-900">{{ $reservation->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    @endif
                </div>



                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('reservations') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 text-center flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Reservasi
                    </a>
                    <a href="{{ route('home') }}" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 text-center flex items-center justify-center">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Guest Information -->
        @if($reservation->special_requests && is_array($reservation->special_requests))
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-sticky-note text-orange-500 mr-3"></i> Informasi Tamu
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(isset($reservation->special_requests['guest_name']))
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user text-gray-500 mr-2"></i>
                        <span class="text-sm text-gray-600 font-medium">Nama</span>
                    </div>
                    <p class="text-gray-900 font-semibold">{{ $reservation->special_requests['guest_name'] }}</p>
                </div>
                @endif
                @if(isset($reservation->special_requests['guest_email']))
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-envelope text-gray-500 mr-2"></i>
                        <span class="text-sm text-gray-600 font-medium">Email</span>
                    </div>
                    <p class="text-gray-900 font-semibold">{{ $reservation->special_requests['guest_email'] }}</p>
                </div>
                @endif
                @if(isset($reservation->special_requests['guest_phone']))
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-phone text-gray-500 mr-2"></i>
                        <span class="text-sm text-gray-600 font-medium">Telepon</span>
                    </div>
                    <p class="text-gray-900 font-semibold">{{ $reservation->special_requests['guest_phone'] }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Call to Action -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Butuh Bantuan?</h2>
            <p class="text-lg text-gray-600 mb-8">Hubungi kami jika Anda memiliki pertanyaan tentang reservasi Anda</p>
            <a href="{{ route('contact') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors duration-200">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>

<style>
.status-confirmed {
    background: #28a745;
    color: white;
}

.status-pending {
    background: #ffc107;
    color: #212529;
}

.status-cancelled {
    background: #dc3545;
    color: white;
}

.status-checked_in {
    background: #17a2b8;
    color: white;
}
</style>
@endsection
