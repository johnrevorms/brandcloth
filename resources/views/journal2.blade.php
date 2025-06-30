@extends('layouts.app')
@section('title', 'Journal')
@section('content')
<section class="bg-black py-20 min-h-screen" id="journal">
<div class="w-full min-h-screen bg-black px-6 py-20 flex justify-center relative z-[100]">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-y-16 md:gap-x-20 max-w-6xl w-full items-start">

    <!-- Gambar -->
    <div class="bg-[#111111] rounded-2xl shadow-lg w-full max-w-[800px] mx-auto md:mx-0">
      <img id="journal-image" src="/images/placeholder.png" alt="Journal Image"
        class="w-full h-auto object-contain rounded-2xl" />
    </div>

    <!-- Teks -->
    <div class="text-white w-full max-w-[800px] mx-auto md:mx-0 px-6">
      <h1 id="journal-title" class="text-5xl uppercase font-['Bebas Neue'] mb-1">
        Loading...
      </h1>
      <p id="journal-content" class="text-base leading-relaxed font-sans">
        Loading konten...
      </p>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const backendUrl = 'http://127.0.0.1:9000';
  const journalId = {{ $journalId }};

  axios.get(`${backendUrl}/api/journals/${journalId}/`)
    .then(response => {
      const data = response.data;
      document.getElementById('journal-title').innerText = data.title;
      document.getElementById('journal-content').innerText = data.content;

      const imageUrl = data.image
        ? (data.image.startsWith('http') ? data.image : backendUrl + data.image)
        : '/images/placeholder.png';

      document.getElementById('journal-image').src = imageUrl;
    })
    .catch(error => {
      console.error('Gagal memuat jurnal:', error);
      alert('Gagal memuat data jurnal. Silakan periksa koneksi atau backend.');
    });
</script>

@endsection
