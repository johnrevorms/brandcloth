@extends('layouts.app')

@section('title', 'Refund Policy')

@section('content')
<div class="min-h-screen bg-white flex items-center justify-center px-6 py-16">
  <div class="max-w-3xl text-center">
    <!-- Icon/Ilustrasi -->
    <div class="mb-6">
      <svg class="mx-auto h-16 w-16 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>

    <!-- Judul -->
    <h1 class="text-5xl font-bold text-gray-900 mb-4" style="font-family: 'Bebas Neue';">
      Refund Policy
    </h1>

    <!-- Isi Kebijakan -->
    <p class="text-lg text-gray-700 leading-relaxed">
      If you're not satisfied with your purchase, you may request a refund within <span class="font-semibold text-black">7 days</span>.
      Please ensure the item is <span class="font-semibold text-black">unused</span> and in its <span class="font-semibold text-black">original packaging</span>.
    </p>
  </div>
</div>
@endsection