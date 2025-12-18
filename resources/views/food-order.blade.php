@extends('layouts.navigation')

@section('title', 'Pesan Makanan')

@section('content')
<div class="min-h-screen bg-purple-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Pesan Makanan</h1>
                <p class="text-lg text-gray-600">Lengkapi detail pesanan Anda</p>
            </div>

            <form action="{{ route('food-orders.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Item Details -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Detail Item</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Item</label>
                            <input type="text" name="item_name" value="{{ $item }}" readonly
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Item</label>
                            <input type="text" value="Rp {{ number_format($price, 0, ',', '.') }}" readonly
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                            <input type="hidden" name="price" value="{{ $price }}">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                        <input type="number" name="quantity" value="1" min="1" max="10"
                               class="w-full md:w-32 px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pelanggan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="customer_name" name="customer_name" value="{{ Auth::user()->name }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="customer_email" name="customer_email" value="{{ Auth::user()->email }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="customer_phone" name="customer_phone" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="room_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Kamar</label>
                            <input type="text" id="room_number" name="room_number" value="{{ $roomNumber }}" readonly
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                        </div>
                    </div>
                </div>

                <!-- Special Instructions -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Instruksi Khusus (Opsional)</h3>
                    <textarea name="special_instructions" rows="4" placeholder="Tambahkan instruksi khusus untuk pesanan Anda..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"></textarea>
                </div>

                <!-- Order Summary -->
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-700">{{ $item }}</span>
                            <span class="text-gray-700" id="item-price">Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Jumlah: <span id="quantity-display">1</span></span>
                            <span class="text-gray-700" id="subtotal">Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <hr class="border-orange-300">
                        <div class="flex justify-between text-lg font-semibold">
                            <span class="text-gray-900">Total</span>
                            <span class="text-orange-600" id="total">Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('food') }}" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                        Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.querySelector('input[name="quantity"]');
    const price = {{ $price }};
    const itemPriceDisplay = document.getElementById('item-price');
    const quantityDisplay = document.getElementById('quantity-display');
    const subtotalDisplay = document.getElementById('subtotal');
    const totalDisplay = document.getElementById('total');

    function updateTotals() {
        const quantity = parseInt(quantityInput.value) || 1;
        const subtotal = price * quantity;
        const total = subtotal;

        quantityDisplay.textContent = quantity;
        subtotalDisplay.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    quantityInput.addEventListener('input', updateTotals);
    updateTotals(); // Initial calculation
});
</script>
@endsection
