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
        // Tentukan warna badge berdasarkan status
        let statusText = '';
        switch (order.status) {
            case 'payment_done':
            statusText = '<span class="bg-green-100 text-green-700 px-2 py-1 text-sm rounded">Verifikasi Pembayaran</span>';
            break;
            case 'pending':
            statusText = '<span class="bg-yellow-100 text-yellow-700 px-2 py-1 text-sm rounded">Menunggu Pembayaran</span>';
            break;
            case 'waiting_verification':
            statusText = '<span class="bg-orange-100 text-orange-700 px-2 py-1 text-sm rounded">Menunggu Verifikasi</span>';
            break;
            case 'shipped':
            statusText = '<span class="bg-blue-100 text-blue-700 px-2 py-1 text-sm rounded">Sudah Dikirim</span>';
            break;
            default:
            statusText = `<span class="bg-gray-100 text-gray-700 px-2 py-1 text-sm rounded">${order.status}</span>`;
        }

        // Tracking
        const trackingInfo = order.tracking_number
            ? `<span class="bg-blue-100 text-blue-800 px-2 py-1 text-sm rounded">${order.tracking_number}</span>`
            : '<span class="bg-red-100 text-red-700 px-2 py-1 text-sm rounded">Belum dikirim</span>';

        ordersHtml += `
            <div class="border p-4 mb-4 rounded shadow bg-white text-black">
            <p><strong>Order ID:</strong> ${order.id}</p>
            <p><strong>Status:</strong> ${statusText}</p>
            <p><strong>Tanggal:</strong> ${order.created_at}</p>
            <p><strong>Tracking:</strong> ${trackingInfo}</p>
            <ul class="ml-4 mt-2">` +
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
