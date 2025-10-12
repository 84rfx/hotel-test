// main.js - StayEasy Hotel combined (frontend-only demo)
function $(sel){return document.querySelector(sel);}
function $all(sel){return document.querySelectorAll(sel);}
function saveUser(user){ localStorage.setItem('se_user', JSON.stringify(user)); }
function getUser(){ const s=localStorage.getItem('se_user'); return s?JSON.parse(s):null; }
function logout(){ localStorage.removeItem('se_user'); renderNavbar(); window.location.href='index.html'; }

function renderNavbar(){
  const u = getUser();
  const authLinks = document.getElementById('auth-links');
  if(!authLinks) return;
  if(u){
    if(u.role === 'admin'){
      authLinks.innerHTML = `
        <li class="nav-item"><a class="nav-link" href="reservation.html">Reservasi</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.html">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="admin/dashboard.html">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="#" id="logout-btn">Logout</a></li>
      `;
    } else {
      authLinks.innerHTML = `
        <li class="nav-item"><a class="nav-link" href="reservation.html">Reservasi</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.html">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="#" id="logout-btn">Logout</a></li>
      `;
    }
    const btn = document.getElementById('logout-btn');
    if(btn) btn.addEventListener('click', (e)=>{ e.preventDefault(); logout(); });
  } else {
    authLinks.innerHTML = `
      <li class="nav-item"><a class="nav-link" href="register.html">Daftar</a></li>
      <li class="nav-item"><a class="nav-link" href="login.html">Masuk</a></li>
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
    window.location.href = 'index.html';
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
      window.location.href = 'admin/dashboard.html';
      return;
    }
    const name = email.split('@')[0] || 'User';
    const user = { name, email, avatar: localStorage.getItem('se_avatar')||null, role:'user' };
    saveUser(user);
    alert('Login sukses.');
    window.location.href = 'index.html';
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
  if(avatarImg) avatarImg.src = u.avatar || 'img/default-profile.png';

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

function handleReservationPage(){
  const form = document.getElementById('reserve-form');
  if(!form) return;
  const preview = document.getElementById('ktp-preview');
  const ktpInput = document.getElementById('ktp-file');
  if(ktpInput){
    ktpInput.addEventListener('change', function(e){
      const f = e.target.files[0];
      if(!f) { preview.src=''; return; }
      const reader = new FileReader();
      reader.onload = () => { preview.src = reader.result; };
      reader.readAsDataURL(f);
    });
  }
  form.addEventListener('submit', function(e){
    e.preventDefault();
    if(!getUser()) return alert('Silakan login atau register terlebih dahulu.');
    if(!form.checkValidity()){
      form.classList.add('was-validated');
      return;
    }
    const data = {
      name: form['guest-name'].value,
      email: form['guest-email'].value,
      room: form['room-type'].value,
      checkin: form['checkin'].value,
      checkout: form['checkout'].value,
    };
    const arr = JSON.parse(localStorage.getItem('se_reservations')||'[]');
    arr.push(data);
    localStorage.setItem('se_reservations', JSON.stringify(arr));
    alert('Reservasi sukses (simulasi).');
    form.reset();
    preview.src='';
  });
}

function getActiveReservations() {
  const now = new Date();
  const reservations = JSON.parse(localStorage.getItem('se_reservations') || '[]');
  return reservations.filter(r => {
    const checkout = new Date(r.checkout);
    return checkout > now;
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

    const roomsSearch = document.getElementById('rooms-search');
    if(roomsSearch){
      roomsSearch.addEventListener('input', function(){
        const query = this.value.toLowerCase();
        const rows = roomsTable.querySelectorAll('tr');
        rows.forEach(row => {
          const name = row.cells[2].textContent.toLowerCase();
          if(name.includes(query)){
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    }
  }

  const usersTable = document.getElementById('users-table-body');
  if(usersTable){
    const usersList = JSON.parse(localStorage.getItem('se_users_list')||'[]');
    usersTable.innerHTML = '';
    usersList.forEach((u,i)=>{
      usersTable.innerHTML += `<tr><td>${i+1}</td><td>${u.name}</td><td>${u.email}</td></tr>`;
    });

    const usersSearch = document.getElementById('users-search');
    if(usersSearch){
      usersSearch.addEventListener('input', function(){
        const query = this.value.toLowerCase();
        const rows = usersTable.querySelectorAll('tr');
        rows.forEach(row => {
          const name = row.cells[1].textContent.toLowerCase();
          if(name.includes(query)){
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    }
  }

  const resTable = document.getElementById('reservations-table-body');
  if(resTable){
    const now = new Date();
    const upcomingReservations = reservations.filter(r => {
      const checkout = new Date(r.checkout);
      return checkout > now;
    });
    resTable.innerHTML = '';
    upcomingReservations.forEach((r,i)=>{
      resTable.innerHTML += `<tr><td>${i+1}</td><td>${r.name}</td><td>${r.email}</td><td>${r.room}</td><td>${r.checkin} → ${r.checkout}</td><td>${r.adults || 0}</td><td>${r.kids || 0}</td></tr>`;
    });

    const reservationsSearch = document.getElementById('reservations-search');
    if(reservationsSearch){
      reservationsSearch.addEventListener('input', function(){
        const query = this.value.toLowerCase();
        const rows = resTable.querySelectorAll('tr');
        rows.forEach(row => {
          const name = row.cells[1].textContent.toLowerCase();
          if(name.includes(query)){
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    }
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
      historyTable.innerHTML += `<tr><td>${i+1}</td><td>${r.name}</td><td>${r.email}</td><td>${r.room}</td><td>${r.checkin} → ${r.checkout}</td><td>${r.adults || 0}</td><td>${r.kids || 0}</td></tr>`;
    });

    const historySearch = document.getElementById('history-search');
    if(historySearch){
      historySearch.addEventListener('input', function(){
        const query = this.value.toLowerCase();
        const rows = historyTable.querySelectorAll('tr');
        rows.forEach(row => {
          const name = row.cells[1].textContent.toLowerCase();
          if(name.includes(query)){
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    }
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
}

document.addEventListener('DOMContentLoaded', function(){
  renderNavbar();
  handleRegisterForm();
  handleLoginForm();
  handleProfilePage();
  handleReservationPage();
  if(window.location.pathname.includes('/admin/')) adminInit();
});