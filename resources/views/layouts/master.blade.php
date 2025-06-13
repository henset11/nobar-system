<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Pesan tiket nonton bareng, bareng Dunia Prestasi dengan mudah! Sistem ticketing khusus untuk event edukatif, seminar, & nonton bareng siswa Dunia Prestasi.">
    <meta property="og:image" content="{{ asset('/storage/system/featured-image.jpg') }}" />
    <link rel="shortcut icon" href="{{ asset('/storage/system/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/output.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    @vite('resources/css/app.css')

    <title>@yield('title')</title>

    @stack('head-scripts')
</head>

<body>
    <x-impersonate::banner />
    <div id="Content-Container"
        class="relative flex flex-col w-full max-w-[640px] min-h-screen mx-auto overflow-x-hidden bg-white  dark:bg-[#101828] text-[#030712] dark:text-[#fff]">

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/toast.js') }}"></script>
    @stack('scripts')
    @vite('resources/js/app.js')
</body>

</html>
