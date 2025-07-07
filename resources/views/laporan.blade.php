@extends('layouts.app')
@section('title', 'Laporan Owner')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4 text-white">

  <h2 class="text-3xl font-bold mb-6">Laporan Penjualan Brandcloth</h2>

  {{-- Tombol Export --}}
  <div class="flex justify-end gap-4 mb-4">
    <button onclick="exportToExcel()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Export Excel</button>
  </div>

  {{-- START: Semua yang ingin diekspor masuk ke sini --}}
  <div id="laporan-export" class="space-y-8">

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="summary-cards">
      {{-- Diisi oleh JS --}}
    </div>

    {{-- Produk Terlaris --}}
    <div class="bg-gray-800 p-6 rounded-lg shadow">
      <h3 class="text-2xl font-semibold mb-4">Top 5 Produk Terlaris</h3>
      <table class="w-full text-left text-sm text-gray-300 border" id="top-products-table">
        <thead class="bg-gray-700 text-gray-100">
          <tr>
            <th class="py-2 px-4 border">#</th>
            <th class="py-2 px-4 border">Nama Produk</th>
            <th class="py-2 px-4 border">Terjual</th>
          </tr>
        </thead>
        <tbody id="top-products" class="divide-y divide-gray-700">
          {{-- Diisi oleh JS --}}
        </tbody>
      </table>
    </div>

  </div>
  {{-- END: laporan-export --}}
</div>

{{-- CDN --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
const token = localStorage.getItem('token');
if (!token) {
  document.getElementById('summary-cards').innerHTML = '<p class="text-red-500">Token tidak ditemukan. Silakan login sebagai admin.</p>';
} else {
  axios.get('http://127.0.0.1:9000/api/full-report/', {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  .then(res => {
    const data = res.data;

    // Summary Cards
    const cards = [
      { label: 'Total User', value: data.total_users },
      { label: 'Total Produk', value: data.total_products },
      { label: 'Total Order Sukses', value: data.total_orders },
      { label: 'Total Pendapatan', value: `Rp ${parseInt(data.total_revenue).toLocaleString('id-ID')}` }
    ];

    let cardHTML = '';
    cards.forEach(c => {
      cardHTML += `
        <div class="bg-gray-800 rounded-xl p-5 shadow">
          <p class="text-sm text-gray-400">${c.label}</p>
          <p class="text-2xl font-bold mt-2">${c.value}</p>
        </div>
      `;
    });
    document.getElementById('summary-cards').innerHTML = cardHTML;

    // Top Products Table
    const tbody = document.getElementById('top-products');
    data.top_products.forEach((item, index) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td class="py-2 px-4 border">${index + 1}</td>
        <td class="py-2 px-4 border">${item.product__name}</td>
        <td class="py-2 px-4 border">${item.total_sold} pcs</td>
      `;
      tbody.appendChild(row);
    });
  })
  .catch(err => {
    console.error("Gagal mengambil laporan:", err);
    document.getElementById('summary-cards').innerHTML = '<p class="text-red-500">Gagal mengambil data laporan.</p>';
  });
}

// Export Excel: ringkasan + tabel top produk
function exportToExcel() {
  const data = [];

  // Ringkasan
  const summaryCards = document.querySelectorAll('#summary-cards > div');
  data.push(["Laporan Ringkasan"]);
  summaryCards.forEach(card => {
    const label = card.querySelector('p.text-sm')?.innerText;
    const value = card.querySelector('p.text-2xl')?.innerText;
    if (label && value) {
      data.push([label, value]);
    }
  });

  data.push([]);
  data.push(["Top Produk Terlaris"]);
  data.push(["No", "Nama Produk", "Jumlah Terjual"]);

  const rows = document.querySelectorAll('#top-products tr');
  rows.forEach(row => {
    const cols = row.querySelectorAll('td');
    if (cols.length === 3) {
      data.push([
        cols[0].innerText,
        cols[1].innerText,
        cols[2].innerText
      ]);
    }
  });

  const ws = XLSX.utils.aoa_to_sheet(data);
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, "Laporan Brandcloth");
  XLSX.writeFile(wb, `laporan_brandcloth_${new Date().toISOString().slice(0,10)}.xlsx`);
}
</script>
@endsection
