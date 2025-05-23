{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="bg-white w-full relative flex flex-col md:flex-row items-center md:items-start pt-24">
  <div class="absolute top-20 left-5 flex items-center md:top-14">
    <span class="text-black text-6xl md:text-[40px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">Member</span>
  </div>
  <div class="absolute top-40 left-4 text-black text-7xl md:text-[200px] font-normal md:top-20" style="font-family: 'Bebas Neue', Helvetica;">
    Profile
  </div>
  <img class="w-[70%] md:h-[560px] translate-x-0" alt="Proyek" src="{{ asset('images/p3.png') }}" />
</div>

<!-- Profile Table -->
<div class="w-full md:w-[400px] h-[595px] bg-black rounded-lg relative p-4 mt-10 md:mt-0 md:absolute md:right-5 md:top-12 md:ml-auto flex flex-col overflow-hidden">
  <img class="w-full h-41 object-cover rounded-t-lg" alt="Mask group" src="{{ asset('images/p2.png') }}" />
  <div class="text-sm text-white mt-4">Member id : <span id="memberId"></span></div>

  <div class="mt-1 space-y-2 flex-2 overflow-auto">
    @foreach (['username' => 'john_doe99', 'name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '+62 812 3456 7890'] as $label => $value)
      <div class="flex items-center">
        <label class="text-white text-lg w-32 capitalize">{{ $label }}</label>
        <textarea class="text-black w-full h-9 bg-gray-300 border-none p-2 rounded-md">{{ $value }}</textarea>
      </div>
    @endforeach
  </div>

  <!-- Order section -->
  <div class="mt-1">
    <div class="text-white text-xl">ORDER</div>
    <img class="w-full h-px bg-white my-2" alt="Vector" src="{{ asset('images/vector-6.svg') }}" />
    <p class="text-white text-center text-lg mt-6">No orders yet<br>Go to store to place an order.</p>
  </div>
</div>
@endsection
