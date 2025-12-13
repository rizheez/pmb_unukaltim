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

{{-- <body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-teal-950 relative overflow-hidden">

        <!-- Background Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-teal-900 via-teal-950 to-black z-0"></div>

        <!-- Decorative Pattern (Dots) -->
        <div class="absolute inset-0 z-0 opacity-10"
            style="background-image: radial-gradient(#2dd4bf 2px, transparent 2px); background-size: 32px 32px;">
        </div>

        <!-- Decorative Glows -->
        <div
            class="absolute top-[-10%] left-[-20%] w-[500px] h-[500px] bg-teal-500/20 rounded-full blur-[100px] animate-blob">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-20%] w-[500px] h-[500px] bg-teal-600/20 rounded-full blur-[100px] animate-blob animation-delay-4000">
        </div>

        <div class="relative z-10 flex flex-col items-center">
            <a href="/">
                <img src="{{ asset('assets/images/logo_unu.png') }}" alt="logo unukaltim"
                    class="w-32 h-32 sm:w-40 sm:h-40 drop-shadow-2xl hover:scale-105 transition-transform duration-300">
            </a>
        </div>

        <div
            class="w-full sm:max-w-3xl mt-6 px-6 py-4 bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-lg relative z-10 border border-teal-500/30">
            {{ $slot }}
        </div>

        <footer class="mt-8 text-center relative z-10">
            <p class="text-sm text-teal-200/80 font-medium">Copyright © 2025 Universitas Nahdlatul Ulama Kalimantan
                Timur</p>
        </footer>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 10s infinite;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body> --}}

<body class="font-sans text-gray-900 antialiased">
    <div
        class="relative min-h-screen flex flex-col items-center justify-center 
               bg-gradient-to-r from-teal-600 via-teal-700 to-slate-700
               overflow-hidden">
        <!-- Decorative Pattern (Dots) -->
        <div class="absolute inset-0 z-0 opacity-10"
            style="background-image: radial-gradient(#2dd4bf 2px, transparent 2px); background-size: 32px 32px;">
        </div>
        <!-- Background Animation (Circles Only) -->
        <div class="area pointer-events-none">
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

        <!-- Noise Overlay -->
        <div class="noise-overlay"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col items-center w-full px-4">
            <div class="mb-2">
                <a href="/">
                    <img src="{{ asset('assets/images/logo_unu.png') }}" alt="logo unukaltim"
                        class="w-32 h-32 sm:w-36 sm:h-36 drop-shadow-xl">
                </a>
            </div>

            <div
                class="w-full sm:max-w-3xl mt-3 px-6 pb-4
                       bg-white/95 backdrop-blur-xl
                       shadow-2xl sm:rounded-2xl
                       border border-white/10">
                {{ $slot }}
            </div>

            <footer class="mt-8 text-center">
                <p class="text-sm text-white/70">
                    © 2025 Universitas Nahdlatul Ulama Kalimantan Timur
                </p>
            </footer>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        /* ===== CIRCLES BACKGROUND ===== */

        .area {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .circles {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .circles li {
            position: absolute;
            list-style: none;
            display: block;
            background: rgba(67, 192, 175, 0.18);
            width: 20px;
            height: 20px;
            bottom: -150px;
            animation: animate 30s linear infinite;
            border-radius: 6px;
        }

        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-duration: 28s;
        }

        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-duration: 18s;
            animation-delay: 2s;
        }

        .circles li:nth-child(3) {
            left: 70%;
            animation-delay: 4s;
        }

        .circles li:nth-child(4) {
            left: 80%;
            width: 60px;
            height: 60px;
            animation-duration: 22s;
        }

        .circles li:nth-child(5) {
            left: 65%;
        }

        .circles li:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }

        .circles li:nth-child(7) {
            left: 22%;
            width: 140px;
            height: 140px;
            animation-delay: 7s;
        }

        .circles li:nth-child(8) {
            left: 15%;
            width: 25px;
            height: 25px;
            animation-duration: 45s;
        }

        .circles li:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-duration: 35s;
        }

        .circles li:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-duration: 26s;
        }

        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(-1100px) rotate(720deg);
                opacity: 0;
            }
        }

        /* ===== NOISE OVERLAY ===== */

        .noise-overlay {
            pointer-events: none;
            position: absolute;
            inset: 0;
            z-index: 5;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        }

        /* ===== MOBILE ===== */

        @media (max-width: 640px) {
            .circles li {
                opacity: 0.14;
            }

            .circles li:nth-child(7),
            .circles li:nth-child(10) {
                display: none;
            }
        }
    </style>
</body>




</html>
