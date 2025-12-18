@extends('layouts.admin')

@section('title', 'Kelola Kamar')

@section('content')
<div class="admin-breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span>
    <a href="{{ route('admin.rooms.index') }}">Kelola Kamar</a>
</div>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Kelola Kamar</h2>
    <a href="{{ route('admin.rooms.create') }}" class="btn-admin">Tambah Kamar Baru</a>
</div>

@if(session('success'))
    <div class="alert-admin alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-admin alert-error">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border">
    <div class="overflow-x-auto">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Nama Kamar</th>
                    <th>Tipe</th>
                    <th>Kapasitas</th>
                    <th>Harga/Malam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                    <tr>
                        <td class="font-medium">{{ $room->name }}</td>
                        <td>{{ $room->type }}</td>
                        <td>{{ $room->capacity }} orang</td>
                        <td class="font-semibold text-green-600">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge {{ $room->available ? 'status-approved' : 'status-rejected' }}">
                                {{ $room->available ? 'Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="btn-admin btn-admin-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            <div class="text-4xl mb-2">🏨</div>
                            Belum ada kamar terdaftar
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t">
        {{ $rooms->links() }}
    </div>
</div>
@endsection
