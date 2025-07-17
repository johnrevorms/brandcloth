@props(['categories', 'selectedCategory' => null])

<div class="sticky top-[70px] z-40 flex justify-center">
  <div class="flex gap-6 px-4 bg-[#d9d9d9] rounded-b-full rounded-t-none
 shadow-md">
    @foreach ($categories as $cat)
      @php
        $catName = is_array($cat) ? $cat['name'] : $cat->name;
        $isActive = strtolower($selectedCategory) === strtolower($catName);
      @endphp
      <a href="{{ url('/products/' . strtolower($catName)) }}"
         class="px-6 py-2 rounded-full text-[16px] md:text-[18px] uppercase font-bebas transition
                {{ $isActive ? 'bg-white text-black shadow-sm' : 'hover:text-blue-600 text-black' }}">
        {{ $catName }}
      </a>
    @endforeach
  </div>
</div>
