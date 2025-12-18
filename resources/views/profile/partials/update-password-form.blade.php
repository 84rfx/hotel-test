<div class="profile-form-section">
    <h3>
        <i class="fas fa-lock"></i>
        Ubah Kata Sandi
    </h3>

    <p class="section-description">
        Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.
    </p>

    <form method="post" action="{{ route('password.update') }}" class="profile-form">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" class="form-label">
                <i class="fas fa-key"></i>
                Kata Sandi Saat Ini
            </label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-input" autocomplete="current-password" />
            @error('current_password')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password" class="form-label">
                <i class="fas fa-key"></i>
                Kata Sandi Baru
            </label>
            <input id="update_password_password" name="password" type="password" class="form-input" autocomplete="new-password" />
            @error('password')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation" class="form-label">
                <i class="fas fa-key"></i>
                Konfirmasi Kata Sandi
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password" />
            @error('password_confirmation')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                Simpan
            </button>

            @if (session('status') === 'password-updated')
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    Kata sandi berhasil diperbarui.
                </div>
            @endif
        </div>
    </form>
</div>