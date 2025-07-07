@extends('layouts.app')
@section('title', 'Verifikasi Pembayaran')
@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
  <h2 class="text-2xl font-bold mb-6">Verifikasi Pembayaran</h2>
  <div id="payment-list">Loading...</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const backendUrl = 'http://127.0.0.1:9000';
  const token = localStorage.getItem('token');

  axios.get(`${backendUrl}/api/admin/payment-proofs/`, {
    headers: { Authorization: `Bearer ${token}` }
  })
  .then(res => {
    const data = res.data;
    let html = '';
    if (data.length === 0) {
      html = '<p>Tidak ada data pembayaran.</p>';
    } else {
      data.forEach(item => {
        html += `
          <div class="border p-4 mb-4 rounded">
            <p><strong>Order ID:</strong> ${item.order}</p>
            <p><strong>Bank:</strong> ${item.bank}</p>
            <p><strong>Total:</strong> Rp ${parseInt(item.total).toLocaleString('id-ID')}</p>
            <p><strong>Upload:</strong><br><img src="${backendUrl}${item.proof_image}" class="w-40 my-2 rounded shadow" /></p>
            <button onclick="verifyPayment(${item.order})" class="bg-green-600 text-white px-4 py-2 rounded mr-2">Verifikasi</button>
            <button onclick="setTracking(${item.order})" class="bg-blue-600 text-white px-4 py-2 rounded">Isi Resi</button>
          </div>
        `;
      });
    }
    document.getElementById('payment-list').innerHTML = html;
  });

  function verifyPayment(orderId) {
    axios.post(`${backendUrl}/api/admin/payment-proofs/${orderId}/verify/`, {}, {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(() => {
      alert('Pembayaran diverifikasi.');
      location.reload();
    });
  }

  function setTracking(orderId) {
    const tracking = prompt('Masukkan Nomor Resi:');
    if (!tracking) return;
    axios.post(`${backendUrl}/api/admin/payment-proofs/${orderId}/set_tracking/`, {
      tracking_number: tracking
    }, {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(() => {
      alert('Nomor resi berhasil disimpan.');
      location.reload();
    });
  }
</script>
@endsection
