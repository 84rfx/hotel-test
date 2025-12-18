@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')

<div class="admin-breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span>
    <span class="font-semibold text-gray-700">Kelola Pengguna</span>
</div>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Kelola Pengguna 👤</h2>
    {{-- Menggunakan class umum untuk tombol admin --}}
    <a href="{{ route('admin.users.create') }}" class="btn-admin btn-primary">
        <i class="fas fa-user-plus mr-2"></i> Tambah Pengguna Baru
    </a>
</div>

{{-- Memastikan penggunaan komponen alert yang konsisten --}}
@if(session('success'))
    <div class="alert-admin alert-success mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-admin alert-error mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-xl border overflow-hidden">
    <div class="overflow-x-auto">
        <table class="table-admin w-full">
            <thead>
                <tr class="bg-gray-50 border-b">
                    {{-- Penambahan class text-left agar konsisten --}}
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Bergabung</th>
                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="font-medium px-4 py-3 text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex space-x-2 justify-center">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn-admin btn-secondary btn-sm">
                                    Edit
                                </a>
                                {{-- Tombol Hapus: Tidak boleh menghapus Owner dan dirinya sendiri --}}
                                @if(!$user->hasRole('owner') && Auth::user()->id !== $user->id)
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        {{-- Menggunakan class btn-danger untuk konsistensi --}}
                                        <button type="submit" class="btn-admin btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-12 text-gray-500 bg-gray-50">
                            <div class="text-4xl mb-3">😭</div>
                            <p class="text-lg font-medium">Belum ada pengguna terdaftar.</p>
                            <p class="text-sm">Klik 'Tambah Pengguna Baru' untuk memulai.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($users->lastPage() > 1)
        <div class="px-6 py-4 border-t bg-gray-50">
            {{ $users->links() }}
        </div>
    @endif
</div>

{{-- AJAX Script for Real-time Role Updates --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle role select changes
    document.querySelectorAll('.role-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const userId = this.getAttribute('data-user-id');
            const route = this.getAttribute('data-route');
            const newRole = this.value;
            const selectElement = this;

            // Check if user is trying to change their own role
            @if(Auth::user()->id == $user->id)
                if (!confirm('Anda akan mengubah role Anda sendiri. Lanjutkan?')) {
                    // Reset to original value
                    this.value = '{{ $user->hasRole('owner') ? 'owner' : ($user->hasRole('admin') ? 'admin' : 'user') }}';
                    return;
                }
            @endif

            // Show loading state
            selectElement.disabled = true;
            selectElement.style.opacity = '0.6';

            // Prepare form data
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PATCH');
            formData.append('role', newRole);

            // Make AJAX request
            fetch(route, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update permissions display
                    updatePermissionsDisplay(userId, data.user.permissions);

                    // Update select background color
                    updateRoleSelectStyling(selectElement, newRole);

                    // Show success message
                    showNotification(data.message, 'success');
                } else {
                    // Show error message
                    showNotification('Failed to update role', 'error');
                    // Reset select to original value
                    resetRoleSelect(selectElement);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred while updating role', 'error');
                resetRoleSelect(selectElement);
            })
            .finally(() => {
                // Remove loading state
                selectElement.disabled = false;
                selectElement.style.opacity = '1';
            });
        });
    });

    function updatePermissionsDisplay(userId, permissions) {
        // Find the permissions cell for this user
        const permissionsCell = document.querySelector(`select[data-user-id="${userId}"]`).closest('tr').querySelector('td:nth-child(4) .text-xs');

        if (permissionsCell) {
            // Update the badge text and styling
            let badgeClass = 'bg-gray-100 text-gray-800';
            if (permissions.includes('Akses Penuh')) {
                badgeClass = 'bg-green-100 text-green-800';
            } else if (permissions.includes('Kelola Admin')) {
                badgeClass = 'bg-blue-100 text-blue-800';
            }

            permissionsCell.innerHTML = `<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${badgeClass}">${permissions}</span>`;
        }
    }

    function updateRoleSelectStyling(selectElement, role) {
        // Remove existing background classes
        selectElement.classList.remove('bg-green-100', 'bg-blue-100');

        // Add appropriate background class
        if (role === 'owner') {
            selectElement.classList.add('bg-green-100');
        } else if (role === 'admin') {
            selectElement.classList.add('bg-blue-100');
        }
    }

    function resetRoleSelect(selectElement) {
        // Reset to the value that was selected before change
        const options = selectElement.querySelectorAll('option');
        options.forEach(option => {
            if (option.selected) {
                selectElement.value = option.value;
                return;
            }
        });
    }

    function showNotification(message, type) {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.ajax-notification');
        existingNotifications.forEach(notification => notification.remove());

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `ajax-notification alert-admin alert-${type === 'success' ? 'success' : 'error'} fixed top-4 right-4 z-50 max-w-sm`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                ${message}
            </div>
        `;

        // Add to page
        document.body.appendChild(notification);

        // Auto remove after 3 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 3000);
    }
});
</script>
@endsection
