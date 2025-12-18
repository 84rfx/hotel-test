@extends('layouts.navigation')

@section('title', 'Detail Pesanan Makanan #' . $foodOrder->id)

@section('content')
<div class="min-h-screen bg-purple-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Pesanan #{{ $foodOrder->id }}</h1>
                    <p class="text-lg text-gray-600">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        {{ $foodOrder->created_at->format('d M Y, H:i') }}
                    </p>
                </div>
                <a href="{{ route('food-orders.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Status -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Status Pesanan</h2>
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                            @if($foodOrder->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($foodOrder->status === 'confirmed') bg-blue-100 text-blue-800
                            @elseif($foodOrder->status === 'preparing') bg-orange-100 text-orange-800
                            @elseif($foodOrder->status === 'ready') bg-green-100 text-green-800
                            @elseif($foodOrder->status === 'delivered') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if($foodOrder->status === 'pending') Menunggu Konfirmasi
                            @elseif($foodOrder->status === 'confirmed') Dikonfirmasi
                            @elseif($foodOrder->status === 'preparing') Sedang Dipersiapkan
                            @elseif($foodOrder->status === 'ready') Siap Diantar
                            @elseif($foodOrder->status === 'delivered') Sudah Diantar
                            @else {{ ucfirst($foodOrder->status) }} @endif
                        </span>
                        @if($foodOrder->delivery_time)
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Estimasi Pengantaran</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $foodOrder->delivery_time->format('H:i') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Item</h2>
                    <div class="space-y-4">
                        @foreach($foodOrder->items as $item)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200 last:border-b-0">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $item['name'] }}</h3>
                                    <p class="text-gray-600">Jumlah: {{ $item['quantity'] }}</p>
                                    <p class="text-gray-600">Harga per item: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 mt-6 pt-4">
                        <div class="flex justify-between items-center text-xl font-bold">
                            <span class="text-gray-900">Total Pembayaran</span>
                            <span class="text-orange-600">Rp {{ number_format($foodOrder->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Special Instructions -->
                @if($foodOrder->special_instructions)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Instruksi Khusus</h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700">{{ $foodOrder->special_instructions }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Customer Information -->
            <div class="space-y-6">
                <!-- Customer Details -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pelanggan</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama</label>
                            <p class="text-gray-900">{{ $foodOrder->customer_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <p class="text-gray-900">{{ $foodOrder->customer_email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telepon</label>
                            <p class="text-gray-900">{{ $foodOrder->customer_phone }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
                            <p class="text-gray-900">{{ $foodOrder->room_number }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Timeline -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Timeline Pesanan</h2>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-green-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Pesanan Dibuat</p>
                                <p class="text-sm text-gray-600">{{ $foodOrder->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        @if($foodOrder->status !== 'pending')
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-clock text-blue-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Pesanan Dikonfirmasi</p>
                                    <p class="text-sm text-gray-600">{{ $foodOrder->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif

                        @if(in_array($foodOrder->status, ['preparing', 'ready', 'delivered']))
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-utensils text-orange-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Sedang Dipersiapkan</p>
                                    <p class="text-sm text-gray-600">{{ $foodOrder->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif

                        @if(in_array($foodOrder->status, ['ready', 'delivered']))
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check-circle text-green-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Siap Diantar</p>
                                    <p class="text-sm text-gray-600">{{ $foodOrder->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($foodOrder->status === 'delivered')
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-truck text-green-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Sudah Diantar</p>
                                    <p class="text-sm text-gray-600">{{ $foodOrder->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Aksi</h2>
                    <div class="space-y-3">
                        <a href="{{ route('food') }}"
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Pesan Lagi
                        </a>
                        <a href="tel:+1234567890"
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                            <i class="fas fa-phone mr-2"></i>
                            Hubungi Restoran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
