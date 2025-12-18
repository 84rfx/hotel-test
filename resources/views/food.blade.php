@extends('layouts.navigation')

@section('title', 'Pesan Makanan')

@section('content')
<div class="min-h-screen bg-purple-50">
    @auth
    <!-- Order History Section -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Riwayat Pesanan Makanan</h2>
                    <p class="text-sm text-gray-600">Lihat dan kelola pesanan makanan Anda</p>
                </div>
                <a href="{{ route('food-orders.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    Lihat Semua Pesanan
                </a>
            </div>
        </div>
    </div>
    @endauth

    <!-- Food Categories -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Menu Kami</h2>
            <p class="text-lg text-gray-600">Berbagai pilihan hidangan untuk memuaskan selera Anda</p>
        </div>

        <!-- Appetizers -->
        <div class="mb-16">
            <h3 class="text-2xl font-semibold text-gray-800 mb-8 text-center">🍲 Hidangan Pembuka</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400&h=300&fit=crop&crop=center" alt="French Fries" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">French Fries</h4>
                        <p class="text-gray-600 mb-4">Crispy golden fries served with ketchup</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 25.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'French Fries', 'price' => '25000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1608039755401-5131b62ad29b?w=400&h=300&fit=crop&crop=center" alt="Chicken Wings" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Chicken Wings</h4>
                        <p class="text-gray-600 mb-4">Spicy buffalo wings with blue cheese dip</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 30.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Chicken Wings', 'price' => '30000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1582169296194-e6d43bba9634?w=400&h=300&fit=crop&crop=center" alt="Nachos" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Nachos</h4>
                        <p class="text-gray-600 mb-4">Loaded nachos with cheese, jalapeños, and salsa</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 20.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Nachos', 'price' => '20000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Courses -->
        <div class="mb-16">
            <h3 class="text-2xl font-semibold text-gray-800 mb-8 text-center">🍖 Hidangan Utama</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400&h=300&fit=crop&crop=center" alt="Pizza" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Margherita Pizza</h4>
                        <p class="text-gray-600 mb-4">Classic pizza with tomato sauce, mozzarella, and basil</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 45.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Margherita Pizza', 'price' => '45000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=300&fit=crop&crop=center" alt="Burger" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Cheeseburger</h4>
                        <p class="text-gray-600 mb-4">Juicy beef patty with cheese, lettuce, and tomato</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 55.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Cheeseburger', 'price' => '55000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1621996346565-e3dbc353d2e5?w=400&h=300&fit=crop&crop=center" alt="Pasta" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Spaghetti Carbonara</h4>
                        <p class="text-gray-600 mb-4">Creamy pasta with bacon, eggs, and parmesan cheese</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 65.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Spaghetti Carbonara', 'price' => '65000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desserts -->
        <div class="mb-16">
            <h3 class="text-2xl font-semibold text-gray-800 mb-8 text-center">🍰 Hidangan Penutup</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&h=300&fit=crop&crop=center" alt="Chocolate Cake" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Chocolate Cake</h4>
                        <p class="text-gray-600 mb-4">Rich chocolate cake with chocolate ganache</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 35.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Chocolate Cake', 'price' => '35000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1567206563064-6f60f40a2b57?w=400&h=300&fit=crop&crop=center" alt="Ice Cream" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Vanilla Ice Cream</h4>
                        <p class="text-gray-600 mb-4">Premium vanilla ice cream with toppings</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 25.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Vanilla Ice Cream', 'price' => '25000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=400&h=300&fit=crop&crop=center" alt="Cheesecake" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Cheesecake</h4>
                        <p class="text-gray-600 mb-4">Creamy cheesecake with berry topping</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 30.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Cheesecake', 'price' => '30000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Beverages -->
        <div class="mb-16">
            <h3 class="text-2xl font-semibold text-gray-800 mb-8 text-center">🥤 Minuman</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=400&h=300&fit=crop&crop=center" alt="Cola" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Cola</h4>
                        <p class="text-gray-600 mb-4">Refreshing cola drink with ice</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 15.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Cola', 'price' => '15000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1621263764928-df1444c5e859?w=400&h=300&fit=crop&crop=center" alt="Lemonade" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Lemonade</h4>
                        <p class="text-gray-600 mb-4">Fresh lemonade with lemon slices</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 18.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Lemonade', 'price' => '18000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400&h=300&fit=crop&crop=center" alt="Orange Juice" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Orange Juice</h4>
                        <p class="text-gray-600 mb-4">Fresh orange juice without added sugar</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-orange-600">Rp 20.000</span>
                            <a href="{{ route('food-orders.create', ['item' => 'Orange Juice', 'price' => '20000']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-block text-center">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Siap Memesan?</h2>
            <p class="text-lg text-gray-600 mb-8">Hubungi kami untuk informasi lebih lanjut atau pesan langsung</p>
            <a href="{{ route('contact') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors duration-200">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection
