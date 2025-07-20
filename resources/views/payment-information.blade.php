@extends('layouts.app')

@section('title', 'Payment Information')

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
  <div class="max-w-2xl text-center space-y-6">
    <!-- Ilustrasi Icon -->
    <div class="fade-in-up">
      <svg class="mx-auto h-16 w-16 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M9 12l2 2 4-4m-2-7a9 9 0 11-6.219 15.75L3 21l1.25-3.781A9 9 0 0112 3z" />
      </svg>
    </div>

    <!-- Judul -->
    <h1 class="text-5xl font-bold text-gray-900 fade-in-up" style="font-family: 'Bebas Neue';">
      Payment Confirmation
    </h1>

    <!-- Isi -->
    <p class="text-lg text-gray-700 leading-relaxed fade-in-up">
      After making payment, please confirm by sending your receipt and order ID via
      <span class="text-green-600 font-semibold">WhatsApp</span> or <span class="text-blue-600 font-semibold">email</span>.<br>
      We'll verify and process your order immediately to ensure fast delivery.
    </p>

    <!-- Tombol WhatsApp (Opsional) -->
    <div class="fade-in-up">
      <a href="https://wa.me/6282391513787" target="_blank"
         class="mt-4 inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg shadow transition transform hover:scale-105">
        Confirm via WhatsApp
      </a>
    </div>
  </div>
</div>
@endsection
