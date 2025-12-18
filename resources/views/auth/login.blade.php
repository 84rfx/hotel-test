@extends('layouts.navigation')

@section('content')
<section class="auth-section">
    <div class="auth-container">
        <div class="auth-form">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h2>Selamat Datang Kembali</h2>
                <p>Masuk ke akun Grand Bandung Hotel Anda untuk pengalaman premium</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

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

            <form method="POST" action="{{ route('login') }}" class="form">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <div class="input-wrapper">
                        <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email Anda">
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
                        <input id="password" type="password" class="form-input" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember">
                        <span class="checkmark"></span>
                        Ingat saya
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk Sekarang
                    </button>
                </div>

                <div class="auth-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-link">
                            <i class="fas fa-key"></i>
                            Lupa password?
                        </a>
                    @endif
                    <a href="{{ route('register') }}" class="auth-link">
                        <i class="fas fa-user-plus"></i>
                        Belum punya akun? Daftar
                    </a>
                </div>
            </form>
        </div>

        <div class="auth-image">
            <div class="auth-image-content">
                <div class="welcome-icon">
                    <i class="fas fa-hotel"></i>
                </div>
                <h3>Temukan Kenyamanan Premium</h3>
                <p>Nikmati pengalaman menginap yang tak terlupakan di Grand Bandung Hotel dengan layanan eksklusif dan fasilitas bintang lima.</p>
                <div class="auth-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <span>WiFi Kecepatan Tinggi</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <span>Restoran Bintang Lima</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-swimming-pool"></i>
                        </div>
                        <span>Kolam Renang Infinity</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-spa"></i>
                        </div>
                        <span>Spa & Wellness Center</span>
                    </div>
                </div>
                <div class="auth-stats">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Kamar Mewah</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10k+</span>
                        <span class="stat-label">Tamu Puas</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5★</span>
                        <span class="stat-label">Rating Hotel</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById('password-icon');

    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// Initialize password icon
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('password-icon').className = 'fas fa-eye';
});
</script>
@endsection
