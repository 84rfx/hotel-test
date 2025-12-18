<x-app-layout>
    {{-- PASTIKAN H2 INI BERADA DI DALAM X-SLOT HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pengguna Baru') }} ➕
        </h2>
    </x-slot>

    {{-- KONTEN UTAMA FORM BERADA DI DALAM DIV INI --}}
    <div class="py-12">
        {{-- KONTEN FORM ANDA HARUS BERADA DI SINI, DI DALAM CONTAINER DENGAN LATAR BELAKANG PUTIH --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        {{-- Section: Detail Akun --}}
                        <div class="mb-8 border-b pb-6">
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-xl font-semibold text-gray-900">Detail Akun</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Name --}}
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                        class="w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                        class="w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm" required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Section: Keamanan & Akses --}}
                        <div class="mb-8 border-b pb-6">
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0 w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-xl font-semibold text-gray-900">Keamanan & Akses</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {{-- Password --}}
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                    <input type="password" name="password" id="password" 
                                        class="w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors shadow-sm" required>
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Konfirmasi Password --}}
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                        class="w-full px-3 py-2 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors shadow-sm" required>
                                </div>
                                
                                {{-- Role --}}
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role Pengguna</label>
                                    <select name="role" id="role"
                                        class="w-full px-3 py-2 border @error('role') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors shadow-sm"
                                        required>
                                        <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                                        <option value="user" @selected(old('role', 'user') == 'user')>User</option>
                                        <option value="owner" @selected(old('role') == 'owner')>Owner</option>
                                    </select>
                                    @error('role')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Permissions Section (dihilangkan untuk meringkas) --}}

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200 mt-8">
                            <a href="{{ route('admin.users.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>