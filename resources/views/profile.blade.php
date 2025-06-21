@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div class="w-full max-w-lg mx-auto mt-10 p-6 bg-black text-white rounded">
  <h2 class="text-3xl font-semibold mb-4">Your Profile</h2>
  <div id="profile-info">Loading...</div>
  <div class="text-center mt-6 hidden" id="auth-buttons">
    <a href="/login" class="bg-white text-black px-4 py-2 rounded mr-2">Login</a>
    <a href="/register" class="bg-white text-black px-4 py-2 rounded">Register</a>
  </div>
  <div class="text-center mt-6 hidden" id="logout-container">
    <button id="logout-btn" class="bg-white text-black px-4 py-2 rounded">Logout</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
const token = localStorage.getItem('token');

if (!token) {
  document.getElementById('profile-info').innerText = 'Anda belum login.';
  document.getElementById('auth-buttons').style.display = 'block';
} else {
  axios.get(`${backendUrl}/api/user/`, {
    headers: { Authorization: `Bearer ${token}` }
  })
  .then(res => {
    const user = res.data;
    let ordersHtml = '<h3 class="text-xl mt-4 mb-2">Pesanan Anda</h3>';
    if (user.orders.length === 0) {
      ordersHtml += '<p>Belum ada pesanan</p>';
    } else {
      user.orders.forEach(order => {
        ordersHtml += `<div class="border p-2 mb-2">
          <p>Order ID: ${order.id}</p>
          <p>Status: ${order.status}</p>
          <p>Tanggal: ${order.created_at}</p>
          <ul class="ml-4">` +
          order.items.map(item => `
            <li>${item.product_name} - ${item.quantity} pcs @ Rp ${parseInt(item.price).toLocaleString('id-ID')}</li>
          `).join('') +
          `</ul>
        </div>`;
      });
    }

    document.getElementById('profile-info').innerHTML = `
      <p>Username: ${user.username}</p>
      <p>Email: ${user.email}</p>
      ${ordersHtml}
    `;

    document.getElementById('logout-container').style.display = 'block';
  })
  .catch(err => {
    console.error('Error saat fetch profile:', err);
    document.getElementById('profile-info').innerText = 'Gagal memuat profil. Silakan login.';
    document.getElementById('auth-buttons').style.display = 'block';
  });
}

document.getElementById('logout-btn').addEventListener('click', () => {
  localStorage.removeItem('token');
  window.location.reload();
});
</script>
@endsection
