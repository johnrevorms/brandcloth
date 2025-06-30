@extends('layouts.app')
@section('title', 'Journal')
@section('content')

<section class="bg-black py-20 min-h-screen" id="journal">
  <div class="max-w-7xl mx-auto px-6">
    <div id="journal-cards" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <!-- Kartu journal akan dimasukkan lewat JS -->
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';

axios.get(`${backendUrl}/api/journals/`)
  .then(response => {
    const journals = response.data;
    const container = document.getElementById('journal-cards');

    if (!Array.isArray(journals) || journals.length === 0) {
      container.innerHTML = '<p class="text-white">Belum ada jurnal tersedia.</p>';
      return;
    }

    journals.forEach(journal => {
      const imageUrl = journal.image?.startsWith('http')
        ? journal.image
        : `${backendUrl}${journal.image || '/media/placeholder.jpg'}`;

      const card = document.createElement('div');
      card.className = 'rounded-xl overflow-hidden shadow-md transition-transform transform hover:scale-105';
      card.innerHTML = `
        <a href="/journal/${journal.id}">
          <img src="${imageUrl}" alt="Journal Image" class="w-full h-[250px] object-cover" />
        </a>
      `;
      container.appendChild(card);
    });
  })
  .catch(error => {
    console.error('Gagal mengambil data jurnal:', error);
  });
</script>

@endsection
