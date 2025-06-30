@extends('layouts.app')
@section('title', 'Admin: Bukti Pembayaran')
@section('content')

<div class="max-w-5xl mx-auto mt-10">
  <h2 class="text-2xl font-bold mb-6">Verifikasi Bukti Pembayaran</h2>
  <div id="proof-list" class="space-y-4">Loading...</div>
</div>

<script>
const backendUrl = 'http://127.0.0.1:9000';
const token = localStorage.getItem('token');

axios.get(`${backendUrl}/admin/payment-proofs/`, {
  headers: { Authorization: `Bearer ${token}` }
}).then(res => {
  const data = res.data;
  let html = '';
  data.forEach(p => {
    html += `
      <div class="border rounded p-4 shadow">
        <p><strong>Order ID:</strong> ${p.order_id}</p>
        <p><strong>User:</strong> ${p.user}</p>
        <p><strong>Bank:</strong> ${p.bank}</p>
        <p><strong>Total:</strong> Rp ${parseInt(p.total).toLocaleString('id-ID')}</p>
        <p><strong>Status:</strong> ${p.status}</p>
        <img src="${p.proof_url}" alt="Bukti" class="w-64 my-2 border">

        <button onclick="verify(${p.order_id})" class="bg-green-600 text-white px-4 py-2 rounded mr-2">Verifikasi</button>
        <input id="resi-${p.order_id}" type="text" placeholder="Input Resi" class="border px-2 py-1 rounded">
        <button onclick="inputResi(${p.order_id})" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Simpan Resi</button>
      </div>
    `;
  });
  document.getElementById('proof-list').innerHTML = html;
}).catch(err => {
  console.error(err);
  alert("Gagal memuat data bukti pembayaran");
});

function verify(orderId) {
  axios.post(`${backendUrl}/admin/verify-payment/${orderId}/`, {}, {
    headers: { Authorization: `Bearer ${token}` }
  }).then(() => {
    alert('Verifikasi berhasil');
    location.reload();
  }).catch(err => {
    console.error(err);
    alert('Gagal verifikasi');
  });
}

function inputResi(orderId) {
  const resi = document.getElementById(`resi-${orderId}`).value;
  if (!resi) return alert('Isi nomor resi dulu');

  axios.post(`${backendUrl}/admin/input-tracking/${orderId}/`, { tracking_number: resi }, {
    headers: { Authorization: `Bearer ${token}` }
  }).then(() => {
    alert('Nomor resi disimpan');
    location.reload();
  }).catch(err => {
    console.error(err);
    alert('Gagal menyimpan resi');
  });
}
</script>

@endsection
