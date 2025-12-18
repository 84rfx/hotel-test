@extends('layouts.navigation')

@section('content')
<section class="page-header">
    <div class="page-header-content">
        <h1>Reservasi Kamar</h1>
        <p>Pesan kamar impian Anda sekarang</p>
    </div>
</section>

<section class="booking-section">
    <div class="booking-container">
        <!-- Success Notification -->
        @if(session('success'))
            <div class="notification notification-success" id="success-notification">
                <div class="notification-content">
                    <span class="notification-icon">✅</span>
                    <div class="notification-text">
                        <h4>Reservasi Berhasil!</h4>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button class="notification-close" onclick="closeNotification()">&times;</button>
                </div>
            </div>
        @endif

        <div class="booking-form-section">
            <h2>Detail Reservasi</h2>
            <form method="POST" action="{{ route('booking.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-section">
                    <h3>👤 Informasi Tamu</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guests">Jumlah Tamu</label>
                            <select id="guests" name="guests" required>
                                <option value="">Pilih Jumlah Tamu</option>
                                <option value="1" {{ old('guests') == '1' ? 'selected' : '' }}>1 Tamu</option>
                                <option value="2" {{ old('guests') == '2' ? 'selected' : '' }}>2 Tamu</option>
                                <option value="3" {{ old('guests') == '3' ? 'selected' : '' }}>3 Tamu</option>
                                <option value="4" {{ old('guests') == '4' ? 'selected' : '' }}>4 Tamu</option>
                            </select>
                            @error('guests')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>📅 Tanggal Menginap</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="check_in">Check-in</label>
                            <input type="date" id="check_in" name="check_in" value="{{ old('check_in') }}" required>
                            @error('check_in')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="check_out">Check-out</label>
                            <input type="date" id="check_out" name="check_out" value="{{ old('check_out') }}" required>
                            @error('check_out')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="night-info">
                        <strong>Total Malam: <span id="total-nights">0</span> malam</strong>
                    </div>
                </div>

                <div class="form-section">
                    <h3>🏨 Pilih Kamar</h3>
                    <div class="form-group">
                        <label for="room_type">Tipe Kamar</label>
                        <select id="room_type" name="room_type" required>
                            <option value="">Pilih Tipe Kamar</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}"
                                        data-price="{{ $room->price_per_night }}"
                                        data-name="{{ $room->name }}"
                                        data-description="{{ $room->description }}"
                                        data-image="{{ $room->image }}"
                                        data-amenities="{{ json_encode($room->amenities) }}"
                                        data-capacity="{{ $room->capacity }}"
                                        {{ old('room_type') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }} - Rp {{ number_format($room->price_per_night, 0, ',', '.') }}/malam
                                </option>
                            @endforeach
                        </select>
                        @error('room_type')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Room Preview Section -->
                    <div id="room-preview" class="room-preview" style="display: none;">
                        <div class="preview-header">
                            <h4>🖼️ Preview Kamar</h4>
                        </div>
                        <div class="preview-content">
                            <div class="preview-image">
                                <img id="preview-image" src="" alt="Room Preview" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div class="preview-details">
                                <h4 id="preview-name"></h4>
                                <p id="preview-description" class="preview-description"></p>
                                <div class="preview-features">
                                    <div class="feature-item">
                                        <span class="feature-icon">👥</span>
                                        <span id="preview-capacity"></span>
                                    </div>
                                    <div class="feature-item">
                                        <span class="feature-icon">💰</span>
                                        <span id="preview-price"></span>
                                    </div>
                                </div>
                                <div class="preview-benefits">
                                    <h5>✨ Keunggulan Kamar:</h5>
                                    <ul id="preview-amenities"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>📄 Dokumen Pribadi</h3>
                    <div class="form-group">
                        <label for="id_card">Kartu Identitas (KTP)</label>
                        <input type="file" id="id_card" name="id_card" accept=".jpg,.jpeg,.png,.pdf" required>
                        <small class="form-hint">Format: JPG, PNG, PDF. Maksimal 5MB</small>
                        @error('id_card')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <h3>🍽️ Layanan Tambahan</h3>
                    <div class="checkbox-group">
                        <label for="breakfast">
                            <input id="breakfast" type="checkbox" name="breakfast" value="1" {{ old('breakfast') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Sarapan Pagi (+Rp 75,000 per orang per hari)
                        </label>
                    </div>
                    <div class="checkbox-group">
                        <label for="spa">
                            <input id="spa" type="checkbox" name="spa" value="1" {{ old('spa') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Paket Spa & Wellness (+Rp 250,000 per orang)
                        </label>
                    </div>
                    <div class="checkbox-group">
                        <label for="airport_transfer">
                            <input id="airport_transfer" type="checkbox" name="airport_transfer" value="1" {{ old('airport_transfer') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Airport Transfer (+Rp 150,000 per trip)
                        </label>
                    </div>
                </div>

                <div class="terms-section">
                    <div class="checkbox-group">
                        <label for="terms">
                            <input id="terms" type="checkbox" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Saya menyetujui <a href="#" target="_blank">Syarat dan Ketentuan</a> serta <a href="#" target="_blank">Kebijakan Pembatalan</a>
                        </label>
                        @error('terms')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-large">Buat Reservasi</button>
            </form>
        </div>

        <div class="booking-info">
            <div class="info-card">
                <h3>💡 Tips Reservasi</h3>
                <ul>
                    <li>Check-in dimulai pukul 14:00</li>
                    <li>Check-out sebelum pukul 12:00</li>
                    <li>Pembatalan gratis hingga 24 jam sebelum check-in</li>
                    <li>Pembayaran dapat dilakukan dengan transfer bank atau kartu kredit</li>
                </ul>
            </div>

            <div class="info-card">
                <h3>📞 Butuh Bantuan?</h3>
                <p>Tim kami siap membantu Anda 24 jam sehari.</p>
                <p><strong>📞 +62 22 1234 5678</strong></p>
                <p><strong>✉️ reservation@grandbandunghotel.com</strong></p>
            </div>

            <div class="booking-summary" id="booking-summary" style="display: none;">
                <h3>📋 Ringkasan Reservasi</h3>
                <div id="summary-content">
                    <!-- Summary will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const totalNightsSpan = document.getElementById('total-nights');
    const roomTypeSelect = document.getElementById('room_type');
    const roomPreview = document.getElementById('room-preview');
    const previewImage = document.getElementById('preview-image');
    const previewName = document.getElementById('preview-name');
    const previewDescription = document.getElementById('preview-description');
    const previewCapacity = document.getElementById('preview-capacity');
    const previewPrice = document.getElementById('preview-price');
    const previewAmenities = document.getElementById('preview-amenities');

    function calculateNights() {
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);

        if (checkIn && checkOut && checkOut > checkIn) {
            const diffTime = Math.abs(checkOut - checkIn);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            totalNightsSpan.textContent = diffDays;
        } else {
            totalNightsSpan.textContent = '0';
        }
    }

    function updateRoomPreview() {
        const selectedOption = roomTypeSelect.options[roomTypeSelect.selectedIndex];

        if (selectedOption.value) {
            const name = selectedOption.getAttribute('data-name');
            const description = selectedOption.getAttribute('data-description');
            const image = selectedOption.getAttribute('data-image');
            const amenities = JSON.parse(selectedOption.getAttribute('data-amenities') || '[]');
            const capacity = selectedOption.getAttribute('data-capacity');
            const price = selectedOption.getAttribute('data-price');

            // Update preview content
            previewName.textContent = name;
            previewDescription.textContent = description;
            previewCapacity.textContent = `${capacity} orang`;
            previewPrice.textContent = `Rp ${parseInt(price).toLocaleString('id-ID')}/malam`;

            // Update image
            if (image) {
                previewImage.src = image;
                previewImage.style.display = 'block';
            } else {
                previewImage.src = 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&h=250&fit=crop&crop=center';
                previewImage.style.display = 'block';
            }

            // Update amenities list
            previewAmenities.innerHTML = '';
            if (amenities && amenities.length > 0) {
                amenities.forEach(amenity => {
                    const li = document.createElement('li');
                    li.textContent = amenity;
                    previewAmenities.appendChild(li);
                });
            } else {
                // Default amenities if none specified
                const defaultAmenities = ['WiFi Gratis', 'AC', 'TV', 'Kamar Mandi Pribadi'];
                defaultAmenities.forEach(amenity => {
                    const li = document.createElement('li');
                    li.textContent = amenity;
                    previewAmenities.appendChild(li);
                });
            }

            // Update image based on room type
            const roomTypeImages = {
                'deluxe': '/images/rooms/deluxe-room.jpg',
                'suite': '/images/rooms/suite-room.jpg',
                'standard': '/images/rooms/standard-room.jpg'
            };

            const roomType = selectedOption.getAttribute('data-name').toLowerCase().split(' ')[0]; // Get first word (deluxe, suite, standard)
            const imageUrl = roomTypeImages[roomType] || image;

            if (imageUrl) {
                previewImage.src = imageUrl;
                previewImage.style.display = 'block';
            } else {
                previewImage.src = 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&h=250&fit=crop&crop=center';
                previewImage.style.display = 'block';
            }

            // Show preview
            roomPreview.style.display = 'block';
        } else {
            // Hide preview if no room selected
            roomPreview.style.display = 'none';
        }
    }

    checkInInput.addEventListener('change', calculateNights);
    checkOutInput.addEventListener('change', calculateNights);
    roomTypeSelect.addEventListener('change', updateRoomPreview);

    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    checkInInput.min = today;
    checkOutInput.min = today;

    // Update check-out min date when check-in changes
    checkInInput.addEventListener('change', function() {
        checkOutInput.min = this.value;
    });

    // Initialize preview if room is already selected (for form validation errors)
    updateRoomPreview();
});
</script>
@endpush
