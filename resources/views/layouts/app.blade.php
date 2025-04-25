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
    @yield('content')

    {{-- FOOTER --}}
    @include('partials.footer')
</body>
</html>
