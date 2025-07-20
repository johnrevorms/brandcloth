@extends('layouts.app')

@section('title', 'How to Order')

@section('content')
<style>
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
  }
</style>

<div class="min-h-screen bg-white flex items-center justify-center px-6 py-16">
  <div class="max-w-3xl text-center">
    <!-- Ilustrasi Icon -->
    <div class="mb-6 fade-in-up">
      <svg class="mx-auto h-16 w-16 text-green-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M9 12h6m-6 4h6m-7 4h8a2 2 0 002-2V6a2 2 0 00-2-2h-4.586a1 1 0 01-.707-.293l-1.414-1.414A1 1 0 0011.586 2H8a2 2 0 00-2 2v16a2 2 0 002 2z" />
      </svg>
    </div>

    <!-- Judul -->
    <h1 class="text-5xl font-bold text-gray-900 mb-8 fade-in-up" style="font-family: 'Bebas Neue';">
      How to Order
    </h1>

    <!-- Langkah-langkah -->
    <ol class="text-left text-lg text-gray-700 space-y-4">
      @php
          $steps = [
              "Browse our products.",
              "Add your favorite items to the cart.",
              "Proceed to checkout and fill in your details.",
              "Make a payment and wait for confirmation.",
              "Sit back and relax while we ship your order!",
          ];
      @endphp

      @foreach ($steps as $index => $step)
        <li class="fade-in-up transition transform hover:scale-105 hover:text-black hover:font-semibold delay-{{ $index * 100 }}">
          <span class="font-bold text-black">{{ $index + 1 }}.</span> {{ $step }}
        </li>
      @endforeach
    </ol>
  </div>
</div>
@endsection
