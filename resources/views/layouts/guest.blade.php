<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-teal-900">
        <div>
            <a href="/">
                <img src="{{ asset('assets/images/logo_unu.png') }}" alt="logo unukaltim" class="w-48 h-48">
            </a>
        </div>

        <div class="w-full sm:max-w-3xl mt-3 px-6 pb-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <footer class="mt-8 text-center">
            <p class="text-sm text-white">Copyright © 2025 Universitas Nahdlatul Ulama Kalimantan Timur</p>
        </footer>
    </div>
</body>

</html>
