@extends('layouts.admin')

@section('title', 'Detail Reservasi Kamar')

@section('content')
<div class="admin-breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span>
    <a href="{{ route('admin.reservations.index') }}">Reservasi Kamar</a> <span>/</span>
    <span>Detail</span>
</div>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Detail Reservasi Kamar</h2>
    <a href="{{ route('admin.reservations.index') }}" class="btn-admin btn-admin-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

@if(session('success'))
    <div class="alert-admin alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Reservation Details -->
    <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Informasi Reservasi</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600">ID Reservasi:</span>
                <span class="font-medium">#{{ $reservation->id }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Status:</span>
                <span class="status-badge
                    @if($reservation->status == 'pending') status-pending
                    @elseif($reservation->status == 'confirmed') status-approved
                    @elseif($reservation->status == 'checked_in') status-approved
                    @elseif($reservation->status == 'completed') status-approved
                    @else status-rejected
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Check-in:</span>
                <span class="font-medium">{{ $reservation->check_in->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Check-out:</span>
                <span class="font-medium">{{ $reservation->check_out->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Durasi:</span>
                <span class="font-medium">{{ $reservation->check_in->diffInDays($reservation->check_out) }} malam</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Total Pembayaran:</span>
                <span class="font-semibold text-green-600">Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Dibuat:</span>
                <span class="font-medium">{{ $reservation->created_at->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>

    <!-- Customer Information -->
    <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Informasi Pelanggan</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600">Nama:</span>
                <span class="font-medium">{{ $reservation->user->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Email:</span>
                <span class="font-medium">{{ $reservation->user->email }}</span>
            </div>
            @if($reservation->special_requests && isset($reservation->special_requests['guest_phone']))
                <div class="flex justify-between">
                    <span class="text-gray-600">No. Telepon:</span>
                    <span class="font-medium">{{ $reservation->special_requests['guest_phone'] ?? '-' }}</span>
                </div>
            @endif
            @if($reservation->special_requests && isset($reservation->special_requests['guest_address']))
                <div class="flex justify-between">
                    <span class="text-gray-600">Alamat:</span>
                    <span class="font-medium">{{ $reservation->special_requests['guest_address'] ?? '-' }}</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Room Information -->
    <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Informasi Kamar</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600">Nama Kamar:</span>
                <span class="font-medium">{{ $reservation->room->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Tipe:</span>
                <span class="font-medium">{{ $reservation->room->type }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Kapasitas:</span>
                <span class="font-medium">{{ $reservation->room->capacity }} orang</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Harga per Malam:</span>
                <span class="font-medium">Rp {{ number_format($reservation->room->price_per_night, 0, ',', '.') }}</span>
            </div>
            @if($reservation->room->amenities)
                <div>
                    <span class="text-gray-600">Fasilitas:</span>
                    <div class="mt-1">
                        @foreach($reservation->room->amenities as $amenity)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">{{ $amenity }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Personal Documents -->
    <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Dokumen Pribadi</h3>
        <div class="space-y-3">
            @if($reservation->personalData->count() > 0)
                @foreach($reservation->personalData as $document)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <span class="text-2xl">
                                @if($document->file_type == 'id_card')
                                    🆔
                                @else
                                    📄
                                @endif
                            </span>
                            <div>
                                <p class="font-medium text-gray-800">
                                    @if($document->file_type == 'id_card')
                                        Kartu Identitas (KTP)
                                    @else
                                        {{ ucfirst(str_replace('_', ' ', $document->file_type)) }}
                                    @endif
                                </p>
                                <p class="text-sm text-gray-600">{{ $document->original_name }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.personal-data.view', $document) }}"
                               target="_blank"
                               class="btn-admin btn-admin-sm bg-blue-500 hover:bg-blue-600">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">Tidak ada dokumen yang diupload</p>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white rounded-lg shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Aksi</h3>
        <div class="space-y-3">
            <form method="POST" action="{{ route('admin.reservations.update-status', $reservation) }}">
                @csrf
                @method('PATCH')
                <div class="flex items-center space-x-3">
                    <select name="status" class="form-control text-sm">
                        <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="checked_in" {{ $reservation->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                        <option value="checked_out" {{ $reservation->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                        <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn-admin btn-admin-sm">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
