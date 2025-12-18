<div class="profile-form-section">
    <h3>
        <i class="fas fa-trash-alt"></i>
        Hapus Akun
    </h3>

    <p class="section-description">
        Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun Anda, silakan unduh data atau informasi apa pun yang ingin Anda simpan.
    </p>

    <div class="form-actions">
        {{-- Pastikan Alpine.js (x-data dan x-on) dimuat di layout utama agar ini berfungsi --}}
        <button type="button" class="btn-danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            <i class="fas fa-trash-alt"></i>
            Hapus Akun
        </button>
    </div>
</div>

{{-- Modal for account deletion confirmation (Perlu Alpine.js) --}}
<div class="modal-overlay" x-data="{ open: false }" x-show="open" x-cloak
    x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') { open = true }"
    x-on:close-modal.window="open = false"
    x-on:keydown.escape.window="open = false"
>
    <div class="modal-content" x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
        <div class="modal-header">
            <h3>Apakah Anda yakin ingin menghapus akun Anda?</h3>
        </div>
        <div class="modal-body">
            <p>Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.</p>

            <form method="post" action="{{ route('profile.destroy') }}" class="profile-form">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-key"></i>
                        Kata Sandi
                    </label>
                    <input id="password" name="password" type="password" class="form-input" placeholder="Masukkan kata sandi Anda" />
                    {{-- Error handling yang lebih baik harusnya mengecek $errors->has('password') pada konteks modal --}}
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" x-on:click="open = false">
                        <i class="fas fa-times"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn-danger">
                        <i class="fas fa-trash-alt"></i>
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>