<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arcanum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">

    {{-- Navbar --}}
    @include('partials.navbar')


    {{-- KONTEN UTAMA --}}
    <main className="w-screen h-screen">
        <img
            className="relative w-[1920] h-[1080] pt-7"
            alt="Free luxury logo"
            src="/images/deskop.png"
        />
    </main>



    {{-- FOOTER --}}
    @include('partials.footer')
</body>
</html>
