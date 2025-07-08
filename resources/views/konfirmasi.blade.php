@extends('layouts.app')
@section('title', 'Konfirmasi Pembayaran')
@section('content')

<section class="bg-white py-5">
  <div class="max-w-7xl mx-auto px-6">
</section>

<div class="w-full max-w-7xl mx-auto mt-10 p-6 bg-black text-white rounded">
  <h2 class="text-3xl font-semibold mb-4 text-center">Daftar Order Menunggu Verifikasi</h2>
  <div id="konfirmasi-content">Loading...</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
const token = localStorage.getItem('token');

if (!token) {
  document.getElementById('konfirmasi-content').innerHTML = '<p class="text-red-500 text-center">Anda belum login.</p>';
} else {
  axios.get(`${backendUrl}/api/user/`, {
    headers: { Authorization: `Bearer ${token}` }
  })
  .then(res => {
    const user = res.data;

    if (!user.is_staff) {
      document.getElementById('konfirmasi-content').innerHTML = '<p class="text-red-500 text-center">Hanya admin yang bisa mengakses halaman ini.</p>';
      return;
    }

    // Ambil semua order
    axios.get(`${backendUrl}/api/orders/`, {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(res => {
      const orders = res.data;

      // Filter order yang statusnya waiting_verification
      const filtered = orders.filter(order => order.status === 'waiting_verification');

      if (filtered.length === 0) {
        document.getElementById('konfirmasi-content').innerHTML = '<p class="text-center text-gray-300">Tidak ada order yang menunggu verifikasi.</p>';
        return;
      }

      let html = `
        <div class="overflow-auto">
          <table class="min-w-full bg-white text-black rounded shadow text-sm">
            <thead class="bg-gray-200 uppercase tracking-wider text-left">
              <tr>
                <th class="px-4 py-2">Order ID</th>
                <th class="px-4 py-2">Pemesan</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
      `;

      filtered.forEach(order => {
        const formattedDate = new Date(order.created_at).toLocaleString('id-ID');
        const formattedTotal = 'Rp ' + order.total.toLocaleString('id-ID');

        html += `
          <tr class="border-b">
            <td class="px-4 py-2">${order.id}</td>
            <td class="px-4 py-2">${order.user}</td>
            <td class="px-4 py-2">${formattedTotal}</td>
            <td class="px-4 py-2">${formattedDate}</td>
            <td class="px-4 py-2">
              <a href="http://127.0.0.1:9000/admin/brandcloth/order/${order.id}/change/"
                 target="_blank"
                 class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                Konfirmasi / ACC
              </a>
            </td>
          </tr>
        `;
      });

      html += `</tbody></table></div>`;
      document.getElementById('konfirmasi-content').innerHTML = html;
    })
    .catch(err => {
      console.error('Gagal ambil data order:', err);
      document.getElementById('konfirmasi-content').innerHTML = '<p class="text-red-500">Gagal memuat daftar order.</p>';
    });
  })
  .catch(err => {
    console.error('Gagal fetch user:', err);
    document.getElementById('konfirmasi-content').innerHTML = '<p class="text-red-500">Gagal memuat data pengguna.</p>';
  });
}
</script>

<section class="bg-white py-5">
  <div class="max-w-7xl mx-auto px-6">
</section>

@endsection
