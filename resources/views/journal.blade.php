{{-- resources/views/journal.blade.php --}}
@extends('layouts.app')

@section('title', 'Journal')

@section('content')
<div class="bg-white w-full relative flex flex-col items-center pt-24">
  <div class="absolute top-20 left-5 flex items-center">
    <span class="text-black text-6xl md:text-[40px] font-normal" style="font-family: 'Bebas Neue', Helvetica;">Journal</span>
  </div>
  <div class="absolute top-40 left-4 text-black text-7xl md:text-[200px] font-normal">
    Our Stories
  </div>
  <img class="w-[70%] md:h-[560px] translate-x-0" alt="Journal Banner" src="{{ asset('images/journal-banner.png') }}" />
</div>

<div class="w-full md:w-[900px] mx-auto mt-10">
  <div class="bg-black rounded-lg p-4 text-white">
    <h2 class="text-3xl font-semibold">Latest Journal Entries</h2>
    <div class="mt-4 space-y-4">
      <div class="border-b border-white pb-4">
        <h3 class="text-2xl">Journal Entry 1</h3>
        <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lacinia purus non massa pretium, nec pretium orci sollicitudin.</p>
      </div>
      <div class="border-b border-white pb-4">
        <h3 class="text-2xl">Journal Entry 2</h3>
        <p class="mt-2">Sed sit amet nisl orci. Nullam malesuada et magna in eleifend. Fusce ac justo non neque dictum efficitur.</p>
      </div>
    </div>
  </div>
</div>
@endsection
