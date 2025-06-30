@extends('layouts.app')
@section('title', 'Status Pembayaran')
@section('content')

<div class="max-w-xl mx-auto mt-20 p-6 bg-white text-center rounded-lg shadow">
  <h2 class="text-2xl font-bold mb-4 text-yellow-600">Menunggu Verifikasi Pembayaran</h2>
  <p class="text-gray-700">Admin sedang memverifikasi pembayaran kamu. Silakan cek halaman <a href="/profile" class="text-blue-600 underline">Profil</a> untuk status terbaru pengiriman.</p>
</div>

@endsection
