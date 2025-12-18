// main.js - StayEasy Hotel combined (frontend-only demo)
function $(sel){return document.querySelector(sel);}
function $all(sel){return document.querySelectorAll(sel);}
function saveUser(user){ localStorage.setItem('se_user', JSON.stringify(user)); }
function getUser(){ const s=localStorage.getItem('se_user'); return s?JSON.parse(s):null; }
function logout(){ localStorage.removeItem('se_user'); renderNavbar(); window.location.href='/'; }

function renderNavbar(){
  const u = getUser();
  const authLinks = document.getElementById('auth-links');
  if(!authLinks) return;
  if(u){
    if(u.role === 'admin'){
      authLinks.innerHTML = `
        <li class="nav-item"><a class="nav-link" href="/reservation">Reservasi</a></li>
        <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="#" id="logout-btn">Logout</a></li>
      `;
    } else {
      authLinks.innerHTML = `
        <li class="nav-item"><a class="nav-link" href="/reservation">Reservasi</a></li>
        <li class="nav-item"><a class="nav-link" href="/history">Riwayat Reservasi</a></li>
        <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="#" id="logout-btn">Logout</a></li>
      `;
    }
    const btn = document.getElementById('logout-btn');
    if(btn) btn.addEventListener('click', (e)=>{ e.preventDefault(); logout(); });
  } else {
    authLinks.innerHTML = `
      <li class="nav-item"><a class="nav-link" href="/register">Daftar</a></li>
      <li class="nav-item"><a class="nav-link" href="/login">Masuk</a></li>
    `;
  }
}

function handleRegisterForm(){
  const form = document.getElementById('register-form');
  if(!form) return;
  form.addEventListener('submit', function(e){
    e.preventDefault();
    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const pass = form.password.value;
    if(!name||!email||!pass) return alert('Lengkapi form!');
    const list = JSON.parse(localStorage.getItem('se_users_list')||'[]');
    list.push({name, email});
    localStorage.setItem('se_users_list', JSON.stringify(list));
    const user = { name, email, avatar: localStorage.getItem('se_avatar')||null, role: 'user' };
    saveUser(user);
    alert('Registrasi sukses. Anda otomatis login.');
    window.location.href = '/';
  });
}

function handleLoginForm(){
  const form = document.getElementById('login-form');
  if(!form) return;
  form.addEventListener('submit', function(e){
    e.preventDefault();
    const email = form.email.value.trim();
    const password = form.password.value;
    if(email==='admin@hotel.com' && password==='admin'){
      const admin = { name: 'Admin StayEasy', email, avatar: localStorage.getItem('se_avatar')||null, role:'admin' };
      saveUser(admin);
      alert('Login admin sukses.');
      window.location.href = '/admin/dashboard';
      return;
    }
    const name = email.split('@')[0] || 'User';
    const user = { name, email, avatar: localStorage.getItem('se_avatar')||null, role:'user' };
    saveUser(user);
    alert('Login sukses.');
    window.location.href = '/';
  });
}

function handleProfilePage(){
  const u = getUser();
  if(!u) return;
  const nameField = document.getElementById('profile-name');
  const emailField = document.getElementById('profile-email');
  const avatarImg = document.getElementById('profile-avatar-img');
  if(nameField) nameField.value = u.name || '';
  if(emailField) emailField.value = u.email || '';
  if(avatarImg) avatarImg.src = u.avatar || '/assets/img/default-profile.png';

  const avatarInput = document.getElementById('profile-avatar');
  if(avatarInput){
    avatarInput.addEventListener('change', function(e){
      const f = e.target.files[0];
      if(!f) return;
      const reader = new FileReader();
      reader.onload = () => { avatarImg.src = reader.result; localStorage.setItem('se_avatar', reader.result); };
      reader.readAsDataURL(f);
    });
  }

  const form = document.getElementById('profile-form');
  if(form){
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const name = form['profile-name'].value.trim();
      const email = form['profile-email'].value.trim();
      const user = { name, email, avatar: localStorage.getItem('se_avatar')||null, role: getUser().role || 'user' };
      saveUser(user);
      alert('Profil disimpan (lokal).');
      renderNavbar();
    });
  }
}

function getActiveReservations() {
  const now = new Date();
  const reservations = JSON.parse(localStorage.getItem('se_reservations') || '[]');
  return reservations.filter(r => {
    const checkin = new Date(r.checkin);
    const checkout = new Date(r.checkout);
    return now >= checkin && now < checkout;
  });
}

function handleReservationPage(){
  const form = document.getElementById('reserve-form');
  if(!form) return;

  // Room type change handler
  const roomTypeSelect = document.getElementById('room-type');
  const roomImg = document.getElementById('room-img');
  const roomTitle = document.getElementById('room-title');
  const roomBenefits = document.getElementById('room-benefits');
  const promoPrice = document.getElementById('promo-price');
  const roomsLeft = document.getElementById('rooms-left');
  const promoNote = document.getElementById('promo-note');
  const referralCode = document.getElementById('referral-code');
  const ktpFile = document.getElementById('ktp-file');
  const ktpPreview = document.getElementById('ktp-preview');

  // Populate rooms from localStorage
  const rooms = JSON.parse(localStorage.getItem('se_rooms') || '[]');
  roomTypeSelect.innerHTML = '<option value="">-- Pilih Tipe Kamar --</option>';
  rooms.forEach(room => {
    roomTypeSelect.innerHTML += `<option value="${room.id}">${room.name} - Rp ${room.price.toLocaleString()}</option>`;
  });

  // Room change event
  roomTypeSelect.addEventListener('change', function(){
    const selectedId = this.value;
    const selectedRoom = rooms.find(r => r.id == selectedId);
    if(selectedRoom){
      roomImg.src = selectedRoom.img;
      roomTitle.textContent = selectedRoom.name;
      roomBenefits.textContent = selectedRoom.description || `Kamar nyaman untuk 2 orang dengan fasilitas lengkap. Harga: Rp ${selectedRoom.price.toLocaleString()}/malam.`;
      promoPrice.textContent = `Rp ${selectedRoom.price.toLocaleString()}`;
      roomsLeft.textContent = Math.floor(Math.random() * 5) + 1; // Dummy availability
      promoNote.textContent = '';
    } else {
      roomImg.src = '/assets/img/room1.jpg';
      roomTitle.textContent = 'Superior';
      roomBenefits.textContent = 'Kamar nyaman untuk 2 orang dewasa dengan AC, TV, dan WiFi gratis.';
      promoPrice.textContent = 'Rp 0';
      roomsLeft.textContent = '0';
    }
  });

  // Referral code handler
  referralCode.addEventListener('input', function(){
    const code = this.value.toUpperCase();
    const discount = code === 'STAYEASY10' ? 0.1 : 0;
    const selectedRoom = rooms.find(r => r.id == roomTypeSelect.value);
    if(selectedRoom && discount > 0){
      const discounted = selectedRoom.price * (1 - discount);
      promoPrice.textContent = `Rp ${discounted.toLocaleString()} (Diskon 10%)`;
      promoNote.textContent = 'Kode referral valid! Diskon 10% diterapkan.';
    } else if(selectedRoom){
      promoPrice.textContent = `Rp ${selectedRoom.price.toLocaleString()}`;
      promoNote.textContent = code ? 'Kode referral tidak valid.' : '';
    }
  });

  // KTP preview
  ktpFile.addEventListener('change', function(e){
    const f = e.target.files[0];
    if(f){
      const reader = new FileReader();
      reader.onload = () => { ktpPreview.src = reader.result; ktpPreview.style.display = 'block'; };
      reader.readAsDataURL(f);
    } else {
      ktpPreview.src = '';
      ktpPreview.style.display = 'none';
    }
  });

  // Form validation and submission
  form.addEventListener('submit', function(e){
    e.preventDefault();
    if(!form.checkValidity()) {
      e.stopPropagation();
      form.classList.add('was-validated');
      return;
    }

    const formData = new FormData(form);
    const data = {
      name: formData.get('guest-name'),
      email: formData.get('guest-email'),
      room: roomTypeSelect.options[roomTypeSelect.selectedIndex].text,
      checkin: formData.get('checkin'),
      checkout: formData.get('checkout'),
      adults: formData.get('adults'),
      kids: formData.get('kids'),
      referral: formData.get('referral-code')
    };

    let reservations = JSON.parse(localStorage.getItem('se_reservations') || '[]');
    reservations.push(data);
    localStorage.setItem('se_reservations', JSON.stringify(reservations));

    alert('Reservasi berhasil dikirim! Kami akan hubungi via email.');
    form.reset();
    roomTypeSelect.value = '';
    roomImg.src = '/assets/img/room1.jpg';
    roomTitle.textContent = 'Superior';
    roomBenefits.textContent = 'Kamar nyaman untuk 2 orang dewasa dengan AC, TV, dan WiFi gratis.';
    promoPrice.textContent = 'Rp 0';
    roomsLeft.textContent = '0';
    promoNote.textContent = '';
    ktpPreview.src = '';
    ktpPreview.style.display = 'none';
    form.classList.remove('was-validated');
  });
}

function adminInit(){
  const u = getUser();
  if(!u || u.role!=='admin'){
    alert('Akses admin diperlukan.');
    window.location.href = '/login';
    return;
  }
  const users = JSON.parse(localStorage.getItem('se_users_list')||'[]');
  const reservations = JSON.parse(localStorage.getItem('se_reservations')||'[]');
  const rooms = JSON.parse(localStorage.getItem('se_rooms')||'[]');
  const elUsers = document.getElementById('stat-users');
  const elRooms = document.getElementById('stat-rooms');
  const elRes = document.getElementById('stat-reservations');
  if(elUsers) elUsers.innerText = users.length || 0;
  if(elRooms) elRooms.innerText = rooms.length || 3;
  if(elRes) elRes.innerText = reservations.length || 0;

  const roomsTable = document.getElementById('rooms-table-body');
  if(roomsTable){
    const defaultRooms = rooms.length?rooms:[
      {id:1,name:'Superior',price:350000,img:'/assets/img/room1.jpg'},
      {id:2,name:'Deluxe',price:550000,img:'/assets/img/room2.jpg'},
      {id:3,name:'Suite',price:950000,img:'/assets/img/room3.jpg'}
    ];
    localStorage.setItem('se_rooms', JSON.stringify(defaultRooms));
    roomsTable.innerHTML = '';
    defaultRooms.forEach(r=>{
      roomsTable.innerHTML += `<tr>
        <td>${r.id}</td>
        <td><img src="${r.img}" class="table-img"></td>
        <td><a href="/admin/rooms/edit/${r.id}" class="btn btn-sm btn-warning">${r.name}</a></td>
        <td>Rp ${r.price.toLocaleString('id')}</td>
        <td><button class="btn btn-sm btn-danger delete-room" data-id="${r.id}">Hapus</button></td>
      </tr>`;
    });
    $all('.delete-room').forEach(b=>b.addEventListener('click', (e)=>{
      if(!confirm('Hapus kamar ini? (dummy)')) return;
      const id = +e.target.dataset.id;
      let rr = JSON.parse(localStorage.getItem('se_rooms')||'[]').filter(x=>x.id!==id);
      localStorage.setItem('se_rooms', JSON.stringify(rr));
      adminInit();
    }));
  }

  const usersTable = document.getElementById('users-table-body');
  if(usersTable){
    const usersList = JSON.parse(localStorage.getItem('se_users_list')||'[]');
    usersTable.innerHTML = '';
    usersList.forEach((u,i)=>{
      usersTable.innerHTML += `<tr>
        <td>${i+1}</td>
        <td>${u.name}</td>
        <td>${u.email}</td>
        <td>
          <a href="/admin/users/edit/${i}" class="btn btn-sm btn-primary">Edit</a>
          <button class="btn btn-sm btn-danger delete-user" data-index="${i}">Hapus</button>
        </td>
      </tr>`;
    });
    $all('.delete-user').forEach(b=>b.addEventListener('click', (e)=>{
      if(!confirm('Hapus pengguna ini? (dummy)')) return;
      const index = +e.target.dataset.index;
      let uu = JSON.parse(localStorage.getItem('se_users_list')||'[]');
      uu.splice(index, 1);
      localStorage.setItem('se_users_list', JSON.stringify(uu));
      adminInit();
    }));
  }

  const resTable = document.getElementById('reservations-table-body');
  if(resTable){
    const activeReservations = getActiveReservations();
    resTable.innerHTML = '';
    activeReservations.forEach((r,i)=>{
      resTable.innerHTML += `<tr>
        <td>${i+1}</td>
        <td>${r.name}</td>
        <td>${r.email}</td>
        <td><span class="badge bg-info">${r.room}</span></td>
        <td>${r.checkin} → ${r.checkout}</td>
        <td>${r.adults || 0}</td>
        <td>${r.kids || 0}</td>
        <td>
          <button class="btn btn-sm btn-success">Konfirmasi</button>
          <button class="btn btn-sm btn-danger">Batal</button>
        </td>
      </tr>`;
    });
  }

  const historyTable = document.getElementById('history-table-body');
  if(historyTable){
    const now = new Date();
    const pastReservations = reservations.filter(r => {
      const checkout = new Date(r.checkout);
      return checkout < now;
    });
    historyTable.innerHTML = '';
    pastReservations.forEach((r,i)=>{
      historyTable.innerHTML += `<tr>
        <td>${i+1}</td>
        <td>${r.name}</td>
        <td>${r.email}</td>
        <td><span class="badge bg-secondary">${r.room}</span></td>
        <td>${r.checkin} → ${r.checkout}</td>
        <td>${r.adults || 0}</td>
        <td>${r.kids || 0}</td>
        <td><span class="badge bg-success">Selesai</span></td>
      </tr>`;
    });
  }

  const dailyStatsBody = document.getElementById('daily-stats-body');
  if(dailyStatsBody){
    const dailyStats = {};
    reservations.forEach(r => {
      const date = r.checkin.split('T')[0]; // YYYY-MM-DD
      dailyStats[date] = (dailyStats[date] || 0) + 1;
    });
    dailyStatsBody.innerHTML = '';
    Object.entries(dailyStats).sort(([a],[b]) => new Date(b) - new Date(a)).forEach(([date, count]) => {
      dailyStatsBody.innerHTML += `<tr><td>${date}</td><td>${count}</td></tr>`;
    });
  }

  // Search functionality for admin tables
  function setupSearch(inputId, tableId) {
    const input = document.getElementById(inputId);
    const tbody = document.getElementById(tableId);
    if(input && tbody) {
      input.addEventListener('keyup', function() {
        const term = this.value.toLowerCase();
        const rows = tbody.querySelectorAll('tr');
        rows.forEach(row => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(term) ? '' : 'none';
        });
      });
    }
  }

  setupSearch('rooms-search', 'rooms-table-body');
  setupSearch('users-search', 'users-table-body');
  setupSearch('reservations-search', 'reservations-table-body');
  setupSearch('history-search', 'history-table-body');
}

function handleEditRoomPage(){
  const path = window.location.pathname;
  if(!path.includes('/admin/rooms/edit/')) return;

  const id = path.split('/').pop();
  const rooms = JSON.parse(localStorage.getItem('se_rooms') || '[]');
  const room = rooms.find(r => r.id == id);
  if(!room) {
    alert('Kamar tidak ditemukan.');
    window.location.href = '/admin/rooms';
    return;
  }

  document.getElementById('room-id-display').value = room.id;
  document.getElementById('room-name').value = room.name;
  document.getElementById('room-description').value = room.description || '';
  document.getElementById('room-price').value = room.price;
  document.getElementById('room-image-preview').src = room.img;

  const form = document.getElementById('edit-room-form');
  if(form){
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const name = document.getElementById('room-name').value.trim();
      const description = document.getElementById('room-description').value.trim();
      const price = parseInt(document.getElementById('room-price').value);
      const imageFile = document.getElementById('room-image').files[0];

      if(!name || !price) return alert('Lengkapi form!');

      let img = room.img;
      if(imageFile){
        const reader = new FileReader();
        reader.onload = function(e){
          img = e.target.result;
          updateRoom(id, name, description, price, img);
        };
        reader.readAsDataURL(imageFile);
      } else {
        updateRoom(id, name, description, price, img);
      }
    });
  }

  function updateRoom(id, name, description, price, img){
    let rooms = JSON.parse(localStorage.getItem('se_rooms') || '[]');
    rooms = rooms.map(r => r.id == id ? {id: r.id, name, description, price, img} : r);
    localStorage.setItem('se_rooms', JSON.stringify(rooms));
    alert('Kamar berhasil diupdate.');
    window.location.href = '/admin/rooms';
  }
}

function handleAddRoomPage(){
  const form = document.getElementById('add-room-form');
  if(!form) return;

  const preview = document.getElementById('room-image-preview');
  const imageInput = document.getElementById('room-image');
  if(imageInput){
    imageInput.addEventListener('change', function(e){
      const f = e.target.files[0];
      if(!f) { preview.src = '/assets/img/default-room.png'; return; }
      const reader = new FileReader();
      reader.onload = () => { preview.src = reader.result; };
      reader.readAsDataURL(f);
    });
  }

  form.addEventListener('submit', function(e){
    e.preventDefault();
    const name = document.getElementById('room-name').value.trim();
    const description = document.getElementById('room-description').value.trim();
    const price = parseInt(document.getElementById('room-price').value);
    const imageFile = document.getElementById('room-image').files[0];

    if(!name || !price) return alert('Lengkapi form!');

    let img = '/assets/img/default-room.png';
    if(imageFile){
      const reader = new FileReader();
      reader.onload = function(e){
        img = e.target.result;
        addRoom(name, description, price, img);
      };
      reader.readAsDataURL(imageFile);
      return;
    }
    addRoom(name, description, price, img);
  });

  function addRoom(name, description, price, img){
    let rooms = JSON.parse(localStorage.getItem('se_rooms') || '[]');
    const newId = rooms.length ? Math.max(...rooms.map(r => r.id)) + 1 : 1;
    rooms.push({id: newId, name, description, price, img});
    localStorage.setItem('se_rooms', JSON.stringify(rooms));
    alert('Kamar baru berhasil ditambahkan.');
    window.location.href = '/admin/rooms';
  }
}

function handleAddUserPage(){
  const form = document.getElementById('add-user-form');
  if(!form) return;

  const preview = document.getElementById('user-avatar-preview');
  const avatarInput = document.getElementById('user-avatar');
  if(avatarInput){
    avatarInput.addEventListener('change', function(e){
      const f = e.target.files[0];
      if(!f) { preview.src = '/assets/img/default-profile.png'; return; }
      const reader = new FileReader();
      reader.onload = () => { preview.src = reader.result; };
      reader.readAsDataURL(f);
    });
  }

  form.addEventListener('submit', function(e){
    e.preventDefault();
    const name = document.getElementById('user-name').value.trim();
    const email = document.getElementById('user-email').value.trim();
    const avatarFile = document.getElementById('user-avatar').files[0];

    if(!name || !email) return alert('Lengkapi form!');

    let avatar = '/assets/img/default-profile.png';
    if(avatarFile){
      const reader = new FileReader();
      reader.onload = function(e){
        avatar = e.target.result;
        addUser(name, email, avatar);
      };
      reader.readAsDataURL(avatarFile);
      return;
    }
    addUser(name, email, avatar);
  });

  function addUser(name, email, avatar){
    let users = JSON.parse(localStorage.getItem('se_users_list') || '[]');
    users.push({name, email, avatar});
    localStorage.setItem('se_users_list', JSON.stringify(users));
    alert('Pengguna baru berhasil ditambahkan.');
    window.location.href = '/admin/users';
  }
}

function handleEditUserPage(){
  const path = window.location.pathname;
  if(!path.includes('/admin/users/edit/')) return;

  const index = parseInt(path.split('/').pop());
  const users = JSON.parse(localStorage.getItem('se_users_list') || '[]');
  const user = users[index];
  if(!user) {
    alert('Pengguna tidak ditemukan.');
    window.location.href = '/admin/users';
    return;
  }

  document.getElementById('user-id').value = index;
  document.getElementById('user-id-display').value = index + 1;
  document.getElementById('user-name').value = user.name || '';
  document.getElementById('user-email').value = user.email || '';
  const preview = document.getElementById('user-avatar-preview');
  if(user.avatar) preview.src = user.avatar;

  const avatarInput = document.getElementById('user-avatar');
  if(avatarInput){
    avatarInput.addEventListener('change', function(e){
      const f = e.target.files[0];
      if(!f) return;
      const reader = new FileReader();
      reader.onload = () => { preview.src = reader.result; };
      reader.readAsDataURL(f);
    });
  }

  const form = document.getElementById('edit-user-form');
  if(form){
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const name = document.getElementById('user-name').value.trim();
      const email = document.getElementById('user-email').value.trim();
      const avatarFile = document.getElementById('user-avatar').files[0];

      if(!name || !email) return alert('Lengkapi form!');

      let avatar = user.avatar || '/assets/img/default-profile.png';
      if(avatarFile){
        const reader = new FileReader();
        reader.onload = function(e){
          avatar = e.target.result;
          saveUserUpdate(index, name, email, avatar);
        };
        reader.readAsDataURL(avatarFile);
        return;
      } else {
        saveUserUpdate(index, name, email, avatar);
      }
    });
  }

  function saveUserUpdate(index, name, email, avatar){
    let users = JSON.parse(localStorage.getItem('se_users_list') || '[]');
    users[index] = {name, email, avatar};
    localStorage.setItem('se_users_list', JSON.stringify(users));
    alert('Pengguna berhasil diupdate.');
    window.location.href = '/admin/users';
  }
}

// Dummy handlers for reservation actions
document.addEventListener('click', function(e){
  if(e.target.classList.contains('btn-success') && e.target.textContent.includes('Konfirmasi')){
    e.preventDefault();
    alert('Reservasi dikonfirmasi (dummy).');
  } else if(e.target.classList.contains('btn-danger') && e.target.textContent.includes('Batal')){
    e.preventDefault();
    if(confirm('Batalkan reservasi ini? (dummy)')){
      alert('Reservasi dibatalkan (dummy).');
    }
  }
});

document.addEventListener('DOMContentLoaded', function(){
  renderNavbar();
  handleRegisterForm();
  handleLoginForm();
  handleProfilePage();
  handleReservationPage();
  handleEditRoomPage();
  handleEditUserPage();
  handleGalleryPage();
  handleContactPage();
  handleFaqPage();
  initWeatherWidget();
  if(window.location.pathname.includes('/admin/')) adminInit();
});

// Gallery page handlers
function handleGalleryPage(){
  if(!window.location.pathname.includes('/gallery')) return;

  // Gallery modal functionality
  const galleryModal = document.getElementById('galleryModal');
  if(galleryModal){
    galleryModal.addEventListener('show.bs.modal', function(event){
      const button = event.relatedTarget;
      const src = button.getAttribute('data-src');
      const title = button.getAttribute('data-title');
      const desc = button.getAttribute('data-description');

      document.getElementById('galleryModalImg').src = src;
      document.getElementById('galleryModalTitle').textContent = title;
      document.getElementById('galleryModalDesc').textContent = desc;
    });
  }
}

// Contact page handlers
function handleContactPage(){
  if(!window.location.pathname.includes('/contact')) return;

  const contactForm = document.getElementById('contact-form');
  if(contactForm){
    contactForm.addEventListener('submit', function(e){
      e.preventDefault();
      if(!this.checkValidity()){
        e.stopPropagation();
        this.classList.add('was-validated');
        return;
      }

      // Simulate form submission
      showToast('Pesan Anda telah dikirim! Kami akan segera menghubungi Anda.', 'success');
      this.reset();
      this.classList.remove('was-validated');
    });
  }

  // Newsletter subscription
  const newsletterForm = document.querySelector('.newsletter-form');
  if(newsletterForm){
    newsletterForm.addEventListener('submit', function(e){
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;
      if(email){
        showToast('Terima kasih telah berlangganan newsletter kami!', 'success');
        this.reset();
      }
    });
  }
}

// FAQ page handlers
function handleFaqPage(){
  if(!window.location.pathname.includes('/faq')) return;

  // FAQ accordion functionality
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer');

    question.addEventListener('click', function(){
      const isActive = item.classList.contains('active');

      // Close all FAQ items
      faqItems.forEach(i => {
        i.classList.remove('active');
        i.querySelector('.faq-answer').style.maxHeight = null;
      });

      // Open clicked item if it wasn't active
      if(!isActive){
        item.classList.add('active');
        answer.style.maxHeight = answer.scrollHeight + 'px';
      }
    });
  });

  // FAQ search functionality
  const searchInput = document.getElementById('faq-search');
  if(searchInput){
    searchInput.addEventListener('input', function(){
      const term = this.value.toLowerCase();
      const faqItems = document.querySelectorAll('.faq-item');

      faqItems.forEach(item => {
        const question = item.querySelector('.faq-question').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer').textContent.toLowerCase();

        if(question.includes(term) || answer.includes(term)){
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  }

  // Newsletter subscription
  const newsletterForm = document.querySelector('.newsletter-form');
  if(newsletterForm){
    newsletterForm.addEventListener('submit', function(e){
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;
      if(email){
        showToast('Terima kasih telah berlangganan newsletter kami!', 'success');
        this.reset();
      }
    });
  }
}

// Weather widget functionality
function initWeatherWidget(){
  if(!document.getElementById('weather-widget')) return;

  // Simulate weather API call (replace with actual API in production)
  fetchWeatherData();
}

async function fetchWeatherData(){
  try {
    // Using OpenWeatherMap API (you'll need to get a free API key)
    const apiKey = 'YOUR_OPENWEATHERMAP_API_KEY'; // Replace with actual API key
    const city = 'Jakarta';
    const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=id`);

    if(!response.ok){
      throw new Error('Weather API not available');
    }

    const data = await response.json();
    updateWeatherWidget(data);
  } catch (error) {
    console.warn('Weather API failed, using mock data:', error);
    // Fallback to mock data
    updateWeatherWidget({
      weather: [{description: 'Cerah', icon: '01d'}],
      main: {temp: 28, humidity: 65},
      wind: {speed: 15},
      name: 'Jakarta, Indonesia'
    });
  }
}

function updateWeatherWidget(data){
  const loading = document.querySelector('.weather-loading');
  const content = document.querySelector('.weather-content');

  if(loading) loading.style.display = 'none';
  if(content) content.style.display = 'block';

  // Update weather data
  const icon = getWeatherIcon(data.weather[0].icon);
  const temp = Math.round(data.main.temp);
  const desc = data.weather[0].description;
  const location = data.name + ', Indonesia';
  const humidity = data.main.humidity;
  const windSpeed = Math.round(data.wind.speed * 3.6); // Convert m/s to km/h

  document.getElementById('weather-icon').textContent = icon;
  document.getElementById('weather-temp').textContent = `${temp}°C`;
  document.getElementById('weather-desc').textContent = desc.charAt(0).toUpperCase() + desc.slice(1);
  document.getElementById('weather-location').textContent = location;
  document.getElementById('weather-humidity').textContent = `${humidity}%`;
  document.getElementById('weather-wind').textContent = `${windSpeed} km/h`;

  // Mock UV index (would come from separate API)
  document.getElementById('weather-uv').textContent = Math.floor(Math.random() * 11) + 1;
}

function getWeatherIcon(iconCode){
  const iconMap = {
    '01d': '☀️', '01n': '🌙',
    '02d': '⛅', '02n': '☁️',
    '03d': '☁️', '03n': '☁️',
    '04d': '☁️', '04n': '☁️',
    '09d': '🌧️', '09n': '🌧️',
    '10d': '🌦️', '10n': '🌧️',
    '11d': '⛈️', '11n': '⛈️',
    '13d': '❄️', '13n': '❄️',
    '50d': '🌫️', '50n': '🌫️'
  };
  return iconMap[iconCode] || '☀️';
}

// Toast notification function
function showToast(message, type = 'info'){
  // Create toast container if it doesn't exist
  let toastContainer = document.querySelector('.toast-container');
  if(!toastContainer){
    toastContainer = document.createElement('div');
    toastContainer.className = 'toast-container';
    document.body.appendChild(toastContainer);
  }

  // Create toast element
  const toast = document.createElement('div');
  toast.className = `toast align-items-center text-white bg-${type} border-0`;
  toast.setAttribute('role', 'alert');
  toast.innerHTML = `
    <div class="d-flex">
      <div class="toast-body">${message}</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  `;

  // Add to container and show
  toastContainer.appendChild(toast);
  const bsToast = new bootstrap.Toast(toast);
  bsToast.show();

  // Remove after 5 seconds
  setTimeout(() => {
    toast.remove();
  }, 5000);
}
