@extends('layouts.app')
@section('title', 'Bukti Pembayaran')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4 text-white">
  <h2 class="text-3xl font-bold mb-6">Bukti Pembayaran</h2>

  <div id="payment-container" class="space-y-6">
    <p class="text-gray-400">Memuat data...</p>
  </div>
</div>

{{-- CDN --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
const token = localStorage.getItem('token');

if (!token) {
  document.getElementById('payment-container').innerHTML = '<p class="text-red-500">Token tidak ditemukan. Silakan login.</p>';
} else {
  axios.get('http://127.0.0.1:9000/api/paymentproof/', {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  .then(res => {
    const payments = res.data;
    if (!payments || payments.length === 0) {
      document.getElementById('payment-container').innerHTML = '<p class="text-gray-300">Belum ada bukti pembayaran.</p>';
      return;
    }

    let html = '';
    payments.forEach(item => {
      const imageUrl = item.proof_url || `http://127.0.0.1:9000/media/${item.proof_image}`;
      const totalFormatted = 'Rp ' + parseInt(item.total).toLocaleString('id-ID');
      html += `
        <div class="bg-gray-800 p-5 rounded-lg shadow">
          <p><strong>Order ID:</strong> ${item.order_id || item.order}</p>
          <p><strong>Bank:</strong> ${item.bank}</p>
          <p><strong>Total:</strong> ${totalFormatted}</p>
          <img src="${imageUrl}" alt="Bukti Pembayaran" class="mt-3 w-52 border rounded shadow" />
          <div class="mt-4">
            <a href="/order/${item.order_id || item.order}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
              Lihat Detail Order
            </a>
          </div>
        </div>
      `;
    });

    document.getElementById('payment-container').innerHTML = html;
  })
  .catch(err => {
    console.error('Gagal ambil bukti pembayaran:', err);
    document.getElementById('payment-container').innerHTML = '<p class="text-red-500">Gagal memuat data pembayaran.</p>';
  });
}
</script>
@endsection
