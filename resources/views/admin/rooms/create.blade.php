<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kamar Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.rooms.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kamar</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Tipe Kamar</label>
                            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Pilih Tipe</option>
                                <option value="Standard" {{ old('type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                                <option value="Deluxe" {{ old('type') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                                <option value="Suite" {{ old('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                                <option value="Presidential" {{ old('type') == 'Presidential' ? 'selected' : '' }}>Presidential</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('capacity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price_per_night" class="block text-sm font-medium text-gray-700">Harga per Malam (Rp)</label>
                            <input type="number" name="price_per_night" id="price_per_night" value="{{ old('price_per_night') }}" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('price_per_night')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="available" class="flex items-center">
                                <input type="checkbox" name="available" id="available" value="1" {{ old('available', true) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm">
                                <span class="ml-2 text-sm text-gray-700">Tersedia</span>
                            </label>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">URL Gambar</label>
                            <input type="url" name="image" id="image" value="{{ old('image') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.rooms.index') }}" class="text-gray-600 hover:text-gray-900">Kembali</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Kamar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
