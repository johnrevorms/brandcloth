{{-- resources/views/cart.blade.php --}}
@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<div class="bg-white w-full relative flex flex-col items-center pt-24">
  <div class="absolute top-20 left-5 flex items-center">
    <span class="text-black text-6xl md:text-[40px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">Cart</span>
  </div>
  <div class="absolute top-40 left-4 text-black text-7xl md:text-[200px] font-normal">
    Your Shopping Cart
  </div>
  <img class="w-[70%] md:h-[560px] translate-x-0" alt="Cart Banner" src="{{ asset('images/cart-banner.png') }}" />
</div>

<div class="w-full md:w-[900px] mx-auto mt-10">
  <div class="bg-black rounded-lg p-4 text-white">
    <h2 class="text-3xl font-semibold">Items in Your Cart</h2>
    <div class="mt-4 space-y-4">
      <div class="border-b border-white pb-4 flex justify-between">
        <p class="text-xl">Item 1</p>
        <p class="text-xl">$25.00</p>
      </div>
      <div class="border-b border-white pb-4 flex justify-between">
        <p class="text-xl">Item 2</p>
        <p class="text-xl">$45.00</p>
      </div>
      <div class="flex justify-between mt-6">
        <p class="text-xl font-semibold">Total:</p>
        <p class="text-xl font-semibold">$70.00</p>
      </div>
      <div class="mt-6 flex justify-center">
        <button class="bg-primary text-white py-2 px-4 rounded-lg">Proceed to Checkout</button>
      </div>
    </div>
  </div>
</div>
@endsection
