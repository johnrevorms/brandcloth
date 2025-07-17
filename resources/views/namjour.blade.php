@extends('layouts.app')
@section('title', 'Kelola Journal')

@section('content')
<div class="max-w-6xl mx-auto mt-10 text-white">
  <h2 class="text-3xl font-bold mb-6">Kelola Journal</h2>

  {{-- Form Tambah / Edit Journal --}}
  <form id="journal-form" class="bg-gray-800 p-6 rounded-lg shadow space-y-4 mb-8" enctype="multipart/form-data">
    <input type="hidden" id="journal_id" />
    <div>
      <label>Judul</label>
      <input type="text" id="title" placeholder="Judul Journal" class="w-full p-2 rounded bg-gray-900 text-white" required>
    </div>
    <div>
      <label>Deskripsi</label>
      <textarea id="content" placeholder="Deskripsi Journal" class="w-full p-2 rounded bg-gray-900 text-white" required></textarea>
    </div>
    <div>
      <label>Gambar</label>
      <input type="file" id="image" class="w-full bg-gray-900 text-white" accept="image/*">
    </div>
    <button type="submit" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded">Simpan</button>
  </form>

  {{-- List Journal --}}
  <div id="journal-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
const token = localStorage.getItem('token');

// Muat data journal
function loadJournals() {
  axios.get(`${backendUrl}/api/journals/`, {
    headers: { Authorization: `Bearer ${token}` }
  })
  .then(res => {
    const journals = res.data;
    let html = '';
    journals.forEach(j => {
      const imageUrl = j.image?.startsWith('http') ? j.image : `${backendUrl}${j.image}`;
      html += `
        <div class="bg-gray-800 p-4 rounded shadow">
          <img src="${imageUrl}" alt="${j.title}" class="w-full h-48 object-cover rounded mb-2">
          <p class="font-bold">${j.title}</p>
          <p class="text-sm text-gray-300">${j.content}</p>
          <div class="mt-2 space-x-2">
            <button onclick="editJournal(${j.id})" class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded">Edit</button>
            <button onclick="deleteJournal(${j.id})" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded">Hapus</button>
          </div>
        </div>
      `;
    });
    document.getElementById('journal-list').innerHTML = html;
  })
  .catch(err => {
    console.error('Gagal muat journal:', err);
  });
}

// Simpan Journal
document.getElementById('journal-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData();
  formData.append('title', document.getElementById('title').value);
  formData.append('content', document.getElementById('content').value);

  const imageInput = document.getElementById('image');
  if (imageInput.files.length > 0) {
    formData.append('image', imageInput.files[0]);
  }

  const journalId = document.getElementById('journal_id').value;
  const method = journalId ? 'patch' : 'post';
  const url = journalId
    ? `${backendUrl}/api/journals/${journalId}/`
    : `${backendUrl}/api/journals/`;

  axios({
    method: method,
    url: url,
    data: formData,
    headers: {
      Authorization: `Bearer ${token}`,
      'Content-Type': 'multipart/form-data'
    }
  })
  .then(() => {
    alert(journalId ? 'Journal diperbarui' : 'Journal ditambahkan');
    document.getElementById('journal-form').reset();
    document.getElementById('journal_id').value = '';
    loadJournals();
  })
  .catch(err => {
    console.error('Gagal simpan journal:', err);
    alert('Gagal simpan journal');
  });
});

// Edit Journal
function editJournal(id) {
  axios.get(`${backendUrl}/api/journals/${id}/`, {
    headers: { Authorization: `Bearer ${token}` }
  })
  .then(res => {
    const j = res.data;
    document.getElementById('journal_id').value = j.id;
    document.getElementById('title').value = j.title;
    document.getElementById('content').value = j.content;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  })
  .catch(err => {
    console.error('Gagal ambil journal:', err);
  });
}

// Hapus Journal
function deleteJournal(id) {
  if (!confirm('Yakin ingin menghapus journal ini?')) return;
  axios.delete(`${backendUrl}/api/journals/${id}/`, {
    headers: { Authorization: `Bearer ${token}` }
  })
  .then(() => {
    alert('Journal dihapus');
    loadJournals();
  })
  .catch(err => {
    console.error('Gagal hapus journal:', err);
    alert('Gagal hapus journal');
  });
}

// Init
loadJournals();
</script>
@endsection
