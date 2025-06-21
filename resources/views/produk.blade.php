@extends('layouts.app')
@section('title', 'Produk')
@section('content')

<div class="w-full min-h-screen flex justify-center items-start bg-white overflow-x-auto">
  <div class="relative w-[1200px] h-[950px]">
    <!-- Nama, Harga, Deskripsi -->
    <div class="absolute left-[680px] top-[124px] text-black text-[64px]" style="font-family: 'Bebas Neue', Helvetica;">
      <span id="product-name">Loading...</span>
    </div>
    <div class="absolute left-[680px] top-[200px] text-black text-sm" style="font-family: 'Be Vietnam', Helvetica;">
      <span id="product-price">Rp -</span>
    </div>
    <div class="absolute left-[680px] top-[240px] text-black text-[40px]" style="font-family: 'Bebas Neue', Helvetica;">
      DESKRIPSI PRODUK
    </div>
    <div class="absolute left-[680px] top-72 max-w-[610px] text-black text-base" style="font-family: 'Be Vietnam', Helvetica;">
      <span id="product-desc">Loading...</span>
    </div>

    <!-- Gambar Produk -->
    <img id="product-image" class="w-[354px] h-[538px] absolute left-[200px] top-[130px] object-cover" src="/images/placeholder.png" alt="Product Image"/>

    <!-- Pilihan Ukuran dan Jumlah -->
    <div class="absolute left-[680px] top-[450px]">
      <select id="size" class="w-[150px] h-[47px] bg-[#d9d9d9] text-black">
        <option disabled selected>SIZE</option>
        <option>S</option><option>M</option><option>L</option><option>XL</option>
      </select>
      <label class="block mt-4 mb-1 text-black">Qty</label>
      <input id="qty" type="number" value="1" min="1" class="w-[150px] h-[47px]">
      <div class="flex gap-3 mt-6">
        <button class="buy-button w-[91px] h-[47px] bg-[#d9d9d9]">BUY</button>
        <button id="add-to-cart-btn" class="w-[184px] h-[47px] bg-[#d9d9d9] flex items-center justify-center gap-2">
          <span>ADD TO CART</span>
        </button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
document.addEventListener('DOMContentLoaded', function () {
  const productId = parseInt(window.location.pathname.split('/').pop());
  console.log("Product ID:", productId);

  if (isNaN(productId)) {
    alert("Produk tidak ditemukan: ID tidak valid.");
    return;
  }

  const token = localStorage.getItem('token');

  // Ambil data produk
  axios.get(`${backendUrl}/api/products/${productId}/`)
    .then(response => {
      const data = response.data;
      console.log("DATA PRODUK:", data);

      document.getElementById('product-name').innerText = data.name;
      document.getElementById('product-price').innerText = 'Rp ' + parseInt(data.price).toLocaleString('id-ID');
      document.getElementById('product-desc').innerText = data.description;

      const imageUrl = data.image
        ? (data.image.startsWith('http') ? data.image : backendUrl + data.image)
        : '/images/placeholder.png';

      document.getElementById('product-image').src = imageUrl;
    })
    .catch(err => {
      console.error('Gagal ambil produk:', err);
      alert('Gagal memuat produk. Silakan cek kembali.');
    });

  // Tombol Buy
  document.querySelector('.buy-button').addEventListener('click', () => {
    if (!token) return alert('Silakan login terlebih dahulu.');
    const size = document.getElementById('size').value;
    const quantity = parseInt(document.getElementById('qty').value || '1');
    const priceText = document.getElementById('product-price').innerText;
    const price = parseFloat(priceText.replace(/[^\d]/g, ''));

    if (!size || size === 'SIZE') return alert('Pilih ukuran terlebih dahulu.');

    const orderData = {
      status: 'pending',
      items: [{
        product: productId,
        quantity: quantity,
        size: size,
        price: price
      }]
    };

    axios.post(`${backendUrl}/api/orders/`, orderData, {
      headers: { Authorization: `Bearer ${token}`, 'Content-Type': 'application/json' }
    })
    .then(() => {
      alert('Order berhasil dibuat!');
      window.location.href = '/payment-confirmation';
    })
    .catch(error => {
      console.error('Gagal membuat order:', error.response?.data || error);
      alert('Gagal membuat order.');
    });
  });

  // Tombol Add to Cart
  document.getElementById('add-to-cart-btn').addEventListener('click', () => {
    if (!token) return alert('Silakan login terlebih dahulu.');
    const size = document.getElementById('size').value;
    const quantity = parseInt(document.getElementById('qty').value || '1');
    const priceText = document.getElementById('product-price').innerText;
    const price = parseFloat(priceText.replace(/[^\d]/g, ''));

    if (isNaN(price)) {
      return alert('Harga produk tidak valid.');
    }

    if (!size || size === 'SIZE') return alert('Pilih ukuran terlebih dahulu.');

    const cartData = {
      product: productId,
      quantity: quantity,
      size: size,
      price: price
    };

    axios.post(`${backendUrl}/api/cart/add/`, cartData, {
      headers: { Authorization: `Bearer ${token}`, 'Content-Type': 'application/json' }
    })
    .then(() => {
      alert('Produk berhasil ditambahkan ke keranjang!');
    })
    .catch(error => {
      console.error('Gagal menambahkan ke keranjang:', error.response?.data || error);
      alert('Gagal menambahkan ke keranjang.');
    });
  });
});
</script>
@endsection
