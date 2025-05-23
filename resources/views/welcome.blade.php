@extends('layouts.app')

@section('content')
    <!-- Bagian Hero -->
    {{-- Gambar Utama --}}
    <section class="relative h-screen w-full overflow-hidden">
        <img src="/images/deskop.png" alt="Hero Image" class="absolute top-0 left-0 w-full h-full object-cover z-0" />
    </section>

    {{-- Tulisan Awareness --}}
    <section class="bg-white text-center py-10">
        <h1 class="text-4xl font-bold">Awareness Beyond Arcana</h1>
        <p class="text-lg mt-4 text-gray-700">Unlock the Mystique, Embrace the Abstract.</p>
    </section>

    {{-- Beberapa Foto Produk --}}
    <section class="bg-white py-10 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-[1200px] mx-auto">
            <img src="/images/model1.png" alt="Product 1" class="w-full h-[300px] object-cover rounded-lg shadow" />
            <img src="/images/model2.png" alt="Product 2" class="w-full h-[300px] object-cover rounded-lg shadow" />
            <img src="/images/model3.png" alt="Product 3" class="w-full h-[300px] object-cover rounded-lg shadow" />
        </div>
    </section>

    {{-- Tombol Shop --}}
    <section class="text-center py-10">
        <a href="#shop" class="inline-block bg-black text-white py-3 px-8 rounded-full text-lg hover:bg-gray-800 transition">
            Shop Now
        </a>
    </section>

    <!-- Bagian Shop dan Produk -->
    <section class="bg-gray-100 py-20" id="shop">
        <div class="max-w-[1440px] mx-auto text-center mb-12">
            <h2 class="text-4xl font-bold">Shop Our Collection</h2>
            <p class="text-xl mt-4">Exclusive streetwear designs for the modern generation.</p>
        </div>

        <div id="shop-products" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6">
            <!-- Produk akan dimasukkan secara dinamis di sini -->
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        axios.get('/api/products')
            .then(response => {
                const products = response.data;
                const container = document.getElementById('shop-products');

                products.forEach(product => {
                    const card = document.createElement('div');
                    card.className = 'bg-white p-4 rounded-lg shadow-md';

                    card.innerHTML = `
                        <img src="${product.image ? '/storage/' + product.image : '/images/product-placeholder.png'}"
                            alt="${product.name}"
                            class="w-full h-[400x] object-cover rounded-md" />
                        <div class="mt-2">
                            <h3 class="text-xl font-semibold">${product.name}</h3>
                            <p class="text-gray-600">Rp ${product.price.toLocaleString('id-ID')}</p>
                        </div>
                    `;
                    container.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Gagal mengambil produk:', error);
            });
    </script>

@endsection
