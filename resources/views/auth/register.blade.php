@extends('layouts.navigation')

@section('content')
<section class="auth-section">
    <div class="auth-container">
        <div class="auth-form">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2>Bergabunglah Dengan Kami</h2>
                <p>Buat akun Grand Bandung Hotel untuk pengalaman menginap premium</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="form">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-user"></i>
                        Nama Lengkap
                    </label>
                    <div class="input-wrapper">
                        <input id="name" type="text" class="form-input" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda">
                        <i class="fas fa-user input-icon"></i>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <div class="input-wrapper">
                        <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Masukkan email Anda">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <div class="input-wrapper">
                        <input id="password" type="password" class="form-input" name="password" required autocomplete="new-password" placeholder="Buat password yang kuat" oninput="checkPasswordStrength()">
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                    <div id="password-strength" class="password-strength"></div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock"></i>
                        Konfirmasi Password
                    </label>
                    <div class="input-wrapper">
                        <input id="password_confirmation" type="password" class="form-input" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password Anda" oninput="checkPasswordMatch()">
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye" id="confirm-password-icon"></i>
                        </button>
                    </div>
                    <div id="password-match" class="password-match"></div>
                </div>

                <!-- Security Question -->
                <div class="form-group">
                    <label for="security_question" class="form-label">
                        <i class="fas fa-question-circle"></i>
                        Pertanyaan Keamanan
                    </label>
                    <div class="input-wrapper">
                        <select id="security_question" name="security_question" class="form-input" required>
                            <option value="">Pilih pertanyaan keamanan</option>
                            <option value="Apa nama hewan peliharaan pertama Anda?">Apa nama hewan peliharaan pertama Anda?</option>
                            <option value="Di kota mana Anda lahir?">Di kota mana Anda lahir?</option>
                            <option value="Apa nama sekolah dasar Anda?">Apa nama sekolah dasar Anda?</option>
                            <option value="Siapa nama ibu Anda?">Siapa nama ibu Anda?</option>
                            <option value="Apa makanan favorit Anda?">Apa makanan favorit Anda?</option>
                        </select>
                        <i class="fas fa-chevron-down input-icon"></i>
                    </div>
                    @error('security_question')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Security Answer -->
                <div class="form-group">
                    <label for="security_answer" class="form-label">
                        <i class="fas fa-key"></i>
                        Jawaban Pertanyaan Keamanan
                    </label>
                    <div class="input-wrapper">
                        <input id="security_answer" type="text" class="form-input" name="security_answer" required placeholder="Masukkan jawaban Anda" autocomplete="off">
                        <i class="fas fa-key input-icon"></i>
                    </div>
                    @error('security_answer')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Jawaban ini akan digunakan untuk mereset password jika lupa</p>
                </div>

                <!-- Mewscaptcha -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-shield-alt"></i>
                        Verifikasi Keamanan
                    </label>
                    <div class="input-wrapper">
                        <div class="captcha-container">
                            {!! Captcha::img() !!}
                            <input id="captcha" type="text" class="form-input captcha-input" name="captcha" required placeholder="Masukkan kode captcha">
                            <button type="button" class="captcha-refresh" onclick="refreshCaptcha()" title="Refresh Captcha">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    @error('captcha')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-user-plus"></i>
                        Buat Akun Sekarang
                    </button>
                </div>

                <div class="auth-links">
                    <a href="{{ route('login') }}" class="auth-link">
                        <i class="fas fa-sign-in-alt"></i>
                        Sudah punya akun? Masuk
                    </a>
                </div>
            </form>
        </div>

        <div class="auth-image">
            <div class="auth-image-content">
                <div class="welcome-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <h3>Keanggotaan Premium Menanti</h3>
                <p>Bergabunglah dengan komunitas eksklusif kami dan nikmati berbagai keuntungan istimewa sebagai member Grand Bandung Hotel.</p>
                <div class="auth-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <span>Diskon 15%</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <span>Upgrade Kamar Gratis</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <span>Check-in Prioritas</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <span>Kado Ulang Tahun</span>
                    </div>
                </div>
                <div class="auth-stats">
                    <div class="stat-item">
                        <span class="stat-number">50k+</span>
                        <span class="stat-label">Member Aktif</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4.9★</span>
                        <span class="stat-label">Rating Member</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Dukungan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId === 'password' ? 'password-icon' : 'confirm-password-icon');

    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthIndicator = document.getElementById('password-strength');
    let strength = 0;
    let feedback = [];

    if (password.length >= 8) strength++;
    else feedback.push('Minimal 8 karakter');

    if (/[a-z]/.test(password)) strength++;
    else feedback.push('Huruf kecil');

    if (/[A-Z]/.test(password)) strength++;
    else feedback.push('Huruf besar');

    if (/[0-9]/.test(password)) strength++;
    else feedback.push('Angka');

    if (/[^A-Za-z0-9]/.test(password)) strength++;
    else feedback.push('Karakter khusus');

    let strengthText = '';
    let strengthClass = '';

    switch(strength) {
        case 0:
        case 1:
            strengthText = 'Sangat Lemah';
            strengthClass = 'strength-weak';
            break;
        case 2:
            strengthText = 'Lemah';
            strengthClass = 'strength-weak';
            break;
        case 3:
            strengthText = 'Sedang';
            strengthClass = 'strength-medium';
            break;
        case 4:
            strengthText = 'Kuat';
            strengthClass = 'strength-strong';
            break;
        case 5:
            strengthText = 'Sangat Kuat';
            strengthClass = 'strength-very-strong';
            break;
    }

    strengthIndicator.innerHTML = `<span class="${strengthClass}">${strengthText}</span>`;
    if (feedback.length > 0 && strength < 4) {
        strengthIndicator.innerHTML += ` - Tambahkan: ${feedback.join(', ')}`;
    }
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const matchIndicator = document.getElementById('password-match');

    if (confirmPassword === '') {
        matchIndicator.innerHTML = '';
        return;
    }

    if (password === confirmPassword) {
        matchIndicator.innerHTML = '<span class="match-success">✓ Password cocok</span>';
    } else {
        matchIndicator.innerHTML = '<span class="match-error">✗ Password tidak cocok</span>';
    }
}

function refreshCaptcha() {
    const captchaImg = document.querySelector('.captcha-container img');
    if (captchaImg) {
        const src = captchaImg.src;
        captchaImg.src = src + (src.includes('?') ? '&' : '?') + 't=' + new Date().getTime();
    }
}

// Initialize password icons
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('password-icon').className = 'fas fa-eye';
    document.getElementById('confirm-password-icon').className = 'fas fa-eye';
});
</script>
@endsection
