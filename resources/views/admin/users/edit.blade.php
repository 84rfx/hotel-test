@extends('layouts.admin')

@section('title', 'Edit Pengguna')
@section('subtitle', 'Halaman untuk mengubah detail pengguna.')

@section('content')

<div class="admin-breadcrumb mb-6">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span>
    <a href="{{ route('admin.users.index') }}">Kelola Pengguna</a> <span>/</span>
    <span class="font-semibold text-gray-700">Edit Pengguna</span>
</div>

<div class="flex items-center justify-between mb-6">
    <div>
        {{-- Mengganti h2 dengan h1 agar sesuai dengan @section('title') --}}
        <h1 class="text-2xl font-bold text-gray-800">Edit Pengguna 👤</h1>
        <p class="text-sm text-gray-500 mt-1">
            ID: <strong>{{ $user->id }}</strong> • Dibuat: <strong>{{ $user->created_at->format('d M Y') }}</strong>
        </p>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn-admin">
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

{{-- Hapus div bg-white overflow-hidden shadow-xl sm:rounded-lg di sini.
     Karena ini sudah dibungkus oleh .page-content di admin.blade.php --}}
<form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-8">
    @csrf
    @method('PUT')

    {{-- Section: Basic Information --}}
    <div class="mb-8 p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="flex items-center mb-6 border-b pb-4">
            <h3 class="text-xl font-semibold text-gray-900">Informasi Dasar</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Section: Role & Access --}}
    <div class="mb-8 p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="flex items-center mb-6 border-b pb-4">
            <h3 class="text-xl font-semibold text-gray-900">Role & Akses</h3>
        </div>

        <div class="bg-gray-50 rounded-lg p-6">
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Role Pengguna
                </label>
                @php
                    // Cek apakah pengguna yang sedang di-edit adalah owner
                    $isOwner = $user->role === 'owner';
                    // Nonaktifkan jika dia adalah owner DAN pengguna yang sedang login adalah owner yang sama.
                    $isDisabled = Auth::id() === $user->id && $isOwner;
                @endphp

                <select name="role" id="role"
                        class="w-full md:w-1/2 px-3 py-2 border @error('role') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors {{ $isDisabled ? 'bg-gray-200 cursor-not-allowed' : '' }}"
                        required
                        {{ $isDisabled ? 'disabled' : '' }}
                >
                    <option value="user" @selected(old('role', $user->role) == 'user')>User</option>
                    <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                    <option value="owner" @selected(old('role', $user->role) == 'owner')>Owner</option>
                </select>

                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                @if ($isDisabled)
                    <p class="mt-2 text-sm text-yellow-700 bg-yellow-50 border border-yellow-200 p-3 rounded-lg">
                        ⚠️ Anda tidak dapat mengubah Role **Owner** ini karena Anda sedang mengedit profil Anda sendiri.
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- Section: Permissions (Jika menggunakan Spatie/Permission atau sejenisnya) --}}
    @if(isset($permissions) && $permissions->isNotEmpty())
    <div class="mb-8 p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="flex items-center mb-6 border-b pb-4">
            <h3 class="text-xl font-semibold text-gray-900">Permissions</h3>
        </div>

        <div class="bg-gray-50 rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($permissions as $module => $perms)
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                        <h4 class="font-bold text-sm text-gray-800 capitalize mb-3 flex items-center">
                            <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                            {{ $module }}
                        </h4>
                        <div class="space-y-2">
                            @foreach($perms as $permission)
                                <label class="flex items-center text-sm cursor-pointer">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            @checked(old('permissions') ? in_array($permission->id, old('permissions')) : $user->permissions->contains($permission->id))
                                            class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                    <span class="ml-2 text-gray-700">{{ str_replace(['_'], [' '], $permission->name) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            @error('permissions')
                <p class="mt-4 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    @endif

    {{-- Action Buttons --}}
    <div class="flex items-center justify-between pt-6 border-t border-gray-200 mt-8">
        <a href="{{ route('admin.users.index') }}"
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