@extends('layouts.app')
@section('title', 'Konfirmasi Pembayaran')
@section('content')

<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
  <h2 class="text-2xl font-bold mb-6">Konfirmasi Pembayaran</h2>
  <form id="payment-form" enctype="multipart/form-data">
    <input type="hidden" id="order-id" value="{{ request()->query('order_id') }}">
    <input type="hidden" id="ongkir" value="{{ request()->query('ongkir') ?? 0 }}">

    <div class="mb-4">
      <label for="bank" class="block text-sm font-semibold">Transfer ke</label>
      <select id="bank" class="w-full border px-3 py-2 rounded" required>
        <option value="">-- Pilih Bank Atau DANA --</option>
        <option value="BCA - 123456789 a/n John Revorms">BCA - 123456789</option>
        <option value="DANA - 085357402846 a/n John Revorms">DANA - 085357402846</option>
      </select>
    </div>

    <div class="mb-4">
      <label class="block text-sm font-semibold">Upload Bukti Pembayaran</label>
      <input type="file" id="proof_image" accept="image/*" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div class="mb-4">
      <label class="block text-sm font-semibold">Total Bayar</label>
      <p class="text-green-600 font-bold" id="total-payment">Loading...</p>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
        Upload & Konfirmasi
      </button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const token = localStorage.getItem('token');
  const backendUrl = 'http://127.0.0.1:9000';
  const orderId = document.getElementById('order-id').value;
  const ongkir = parseInt(document.getElementById('ongkir').value);

  // Hitung total + ongkir
  let totalAmount = 0;
  axios.get(`${backendUrl}/api/orders/${orderId}/`, {
    headers: { Authorization: `Bearer ${token}` }
  })
  .then(res => {
    const items = res.data.items;
    const subtotal = items.reduce((sum, item) => sum + parseFloat(item.price) * item.quantity, 0);
    totalAmount = subtotal + ongkir;
    document.getElementById('total-payment').innerText = `Rp ${totalAmount.toLocaleString('id-ID')}`;
  });

  // Kirim bukti pembayaran
  document.getElementById('payment-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('order', orderId);
    formData.append('bank', document.getElementById('bank').value);
    formData.append('total', totalAmount);
    formData.append('proof_image', document.getElementById('proof_image').files[0]);

    axios.post(`${backendUrl}/api/payment-proof/`, formData, {
      headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'multipart/form-data'
      }
    })
    .then(() => {
      alert('Bukti pembayaran berhasil dikirim.');
      window.location.href = '/status-payment';
    })
    .catch(err => {
      console.error(err.response?.data || err);
      alert('Gagal mengirim bukti pembayaran.');
    });
  });
</script>

@endsection
