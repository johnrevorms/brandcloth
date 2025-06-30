@extends('layouts.app')
@section('title', 'Konfirmasi Pengiriman')
@section('content')

<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
  <h2 class="text-2xl font-bold mb-6">Konfirmasi Pengiriman</h2>
  <form id="shipping-form">
    <input type="hidden" id="order-id" value="{{ request()->query('order_id') }}">

    <div class="mb-4">
      <label for="name" class="block text-sm font-semibold">Nama Penerima</label>
      <input type="text" id="name" class="w-full border border-gray-300 px-4 py-2 rounded" required>
    </div>

    <div class="mb-4">
      <label for="address" class="block text-sm font-semibold">Alamat Lengkap</label>
      <textarea id="address" rows="3" class="w-full border border-gray-300 px-4 py-2 rounded" required></textarea>
    </div>

    <div class="mb-4">
      <label for="city" class="block text-sm font-semibold">Kota</label>
      <input type="text" id="city" class="w-full border border-gray-300 px-4 py-2 rounded" required>
    </div>

    <div class="mb-4">
      <label for="province" class="block text-sm font-semibold">Provinsi</label>
      <input type="text" id="province" class="w-full border border-gray-300 px-4 py-2 rounded" required>
    </div>

    <div class="mb-4">
      <label for="postal_code" class="block text-sm font-semibold">Kode Pos</label>
      <input type="text" id="postal_code" class="w-full border border-gray-300 px-4 py-2 rounded" required>
    </div>

    <div class="mb-4">
      <label for="phone" class="block text-sm font-semibold">No HP</label>
      <input type="text" id="phone" class="w-full border border-gray-300 px-4 py-2 rounded" required>
    </div>

    <div class="mb-4">
      <label class="block text-sm font-semibold">Ongkir (otomatis)</label>
      <p class="text-green-600 font-bold" id="shipping-cost">Rp 15.000</p>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
        Lanjut ke Pembayaran
      </button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const token = localStorage.getItem('token');
  const backendUrl = 'http://127.0.0.1:9000';

  document.getElementById('shipping-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const orderId = document.getElementById('order-id').value;
    if (!orderId) {
      alert('Order tidak ditemukan.');
      window.location.href = '/';
    }

    const data = {
      order: orderId,
      name: document.getElementById('name').value,
      address: document.getElementById('address').value,
      city: document.getElementById('city').value,
      province: document.getElementById('province').value,
      postal_code: document.getElementById('postal_code').value,
      phone: document.getElementById('phone').value,
      shipping_cost: 15000
    };

    axios.post(`${backendUrl}/api/shipping-info/`, data, {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(() => {
      alert('Data pengiriman disimpan.');
      console.log('Redirecting to:', `/payment-confirmation?order_id=${data.order}&ongkir=15000`);
      window.location.href = window.location.origin + `/payment-confirmation?order_id=${data.order}&ongkir=15000`;

    })
    .catch(err => {
      console.error(err.response?.data || err);
      alert('Gagal menyimpan informasi pengiriman.');
    });
  });
</script>

@endsection
