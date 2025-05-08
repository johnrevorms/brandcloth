{{-- resources/views/shop.blade.php --}}
@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="bg-white w-[120] h-[950px] relative overflow-hidden">
  <div class="absolute left-[680px] top-[124px] w-[323px] h-[90px] text-black text-[64px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">
    arc 003
  </div>
  <div class="absolute left-[680px] top-[240px] w-[722px] h-[90px] text-black text-[40px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">
    deskripsi produk
  </div>
  <div class="absolute left-[680px] top-[200px] w-[300px] h-[40px] text-black text-sm font-normal" style="font-family: 'Be Vietnam', Helvetica;">
    Rp 98.000
  </div>
  <div class="absolute left-[680px] top-72 max-w-[610px] text-black text-base font-normal leading-relaxed break-words" style="font-family: 'Be Vietnam', Helvetica;">
    Kolom ini akan diisi dengan deskripsi lengkap mengenai produk yang tersedia...
  </div>
  <img class="w-[354px] h-[538px] absolute left-[200px] top-[130px] object-cover" src="{{ asset('images/h.png') }}" alt="Product Image"/>
  <div class="absolute left-[1500px] top-[690px] w-[1500px] border-t border-black transform rotate-[180deg]" style="transform-origin: 0 0;"></div>
  <div class="absolute left-[20px] top-[650px] w-[321px] h-[38px] text-black text-[32px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">
    RELATED PRODUCT
  </div>

  <!-- Related Category Tabs -->
  <!-- <div class="w-[662px] h-10 absolute left-[365px] top-[46px]">
    <div class="bg-[#d9d9d9] rounded-br-[50px] rounded-bl-[50px] w-full h-full absolute"></div>
    <div class="absolute left-[32.81%] right-[56.82%] text-black text-[25px] font-normal">trousers</div>
    <div class="absolute left-[14.96%] right-[77.03%] text-black text-[25px] font-normal">tshirt</div>
    <div class="absolute left-[53.81%] right-[38.71%] text-black text-[25px] font-normal">jacket</div>
    <div class="absolute left-[71.39%] right-[14.96%] text-black text-[25px] font-normal">accessories</div>
  </div> -->

  <!-- Product Options -->
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

  <!-- Related Product Images -->
  @foreach ([1,2,3,4] as $i)
    <img class="w-[160px] h-[226px] absolute left-[{{ 160 + $i * 160 }}px] top-[710px] object-cover"
         src="{{ asset("images/$i.png") }}" alt="Related Product {{ $i }}"/>
  @endforeach
</div>
@endsection
