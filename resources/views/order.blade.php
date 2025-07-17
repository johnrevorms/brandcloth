@extends('layouts.app')
@section('title', 'Detail Order')
@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded">
  <h2 class="text-xl font-bold mb-4">Detail Order</h2>
  <div id="order-detail" class="space-y-4 text-gray-800">Memuat data...</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
const token = localStorage.getItem('token');
console.log('Token JWT:', token);

// ✅ Ambil order ID langsung dari URL
const pathParts = window.location.pathname.split('/');
const orderId = pathParts[pathParts.length - 1];

// ✅ Cek token
if (!token) {
  document.getElementById('order-detail').innerHTML = '<p class="text-red-500">Token tidak ditemukan. Silakan login.</p>';
} else {
  axios.get(`${backendUrl}/api/orders/${orderId}/`, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  .then(res => {
    const order = res.data;
    const html = `
      <p><strong>ID:</strong> ${order.id}</p>
      <p><strong>Status:</strong> ${order.status}</p>
      <p><strong>Tracking:</strong> ${order.tracking_number ?? '-'}</p>

      <div class="mt-4">
        <label class="block font-semibold">Status</label>
        <select id="status" class="border p-2 rounded w-full">
          <option value="pending">Pending</option>
          <option value="waiting_verification">Waiting Verification</option>
          <option value="payment_done">Payment Done</option>
          <option value="shipped">Shipped</option>
        </select>
      </div>

      <div class="mt-4">
        <label class="block font-semibold">No Resi</label>
        <input type="text" id="tracking_number" value="${order.tracking_number ?? ''}" class="border p-2 rounded w-full" />
      </div>

      <button onclick="updateOrder()" class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
        Update
      </button>
    `;

    document.getElementById('order-detail').innerHTML = html;
    document.getElementById('status').value = order.status;
  })
  .catch(err => {
    console.error("Gagal load order:", err);
    document.getElementById('order-detail').innerHTML = '<p class="text-red-500">Gagal memuat detail order.</p>';
  });
}

function updateOrder() {
  const status = document.getElementById('status').value;
  const tracking = document.getElementById('tracking_number').value;

  axios.patch(`${backendUrl}/api/orders/${orderId}/`, {
    status: status,
    tracking_number: tracking
  }, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  .then(() => {
    alert('Order berhasil diupdate.');
    location.reload();
  })
  .catch(err => {
    console.error("Gagal update:", err);
    alert('Gagal update order.');
  });
}
</script>
@endsection
