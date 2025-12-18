// Grand Bandung Hotel - Enhanced JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
    }

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                const headerOffset = 100;
                const elementPosition = targetElement.offsetTop;
                const offsetPosition = elementPosition - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Enhanced booking form validation and features
    const bookingForm = document.getElementById('booking-form');
    if (bookingForm) {
        const checkinInput = document.getElementById('checkin');
        const checkoutInput = document.getElementById('checkout');
        const guestsSelect = document.getElementById('guests');
        const roomTypeSelect = document.getElementById('room-type');
        const nightCount = document.getElementById('night-count');
        const summaryContent = document.getElementById('summary-content');

        // Room prices in IDR
        const roomPrices = {
            'superior': 1000000,
            'deluxe': 1500000,
            'suite': 2500000,
            'presidential': 5000000
        };

        // Calculate and display night count
        function calculateNights() {
            const checkin = new Date(checkinInput.value);
            const checkout = new Date(checkoutInput.value);

            if (checkinInput.value && checkoutInput.value && checkout > checkin) {
                const diffTime = Math.abs(checkout - checkin);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                nightCount.textContent = `Durasi menginap: ${diffDays} malam`;
                updateSummary();
            } else if (checkinInput.value && checkoutInput.value && checkout <= checkin) {
                nightCount.textContent = 'Tanggal check-out harus setelah check-in';
                nightCount.style.color = '#e74c3c';
            } else {
                nightCount.textContent = 'Pilih tanggal untuk melihat jumlah malam';
                nightCount.style.color = '#666';
            }
        }

        // Update booking summary
        function updateSummary() {
            const checkin = checkinInput.value;
            const checkout = checkoutInput.value;
            const guests = guestsSelect.value;
            const roomType = roomTypeSelect.value;

            if (checkin && checkout && guests && roomType) {
                const checkinDate = new Date(checkin);
                const checkoutDate = new Date(checkout);
                const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
                const pricePerNight = roomPrices[roomType];
                const totalPrice = pricePerNight * nights;

                const roomNames = {
                    'superior': 'Kamar Superior',
                    'deluxe': 'Kamar Deluxe',
                    'suite': 'Suite Eksekutif',
                    'presidential': 'Suite Presiden'
                };

                summaryContent.innerHTML = `
                    <div class="summary-details">
                        <p><strong>Tipe Kamar:</strong> ${roomNames[roomType]}</p>
                        <p><strong>Jumlah Tamu:</strong> ${guests}</p>
                        <p><strong>Jumlah Malam:</strong> ${nights}</p>
                        <p><strong>Harga per Malam:</strong> Rp ${pricePerNight.toLocaleString('id-ID')}</p>
                        <p><strong>Total Harga:</strong> Rp ${totalPrice.toLocaleString('id-ID')}</p>
                        <p class="summary-note">*Harga belum termasuk pajak dan breakfast</p>
                    </div>
                `;
            } else {
                summaryContent.innerHTML = '<p>Silakan lengkapi formulir untuk melihat ringkasan</p>';
            }
        }

        // Event listeners for form updates
        checkinInput.addEventListener('change', calculateNights);
        checkoutInput.addEventListener('change', calculateNights);
        guestsSelect.addEventListener('change', updateSummary);
        roomTypeSelect.addEventListener('change', updateSummary);

        // Set minimum checkout date
        checkinInput.addEventListener('change', function() {
            if (this.value) {
                const minCheckout = new Date(this.value);
                minCheckout.setDate(minCheckout.getDate() + 1);
                checkoutInput.min = minCheckout.toISOString().split('T')[0];
            }
        });

        // Form validation
        bookingForm.addEventListener('submit', function(e) {
            const checkin = checkinInput.value;
            const checkout = checkoutInput.value;
            const guests = guestsSelect.value;
            const roomType = roomTypeSelect.value;
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const identity = document.getElementById('identity').value;
            const terms = document.getElementById('terms').checked;

            let errors = [];

            if (!checkin) errors.push('Tanggal check-in harus diisi');
            if (!checkout) errors.push('Tanggal check-out harus diisi');
            if (!guests) errors.push('Jumlah tamu harus dipilih');
            if (!roomType) errors.push('Tipe kamar harus dipilih');
            if (!name.trim()) errors.push('Nama lengkap harus diisi');
            if (!email.trim()) errors.push('Email harus diisi');
            if (!phone.trim()) errors.push('Nomor telepon harus diisi');
            if (!identity.trim()) errors.push('Nomor identitas harus diisi');
            if (!terms) errors.push('Anda harus menyetujui syarat dan ketentuan');

            if (checkin && checkout && new Date(checkin) >= new Date(checkout)) {
                errors.push('Tanggal check-out harus setelah tanggal check-in');
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && !emailRegex.test(email)) {
                errors.push('Format email tidak valid');
            }

            // Phone validation (Indonesian format)
            const phoneRegex = /^(\+62|62|0)[8-9][0-9]{7,11}$/;
            if (phone && !phoneRegex.test(phone.replace(/\s/g, ''))) {
                errors.push('Format nomor telepon tidak valid');
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert('Mohon perbaiki kesalahan berikut:\n\n' + errors.join('\n'));
                return false;
            }

            // Show loading state
            const submitBtn = bookingForm.querySelector('button[type="submit"]');
            submitBtn.textContent = 'Memproses...';
            submitBtn.disabled = true;
        });
    }

    // Contact form enhancement
    const contactForm = document.querySelector('.contact-form form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');

            // Basic validation
            const name = formData.get('name').trim();
            const email = formData.get('email').trim();
            const message = formData.get('message').trim();

            if (!name || !email || !message) {
                alert('Mohon lengkapi semua field yang wajib diisi');
                return;
            }

            // Show success message (in real implementation, this would be an AJAX call)
            submitBtn.textContent = 'Mengirim...';
            submitBtn.disabled = true;

            setTimeout(() => {
                alert('Terima kasih! Pesan Anda telah dikirim. Kami akan menghubungi Anda dalam 24 jam.');
                contactForm.reset();
                submitBtn.textContent = 'Kirim Pesan';
                submitBtn.disabled = false;
            }, 2000);
        });
    }

    // Room slider/carousel functionality (if needed in future)
    function initRoomSlider() {
        const roomCards = document.querySelectorAll('.room-card');
        if (roomCards.length > 3) {
            // Add carousel functionality for mobile
            let currentIndex = 0;

            function showCards() {
                roomCards.forEach((card, index) => {
                    if (window.innerWidth <= 768) {
                        if (index === currentIndex) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    } else {
                        card.style.display = 'block';
                    }
                });
            }

            if (window.innerWidth <= 768) {
                showCards();

                // Add navigation buttons (would need to be added to HTML)
                const nextBtn = document.createElement('button');
                nextBtn.textContent = '→';
                nextBtn.className = 'slider-btn next';
                nextBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % roomCards.length;
                    showCards();
                });

                const prevBtn = document.createElement('button');
                prevBtn.textContent = '←';
                prevBtn.className = 'slider-btn prev';
                prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + roomCards.length) % roomCards.length;
                    showCards();
                });

                const roomsSection = document.querySelector('.rooms');
                if (roomsSection) {
                    roomsSection.appendChild(prevBtn);
                    roomsSection.appendChild(nextBtn);
                }
            }

            window.addEventListener('resize', showCards);
        }
    }

    initRoomSlider();

    // Add scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.room-card, .amenity, .service-item, .attraction-item').forEach(el => {
        observer.observe(el);
    });

    // Add loading animation for images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.classList.add('loaded');
        });
    });

    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        .animate-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(102, 126, 234, 0.8);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            z-index: 10;
        }

        .slider-btn.prev {
            left: 1rem;
        }

        .slider-btn.next {
            right: 1rem;
        }

        img {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        img.loaded {
            opacity: 1;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);

    // Initialize all images as loaded if they're already cached
    images.forEach(img => {
        if (img.complete) {
            img.classList.add('loaded');
        }
    });
});
