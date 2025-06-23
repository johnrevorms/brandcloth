@extends('layouts.app')
@section('title', 'Shop')
@section('content')

<section class="bg-gray-100 py-20" id="shop">
  <div id="shop-products" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6"></div>
</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';

axios.get(`${backendUrl}/api/products/`)
  .then(response => {
    const products = response.data;
    const container = document.getElementById('shop-products');

    products.forEach(product => {
      const imageUrl = product.image?.startsWith('http')
        ? product.image
        : `${backendUrl}${product.image || '/media/placeholder.jpg'}`;

      const card = document.createElement('div');
      card.className = 'bg-white p-4 rounded-lg shadow-md';
      card.innerHTML = `
        <a href="/produk/${product.id}">
          <img src="${imageUrl}" alt="${product.name}" class="w-full h-[500px] object-contain rounded-md " />
          <div class="mt-2">
            <h3 class="text-xl font-semibold">${product.name}</h3>
            <p class="text-gray-600">Rp ${parseInt(product.price).toLocaleString('id-ID')}</p>
          </div>
        </a>`;
      container.appendChild(card);
    });
  })
  .catch(error => {
    console.error('Gagal mengambil produk:', error);
  });
</script>

@endsection
