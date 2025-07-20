@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="min-h-screen bg-white pt-24 px-6 flex justify-center">
  <div class="max-w-3xl w-full space-y-6">
    <h1 class="text-5xl font-bold text-gray-900" style="font-family: 'Bebas Neue';">Frequently Asked Questions</h1>

    {{-- FAQ Item 1 --}}
    <details class="border-b pb-4 group">
      <summary class="cursor-pointer text-lg font-semibold text-black-800 flex justify-between items-center">
        <span>Q: How long is delivery?</span>
        <span class="text-xl group-open:rotate-180 transition-transform">⌄</span>
      </summary>
      <p class="mt-2 text-gray-700">A: Usually takes 3–5 business days.</p>
    </details>

    {{-- FAQ Item 2 --}}
    <details class="border-b pb-4 group">
      <summary class="cursor-pointer text-lg font-semibold text-black-800 flex justify-between items-center">
        <span>Q: Can I return an item?</span>
        <span class="text-xl group-open:rotate-180 transition-transform">⌄</span>
      </summary>
      <p class="mt-2 text-gray-700">A: Yes, within 7 days.</p>
    </details>

    {{-- FAQ Item 3 --}}
    <details class="border-b pb-4 group">
      <summary class="cursor-pointer text-lg font-semibold text-black-800 flex justify-between items-center">
        <span>Q: Do you ship internationally?</span>
        <span class="text-xl group-open:rotate-180 transition-transform">⌄</span>
      </summary>
      <p class="mt-2 text-gray-700">A: Yes, we ship worldwide.</p>
    </details>
  </div>
</div>
@endsection
