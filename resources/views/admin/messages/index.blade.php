@extends('layouts.admin')

@section('title', 'Kelola Pesan Masuk')

@section('content')
<div class="admin-breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span>
    <a href="{{ route('admin.messages.index') }}">Pesan Masuk</a>
</div>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Kelola Pesan Masuk</h2>
    <div class="text-sm text-gray-600">
        Total: {{ $messages->total() }} pesan
    </div>
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
                    <th>Pengirim</th>
                    <th>Subjek</th>
                    <th>Departemen</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="{{ !$message->read ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                        <td>
                            <div>
                                <div class="font-medium">
                                    {{ $message->name }}
                                    @if(!$message->read)
                                        <span class="inline-block w-2 h-2 bg-blue-500 rounded-full ml-2"></span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500">{{ $message->email }}</div>
                            </div>
                        </td>
                        <td class="font-medium">{{ $message->subject }}</td>
                        <td>
                            <span class="status-badge status-pending">
                                {{ $message->department }}
                            </span>
                        </td>
                        <td>
                            @if($message->read)
                                <span class="status-badge status-approved">
                                    <i class="fas fa-check mr-1"></i>Dibaca
                                </span>
                            @else
                                <span class="status-badge status-pending">
                                    <i class="fas fa-envelope mr-1"></i>Belum Dibaca
                                </span>
                            @endif
                        </td>
                        <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.messages.show', $message) }}" class="btn-admin btn-admin-sm">
                                    <i class="fas fa-eye mr-1"></i>Lihat
                                </a>
                                @if(!$message->read)
                                <form method="POST" action="{{ route('admin.messages.mark-read', $message) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-admin btn-admin-sm bg-green-600 hover:bg-green-700">
                                        <i class="fas fa-check mr-1"></i>Tandai Dibaca
                                    </button>
                                </form>
                                @endif
                                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-medium">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            <div class="text-4xl mb-2">💬</div>
                            Belum ada pesan masuk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t">
        {{ $messages->links() }}
    </div>
</div>
@endsection
