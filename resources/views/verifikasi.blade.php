@extends('layouts.app')
@section('title', 'Verifikasi Pembayaran')
@section('content')

<section class="bg-white py-5">
  <div class="max-w-7xl mx-auto px-6">
</section>

<div class="w-full max-w-7xl mx-auto mt-10 p-6 bg-black text-white rounded">
  <h2 class="text-3xl font-semibold mb-4 text-center">Verifikasi Bukti Pembayaran</h2>

  <!-- Tombol ke halaman konfirmasi -->
  <div class="mb-6 text-center">
    <a href="/konfirmasi"
       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
      Lihat Order untuk Dikonfirmasi
    </a>
  </div>

  <div id="admin-verifikasi">Loading...</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
const token = localStorage.getItem('token');

if (!token) {
  document.getElementById('admin-verifikasi').innerHTML = '<p class="text-red-500 text-center">Anda belum login.</p>';
} else {
  axios.get(`${backendUrl}/api/user/`, {
    headers: { Authorization: `Bearer ${token}` }
  })
  .then(res => {
    const user = res.data;

    if (!user.is_staff) {
      document.getElementById('admin-verifikasi').innerHTML = '<p class="text-red-500 text-center">Hanya admin yang dapat mengakses halaman ini.</p>';
      return;
    }

    axios.get(`${backendUrl}/admin/payment-proofs/`, {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(res => {
      const data = res.data;
      if (data.length === 0) {
        document.getElementById('admin-verifikasi').innerHTML = '<p class="text-center text-gray-300">Belum ada bukti pembayaran.</p>';
        return;
      }

      let html = `
        <div class="overflow-auto">
          <table class="min-w-full bg-white text-black rounded shadow text-sm">
            <thead class="bg-gray-200 uppercase tracking-wider text-left">
              <tr>
                <th class="px-4 py-2">Order ID</th>
                <th class="px-4 py-2">User</th>
                <th class="px-4 py-2">Bank</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Bukti</th>
                <th class="px-4 py-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
      `;

      data.forEach(item => {
        const formattedTotal = 'Rp ' + item.total.toLocaleString('id-ID');
        const formattedDate = new Date(item.created_at).toLocaleString('id-ID');
        const imageUrl = `${backendUrl}/media/${item.proof_image}`;

        html += `
          <tr class="border-b">
            <td class="px-4 py-2">${item.order}</td>
            <td class="px-4 py-2">${item.user}</td>
            <td class="px-4 py-2">${item.bank}</td>
            <td class="px-4 py-2">${formattedTotal}</td>
            <td class="px-4 py-2">${formattedDate}</td>
            <td class="px-4 py-2">
              <img src="${imageUrl}" class="w-32 border rounded" />
            </td>
            <td class="px-4 py-2">
              ${item.verified ? `
                <span class="text-green-600 font-semibold">✔ Sudah diverifikasi</span>
              ` : `
                <button onclick="verifikasi(${item.order})"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                  Verifikasi
                </button>
              `}
            </td>
          </tr>
        `;
      });

      html += `</tbody></table></div>`;
      document.getElementById('admin-verifikasi').innerHTML = html;
    })
    .catch(err => {
      console.error('Gagal load payment proofs:', err);
      document.getElementById('admin-verifikasi').innerHTML = '<p class="text-red-500">Gagal memuat data pembayaran.</p>';
    });
  })
  .catch(err => {
    console.error('Gagal ambil user:', err);
    document.getElementById('admin-verifikasi').innerHTML = '<p class="text-red-500">Gagal mengakses data pengguna.</p>';
  });
}

function verifikasi(orderId) {
  if (!confirm("Yakin ingin memverifikasi pembayaran ini?")) return;

  axios.post(`${backendUrl}/api/payment/verify/${orderId}/`, {}, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  .then(() => {
    alert("Pembayaran berhasil diverifikasi.");
    location.reload();
  })
  .catch(err => {
    console.error("Gagal verifikasi:", err);
    alert("Gagal memverifikasi pembayaran.");
  });
}
</script>

<section class="bg-white py-5">
  <div class="max-w-7xl mx-auto px-6">
</section>

@endsection
