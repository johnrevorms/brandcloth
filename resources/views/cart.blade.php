@extends('layouts.app')
@section('title', 'Cart')
@section('content')

<div class="w-full max-w-4xl mx-auto mt-10 px-4">
  <div class="bg-black rounded-lg p-6 text-white shadow-md">
    <h2 class="text-3xl font-semibold mb-6">Items in Your Cart</h2>
    <div id="cart-items" class="space-y-4"></div>
    <div class="flex justify-between items-center mt-8 border-t border-gray-300 pt-4">
      <p class="text-xl font-semibold">Total:</p>
      <p id="cart-total" class="text-xl font-semibold">Rp 0</p>
    </div>
    <div class="flex justify-end mt-6">
      <button id="checkout-btn" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-xl">
        Checkout
      </button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
const token = localStorage.getItem('token');

function formatRupiah(number) {
  return 'Rp ' + parseInt(number || 0).toLocaleString('id-ID');
}

function loadCart() {
  axios.get(`${backendUrl}/api/cartitem/`, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  .then(res => {
    const items = res.data;

    if (items.length === 0) {
      document.getElementById('cart-items').innerHTML = '<p class="text-gray-300">Keranjang kamu kosong.</p>';
      document.getElementById('cart-total').innerText = formatRupiah(0);
      return;
    }

    let total = 0;
    let html = '';

    items.forEach(item => {
      const price = parseFloat(item.price) || 0;
      const subtotal = price * item.quantity;
      total += subtotal;

      html += `
        <div class="border-b border-gray-600 pb-3 flex justify-between items-center">
          <div>
            <p class="text-lg font-semibold">${item.product_name} x${item.quantity} (${item.size})</p>
            <p>Harga: ${formatRupiah(price)}</p>
            <p>Subtotal: ${formatRupiah(subtotal)}</p>
          </div>
          <button onclick="deleteItem(${item.id})" class="bg-red-600 hover:bg-red-700 px-4 py-1 rounded-lg text-white">
            Hapus
          </button>
        </div>
      `;
    });

    document.getElementById('cart-items').innerHTML = html;
    document.getElementById('cart-total').innerText = formatRupiah(total);
  })
  .catch(error => {
    console.error('Gagal load keranjang:', error.response?.data || error);
    document.getElementById('cart-items').innerHTML = '<p class="text-red-400">Gagal memuat keranjang.</p>';
  });
}

function deleteItem(itemId) {
  alert('Fitur hapus belum tersedia.');
}

document.getElementById('checkout-btn').addEventListener('click', function () {
    axios.post(`${backendUrl}/api/cart/checkout/`, {}, {
    headers: {
        Authorization: `Bearer ${token}`
    }
    })
    .then(res => {
    const orderId = res.data.order_id;
    alert(res.data.message);
    window.location.href = `/shipping-confirmation?order_id=${orderId}`;
    })

  .catch(err => {
    console.error('Checkout gagal:', err.response?.data || err);
    alert('Checkout gagal. Coba lagi.');
  });
});

if (!token) {
  document.getElementById('cart-items').innerHTML = '<p class="text-red-500">Silakan login terlebih dahulu.</p>';
} else {
  loadCart();
}
</script>

@endsection
