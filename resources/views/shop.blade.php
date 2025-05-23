@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="bg-white w-[120] h-[950px] relative overflow-hidden">
  <!-- Nama Produk -->
  <div class="absolute left-[680px] top-[124px] w-[323px] h-[90px] text-black text-[64px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">
    <span id="product-name">arc 003</span>
  </div>

  <!-- Harga Produk -->
  <div class="absolute left-[680px] top-[200px] w-[300px] h-[40px] text-black text-sm font-normal" style="font-family: 'Be Vietnam', Helvetica;">
    <span id="product-price">Rp 98.000</span>
  </div>

  <!-- Deskripsi Singkat -->
  <div class="absolute left-[680px] top-[240px] w-[722px] h-[90px] text-black text-[40px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">
    deskripsi produk
  </div>

  <!-- Deskripsi Lengkap -->
  <div class="absolute left-[680px] top-72 max-w-[610px] text-black text-base font-normal leading-relaxed break-words" style="font-family: 'Be Vietnam', Helvetica;">
    <span id="product-desc">Kolom ini akan diisi dengan deskripsi lengkap mengenai produk yang tersedia...</span>
  </div>

  <!-- Gambar Produk -->
  <img id="product-image" class="w-[354px] h-[538px] absolute left-[200px] top-[130px] object-cover" src="{{ asset('images/h.png') }}" alt="Product Image"/>

  <div class="absolute left-[1500px] top-[690px] w-[1500px] border-t border-black transform rotate-[180deg]" style="transform-origin: 0 0;"></div>

  <!-- Label Related -->
  <div class="absolute left-[20px] top-[650px] w-[321px] h-[38px] text-black text-[32px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">
    RELATED PRODUCT
  </div>

  <!-- Pilihan Produk -->
  <div class="absolute left-[680px] top-[450px] w-[370px] h-[270px]">
    <select class="w-[150px] h-[47px] bg-[#d9d9d9] px-2 text-[25px] text-black">
      <option disabled selected>SIZE</option>
      <option>S</option><option>M</option><option>L</option><option>XL</option>
    </select>

    <label class="block mt-4 mb-1 text-black text-2xl font-normal">Qty</label>
    <input type="number" value="1" min="1" class="w-[150px] h-[47px] px-3 text-[25px] border border-[#d9d9d9]">

    <div class="flex gap-3 mt-6">
      <button class="w-[91px] h-[47px] bg-[#d9d9d9] text-black text-[20px] font-normal">BUY</button>
      <button class="w-[184px] h-[47px] bg-[#d9d9d9] text-black text-[20px] font-normal flex items-center justify-center gap-2">
        <span>ADD TO CART</span>
        <img src="{{ asset('images/keranjang.png') }}" class="w-[30px] h-[25px]" alt="Cart">
      </button>
    </div>
  </div>

  <!-- Related Product Images Dummy -->
  @foreach ([1,2,3,4] as $i)
    <img class="w-[160px] h-[226px] absolute left-[{{ 160 + $i * 160 }}px] top-[710px] object-cover"
         src="{{ asset("images/$i.png") }}" alt="Related Product {{ $i }}"/>
  @endforeach
</div>

{{-- Axios untuk ambil data produk dari backend Django --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const productId = 1; // Ganti sesuai ID produk yang ingin ditampilkan
  const apiUrl = `http://192.168.18.215:8000/api/products/${productId}/`; // Sudah benar

  axios.get(apiUrl)
    .then(response => {
      const data = response.data;
      document.getElementById('product-name').innerText = data.name;
      document.getElementById('product-price').innerText = 'Rp ' + parseInt(data.price).toLocaleString('id-ID');
      document.getElementById('product-desc').innerText = data.description;
      document.getElementById('product-image').src = data.image; // PENTING: data.image sudah full URL
    })
    .catch(error => {
      console.error('Gagal mengambil data produk:', error);
    });
</script>
@endsection
