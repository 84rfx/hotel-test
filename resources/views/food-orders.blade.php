@extends('layouts.navigation')

@section('title', 'Riwayat Pesanan Makanan')

@section('content')
<div class="min-h-screen bg-purple-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Riwayat Pesanan Makanan</h1>
            <p class="text-lg text-gray-600">Lihat semua pesanan makanan Anda</p>
        </div>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                        Pesanan #{{ $order->id }}
                                    </h3>
                                    <p class="text-gray-600">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>
                                    <p class="text-gray-600">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        Kamar {{ $order->room_number }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'preparing') bg-orange-100 text-orange-800
                                        @elseif($order->status === 'ready') bg-green-100 text-green-800
                                        @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        @if($order->status === 'pending') Menunggu Konfirmasi
                                        @elseif($order->status === 'confirmed') Dikonfirmasi
                                        @elseif($order->status === 'preparing') Sedang Dipersiapkan
                                        @elseif($order->status === 'ready') Siap Diantar
                                        @elseif($order->status === 'delivered') Sudah Diantar
                                        @else {{ ucfirst($order->status) }} @endif
                                    </span>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4">
                                <h4 class="text-lg font-medium text-gray-900 mb-3">Detail Pesanan</h4>
                                <div class="space-y-2">
                                    @foreach($order->items as $item)
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span class="font-medium text-gray-900">{{ $item['name'] }}</span>
                                                <span class="text-gray-600 ml-2">x{{ $item['quantity'] }}</span>
                                            </div>
                                            <span class="text-gray-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="border-t border-gray-200 mt-4 pt-4">
                                    <div class="flex justify-between items-center text-lg font-semibold">
                                        <span class="text-gray-900">Total</span>
                                        <span class="text-orange-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                @if($order->special_instructions)
                                    <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                        <h5 class="text-sm font-medium text-gray-900 mb-1">Instruksi Khusus:</h5>
                                        <p class="text-sm text-gray-600">{{ $order->special_instructions }}</p>
                                    </div>
                                @endif

                                @if($order->delivery_time)
                                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-800">
                                            <i class="fas fa-clock mr-2"></i>
                                            Estimasi pengantaran: {{ $order->delivery_time->format('H:i') }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('food-orders.show', $order) }}"
                                   class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="mb-4">
                    <i class="fas fa-utensils text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada pesanan</h3>
                <p class="text-gray-600 mb-6">Anda belum membuat pesanan makanan apapun.</p>
                <a href="{{ route('food') }}"
                   class="inline-flex items-center px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Pesan Makanan Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
