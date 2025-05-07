{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="bg-white w-full relative flex flex-col items-center pt-24">
  <div class="absolute top-20 left-5 flex items-center">
    <span class="text-black text-6xl md:text-[40px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">About Us</span>
  </div>
  <div class="absolute top-40 left-4 text-black text-7xl md:text-[200px] font-normal">
    Who We Are
  </div>
  <img class="w-[70%] md:h-[560px] translate-x-0" alt="About Banner" src="{{ asset('images/about-banner.png') }}" />
</div>

<div class="w-full md:w-[900px] mx-auto mt-10">
  <div class="bg-black rounded-lg p-4 text-white">
    <h2 class="text-3xl font-semibold">Our Mission</h2>
    <p class="mt-4">We are a brand that strives to create high-quality, unique products that express individual style. We believe in authenticity and creativity in every piece we produce.</p>
    <h3 class="mt-6 text-2xl font-semibold">Our Values</h3>
    <ul class="mt-2 space-y-2">
      <li>- Creativity and Innovation</li>
      <li>- Quality Craftsmanship</li>
      <li>- Customer Satisfaction</li>
    </ul>
  </div>
</div>
@endsection
