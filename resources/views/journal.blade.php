@extends('layouts.app')

@section('title', 'Journal')

@section('content')
<div class="min-h-screen bg-white pt-24 px-6 md:px-16">
  <h1 class="text-5xl font-bold text-black mb-8" style="font-family: 'Bebas Neue';">
    Brand Journey Journal
  </h1>
  <p class="text-lg text-gray-700 mb-12 max-w-3xl">
    Temukan kisah perjalanan brand kami, mulai dari proses kreatif, produksi, hingga cerita di balik rilis setiap koleksi.
  </p>

  <div id="journal-cards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Cards akan dimuat melalui JavaScript -->
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const backendUrl = 'http://192.168.162.215:8000';
  const apiUrl = `${backendUrl}/api/journals/`;

  axios.get(apiUrl)
    .then(response => {
      const journals = response.data;
      const container = document.getElementById('journal-cards');

      if (!Array.isArray(journals) || journals.length === 0) {
        container.innerHTML = '<p class="text-gray-600">Belum ada jurnal yang tersedia.</p>';
        return;
      }

      journals.forEach(item => {
        const card = document.createElement('div');
        card.className = 'bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200';

        card.innerHTML = `
          <img src="${item.image.startsWith('http') ? item.image : backendUrl + item.image}" class="w-full h-48 object-cover" alt="Journal Image">
          <div class="p-5">
            <h2 class="text-2xl font-bold mb-2" style="font-family: 'Bebas Neue';">${item.title}</h2>
            <p class="text-sm text-gray-600 mb-3">${new Date(item.date).toLocaleDateString('id-ID')}</p>
            <p class="text-gray-800 text-base">${item.description}</p>
          </div>
        `;

        container.appendChild(card);
      });
    })
    .catch(error => {
      console.error('Gagal memuat jurnal:', error);
      document.getElementById('journal-cards').innerHTML =
        '<p class="text-red-500">Terjadi kesalahan saat memuat jurnal. Silakan coba lagi nanti.</p>';
    });
});
</script>
@endsection

