{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="bg-black flex flex-row justify-center w-full">
  <div class="bg-black w-[1440px] h-[1003px]">
    <div class="relative w-[1419px] h-[869px] top-[134px]">
      <img
        class="absolute w-[753px] h-[833px] top-9 left-0 object-cover"
        alt="Proyek"
        src="/images/proyek246.png"
      />
      <img
        class="absolute w-[317px] h-[211px] top-0 left-[561px] object-cover"
        alt="Logo ARCANUM"
        src="/images/logofooter.png"
      />
      <p class="absolute w-[733px] top-[250px] left-[686px] font-sans text-white leading-relaxed text-sm">
        Arcanum is a brand that embodies the essence of mystery, innovation,
        and style. With a passion for creating high-quality products that
        reflect individuality and sophistication, Arcanum stands at the
        intersection of fashion and artistry. Our designs aim to transcend
        the ordinary, offering exclusive collections that resonate with
        those who value both uniqueness and craftsmanship.
        <br /><br />
        Founded on the principles of creativity, sustainability, and
        comfort, Arcanum caters to a diverse audience that seeks bold,
        statement-making fashion. Whether through our premium clothing line
        or curated accessories, Arcanum delivers a distinctive style that
        aligns with modern aesthetics while maintaining timeless appeal.
        <br /><br />
        At Arcanum, we believe that fashion is more than just what you
        wear—it&#39;s about expressing who you are and what you stand for.
        Our products are not just about looking good; they&#39;re about
        feeling empowered, confident, and ready to take on the world with a
        sense of purpose.
        <br /><br />
        Join us on our journey to redefine fashion and self-expression.
        Welcome to Arcanum, where mystery meets style.
      </p>
    </div>
  </div>
</div>
@endsection
