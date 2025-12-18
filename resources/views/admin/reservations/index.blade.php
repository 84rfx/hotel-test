@extends('layouts.admin')

@section('title', 'Kelola Reservasi Kamar')

@section('content')
<div class="admin-breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span>
    <a href="{{ route('admin.reservations.index') }}">Reservasi Kamar</a>
</div>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Kelola Reservasi Kamar</h2>
    <div class="text-sm text-gray-600">
        Total: {{ $reservations->total() }} reservasi
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
                    <th>Pelanggan</th>
                    <th>Kamar</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td>
                            <div>
                                <div class="font-medium">{{ $reservation->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $reservation->user->email }}</div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="font-medium">{{ $reservation->room->name }}</div>
                                <div class="text-sm text-gray-500">{{ $reservation->room->type }}</div>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('d M Y') }}</td>
                        <td class="font-semibold text-green-600">Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge
                                @if($reservation->status == 'pending') status-pending
                                @elseif($reservation->status == 'confirmed') status-approved
                                @elseif($reservation->status == 'checked_in') status-approved
                                @elseif($reservation->status == 'checked_out') status-approved
                                @else status-rejected
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                            </span>
                        </td>
                        <td>
                            @if($reservation->personalData->count() > 0)
                                <div class="flex items-center space-x-1">
                                    @foreach($reservation->personalData as $document)
                                        @if($document->file_type == 'id_card')
                                            <button onclick="viewDocument('{{ Storage::url($document->file_path) }}', '{{ $document->original_name }}')"
                                                    class="btn-admin btn-admin-sm bg-blue-500 hover:bg-blue-600">
                                                <i class="fas fa-id-card"></i> KTP
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">Belum upload</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn-admin btn-admin-sm">Detail</a>
                                <form method="POST" action="{{ route('admin.reservations.update-status', $reservation) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="text-xs px-2 py-1 border rounded">
                                        <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="checked_in" {{ $reservation->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                        <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-500">
                            <div class="text-4xl mb-2">🏨</div>
                            Belum ada reservasi kamar
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t">
        {{ $reservations->links('vendor.pagination.simple-admin') }}
    </div>
</div>

<!-- Modal untuk melihat dokumen -->
<div id="documentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Lihat Dokumen</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
            <div class="mt-2">
                <div id="documentContent" class="flex justify-center">
                    <!-- Konten dokumen akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function viewDocument(url, filename) {
    const modal = document.getElementById('documentModal');
    const modalTitle = document.getElementById('modalTitle');
    const documentContent = document.getElementById('documentContent');

    modalTitle.textContent = 'Lihat Dokumen: ' + filename;

    // Cek tipe file berdasarkan ekstensi
    const fileExtension = filename.split('.').pop().toLowerCase();

    if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileExtension)) {
        // Untuk gambar
        documentContent.innerHTML = `<img src="${url}" alt="${filename}" class="max-w-full max-h-96 object-contain">`;
    } else if (fileExtension === 'pdf') {
        // Untuk PDF
        documentContent.innerHTML = `<iframe src="${url}" width="100%" height="500px" frameborder="0"></iframe>`;
    } else {
        // Untuk file lain, tampilkan link download
        documentContent.innerHTML = `
            <div class="text-center">
                <p class="mb-4">File ini tidak dapat dipreview. Klik tombol di bawah untuk mengunduh.</p>
                <a href="${url}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-download"></i> Unduh ${filename}
                </a>
            </div>
        `;
    }

    modal.classList.remove('hidden');
}

function closeModal() {
    const modal = document.getElementById('documentModal');
    modal.classList.add('hidden');
}

// Tutup modal saat klik di luar modal
document.getElementById('documentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection
