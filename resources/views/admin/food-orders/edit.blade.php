@extends('layouts.admin')

@section('title', 'Edit Pesanan Makanan')
@section('subtitle', 'Halaman untuk mengubah detail pesanan makanan.')

@section('content')

<div class="admin-breadcrumb mb-6">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span>
    <a href="{{ route('admin.food-orders.index') }}">Kelola Pesanan Makanan</a> <span>/</span>
    <span class="font-semibold text-gray-700">Edit Pesanan</span>
</div>

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Edit Pesanan Makanan 🍽️</h1>
        <p class="text-sm text-gray-500 mt-1">
            ID: <strong>{{ $foodOrder->id }}</strong> • Dibuat: <strong>{{ $foodOrder->created_at->format('d M Y') }}</strong>
        </p>
    </div>
    <a href="{{ route('admin.food-orders.index') }}" class="btn-admin">
        Kembali
    </a>
</div>

{{-- Menambahkan notifikasi success/error --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<form method="POST" action="{{ route('admin.food-orders.update', $foodOrder) }}" class="space-y-8">
    @csrf
    @method('PUT')

    {{-- Section: Order Status --}}
    <div class="mb-8 p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="flex items-center mb-6 border-b pb-4">
            <h3 class="text-xl font-semibold text-gray-900">Status Pesanan</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status Pesanan
                </label>
                <select name="status" id="status"
                        class="w-full px-3 py-2 border @error('status') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                    <option value="pending" {{ old('status', $foodOrder->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $foodOrder->status) == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="preparing" {{ old('status', $foodOrder->status) == 'preparing' ? 'selected' : '' }}>Sedang Dipersiapkan</option>
                    <option value="ready" {{ old('status', $foodOrder->status) == 'ready' ? 'selected' : '' }}>Siap Diantar</option>
                    <option value="delivered" {{ old('status', $foodOrder->status) == 'delivered' ? 'selected' : '' }}>Sudah Diantar</option>
                    <option value="cancelled" {{ old('status', $foodOrder->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="delivery_time" class="block text-sm font-medium text-gray-700 mb-2">
                    Waktu Pengiriman
                </label>
                <input type="datetime-local" name="delivery_time" id="delivery_time"
                        value="{{ old('delivery_time', $foodOrder->delivery_time ? \Carbon\Carbon::parse($foodOrder->delivery_time)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full px-3 py-2 border @error('delivery_time') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                @error('delivery_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <label for="special_instructions" class="block text-sm font-medium text-gray-700 mb-2">
                Instruksi Khusus
            </label>
            <textarea name="special_instructions" id="special_instructions" rows="3"
                    class="w-full px-3 py-2 border @error('special_instructions') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Tambahkan instruksi khusus untuk pesanan ini...">{{ old('special_instructions', $foodOrder->special_instructions) }}</textarea>
            @error('special_instructions')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Section: Order Details --}}
    <div class="mb-8 p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="flex items-center mb-6 border-b pb-4">
            <h3 class="text-xl font-semibold text-gray-900">Detail Pesanan</h3>
        </div>

        {{-- Order Details Table --}}
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Informasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Customer Information --}}
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">Nama Pelanggan</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $foodOrder->customer_name }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">Email Pelanggan</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $foodOrder->customer_email }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">Telepon Pelanggan</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $foodOrder->customer_phone }}</td>
                        </tr>

                        {{-- Order Summary --}}
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">Total Pembayaran</td>
                            <td class="px-6 py-4 text-sm font-bold text-green-600">Rp {{ number_format($foodOrder->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">Status Pesanan</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($foodOrder->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($foodOrder->status == 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($foodOrder->status == 'preparing') bg-orange-100 text-orange-800
                                    @elseif($foodOrder->status == 'ready') bg-green-100 text-green-800
                                    @elseif($foodOrder->status == 'delivered') bg-purple-100 text-purple-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($foodOrder->status) }}
                                </span>
                            </td>
                        </tr>

                        {{-- Order Items --}}
                        @if($foodOrder->items)
                            @foreach($foodOrder->items as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        Item {{ $index + 1 }}: {{ $item['name'] }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        Qty: <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $item['quantity'] }}</span>
                                        • Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        • Subtotal: Rp {{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Item Pesanan</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Tidak ada item pesanan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex items-center justify-between pt-6 border-t border-gray-200 mt-8">
        <a href="{{ route('admin.food-orders.index') }}"
        class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            Kembali
        </a>

        <button type="submit"
                class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Simpan Perubahan
        </button>
    </div>
</form>

@endsection
