@extends('layouts.app')
@section('title', 'Kelola Produk')

@section('content')
<div class="max-w-6xl mx-auto mt-10 text-white">
  <h2 class="text-3xl font-bold mb-6">Kelola Produk</h2>

  {{-- Form Tambah / Edit Produk --}}
  <form id="product-form" class="bg-gray-800 p-6 rounded-lg shadow space-y-4 mb-8" enctype="multipart/form-data">
    <input type="hidden" id="product_id" />
    <div>
      <label>Nama Produk</label>
      <input type="text" id="name" placeholder="Nama Produk" class="w-full p-2 rounded bg-gray-900 text-white" required>
    </div>
    <div>
      <label>Deskripsi</label>
      <textarea id="description" placeholder="Deskripsi Produk" class="w-full p-2 rounded bg-gray-900 text-white" required></textarea>
    </div>
    <div>
      <label>Harga</label>
      <input type="number" id="price" placeholder="Harga Produk" class="w-full p-2 rounded bg-gray-900 text-white" required>
    </div>
    <div>
      <label>Kategori</label>
      <select id="category" class="w-full p-2 rounded bg-gray-900 text-white" required>
        <option value="">-- Pilih Kategori --</option>
      </select>
    </div>
    <div>
      <label>Gambar Produk</label>
      <input type="file" id="image" class="w-full bg-gray-900 text-white" accept="image/*">
    </div>
    <button type="submit" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded">Simpan</button>
  </form>

  {{-- List Produk --}}
  <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
const token = localStorage.getItem('token');

// 🔃 Muat kategori ke dropdown
function loadCategories() {
  axios.get(`${backendUrl}/api/categories/`)
    .then(res => {
      const categories = res.data;
      const select = document.getElementById('category');
      categories.forEach(c => {
        const option = document.createElement('option');
        option.value = c.id;
        option.textContent = c.name;
        select.appendChild(option);
      });
    })
    .catch(err => {
      console.error('Gagal muat kategori:', err);
    });
}

// 🔃 Muat produk
function loadProducts() {
  axios.get(`${backendUrl}/api/admin/products/`, {
    headers: { Authorization: `Bearer ${token}` }
  }).then(res => {
    const products = res.data;
    let html = '';
    products.forEach(p => {
      html += `
        <div class="bg-gray-800 p-4 rounded shadow">
          <p class="font-bold">${p.name}</p>
          <p>Rp ${parseInt(p.price).toLocaleString('id-ID')}</p>
          <p class="text-sm text-gray-300">${p.description}</p>
          <div class="mt-2 space-x-2">
            <button onclick="editProduct(${p.id})" class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded">Edit</button>
            <button onclick="deleteProduct(${p.id})" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded">Hapus</button>
          </div>
        </div>
      `;
    });
    document.getElementById('product-list').innerHTML = html;
  }).catch(err => {
    console.error('Gagal muat produk:', err);
  });
}

// 📝 Simpan Produk
document.getElementById('product-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData();
  formData.append('name', document.getElementById('name').value);
  formData.append('description', document.getElementById('description').value);
  formData.append('price', document.getElementById('price').value);
  formData.append('category', document.getElementById('category').value);

  const imageInput = document.getElementById('image');
  if (imageInput.files.length > 0) {
    formData.append('image', imageInput.files[0]);
  }

  const productId = document.getElementById('product_id').value;
  const method = productId ? 'patch' : 'post';
  const url = productId
    ? `${backendUrl}/api/admin/products/${productId}/`
    : `${backendUrl}/api/admin/products/`;

  axios({
    method: method,
    url: url,
    data: formData,
    headers: {
      Authorization: `Bearer ${token}`,
      'Content-Type': 'multipart/form-data'
    }
  }).then(() => {
    alert(productId ? 'Produk diperbarui' : 'Produk ditambahkan');
    document.getElementById('product-form').reset();
    document.getElementById('product_id').value = '';
    loadProducts();
  }).catch(err => {
    console.error('Gagal simpan produk:', err);
    alert('Gagal simpan produk');
  });
});

// ✏️ Edit Produk
function editProduct(id) {
  axios.get(`${backendUrl}/api/admin/products/${id}/`, {
    headers: { Authorization: `Bearer ${token}` }
  }).then(res => {
    const p = res.data;
    document.getElementById('product_id').value = p.id;
    document.getElementById('name').value = p.name;
    document.getElementById('description').value = p.description;
    document.getElementById('price').value = p.price;
    document.getElementById('category').value = p.category;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }).catch(err => {
    console.error('Gagal ambil produk:', err);
  });
}

// 🗑️ Hapus Produk
function deleteProduct(id) {
  if (!confirm('Yakin ingin menghapus produk ini?')) return;
  axios.delete(`${backendUrl}/api/admin/products/${id}/`, {
    headers: { Authorization: `Bearer ${token}` }
  }).then(() => {
    alert('Produk dihapus');
    loadProducts();
  }).catch(err => {
    console.error('Gagal hapus produk:', err);
    alert('Gagal hapus produk');
  });
}

// Init
loadCategories();
loadProducts();
</script>
@endsection
