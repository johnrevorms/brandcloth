@extends('layouts.app')
@section('content')
<section class="relative h-screen w-full overflow-hidden">
    <img src="/images/deskop.png" alt="Hero Image" class="absolute top-0 left-0 w-full h-full object-cover z-0" />
</section>
<section class="bg-white text-center py-10">
    <h1 class="text-4xl font-bold">Awareness Beyond Arcana</h1>
    <p class="text-lg mt-4 text-gray-700">Unlock the Mystique, Embrace the Abstract.</p>
</section>
<section class="bg-white py-10 px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-[1200px] mx-auto">
        <img src="/images/model1.png" alt="Product 1" class="w-full h-[300px] object-cover rounded-lg shadow" />
        <img src="/images/model2.png" alt="Product 2" class="w-full h-[300px] object-cover rounded-lg shadow" />
        <img src="/images/model3.png" alt="Product 3" class="w-full h-[300px] object-cover rounded-lg shadow" />
    </div>
</section>
<section class="text-center py-10">
    <a href="/shop" class="inline-block bg-black text-white py-3 px-8 rounded-full text-lg hover:bg-gray-800 transition">Shop Now</a>
</section>
@endsection
