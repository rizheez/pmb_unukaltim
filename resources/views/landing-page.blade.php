<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Primary Meta Tags -->
    <title>
        {{ $settings['hero']->where('key', 'hero_title')->first()->value ?? 'PMB Universitas Nahdlatul Ulama Kalimantan Timur' }}
    </title>
    <meta name="title"
        content="{{ $settings['hero']->where('key', 'hero_title')->first()->value ?? 'PMB Universitas Nahdlatul Ulama Kalimantan Timur' }}">
    <meta name="description"
        content="{{ $settings['hero']->where('key', 'hero_description')->first()->value ?? 'Pendaftaran Mahasiswa Baru Universitas Nahdlatul Ulama Kalimantan Timur. Kuliah mudah, terjangkau, dan berbasis nilai keislaman.' }}">
    <meta name="keywords"
        content="PMB UNU Kaltim, Universitas Nahdlatul Ulama Kalimantan Timur, Pendaftaran Mahasiswa Baru, Kuliah di Samarinda, Universitas Islam Kalimantan Timur, Beasiswa Kuliah, KIP Kuliah">
    <meta name="author" content="Universitas Nahdlatul Ulama Kalimantan Timur">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ config('app.url') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:title"
        content="{{ $settings['hero']->where('key', 'hero_title')->first()->value ?? 'PMB Universitas Nahdlatul Ulama Kalimantan Timur' }}">
    <meta property="og:description"
        content="{{ $settings['hero']->where('key', 'hero_description')->first()->value ?? 'Pendaftaran Mahasiswa Baru Universitas Nahdlatul Ulama Kalimantan Timur' }}">
    @if ($settings['hero']->where('key', 'hero_background_image')->first()?->value)
        <meta property="og:image"
            content="{{ Storage::url($settings['hero']->where('key', 'hero_background_image')->first()->value) }}">
    @elseif($settings['contact']->where('key', 'university_logo')->first()?->value)
        <meta property="og:image"
            content="{{ Storage::url($settings['contact']->where('key', 'university_logo')->first()->value) }}">
    @else
        <meta property="og:image" content="{{ asset('assets/images/logo_unu.png') }}">
    @endif
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="PMB UNU Kaltim">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title"
        content="{{ $settings['hero']->where('key', 'hero_title')->first()->value ?? 'PMB Universitas Nahdlatul Ulama Kalimantan Timur' }}">
    <meta name="twitter:description"
        content="{{ $settings['hero']->where('key', 'hero_description')->first()->value ?? 'Pendaftaran Mahasiswa Baru Universitas Nahdlatul Ulama Kalimantan Timur' }}">
    @if ($settings['hero']->where('key', 'hero_background_image')->first()?->value)
        <meta name="twitter:image"
            content="{{ Storage::url($settings['hero']->where('key', 'hero_background_image')->first()->value) }}">
    @else
        <meta name="twitter:image" content="{{ asset('assets/images/logo_unu.png') }}">
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo_unu.png') }}">

    <!-- Structured Data (JSON-LD) for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Universitas Nahdlatul Ulama Kalimantan Timur",
        "alternateName": "UNU Kaltim",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('assets/images/logo_unu.png') }}",
        "description": "{{ $settings['about']->where('key', 'about_description')->first()->value ?? 'Universitas Nahdlatul Ulama Kalimantan Timur' }}",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ $settings['contact']->where('key', 'contact_address')->first()->value ?? '' }}",
            "addressLocality": "Samarinda",
            "addressRegion": "Kalimantan Timur",
            "addressCountry": "ID"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $settings['contact']->where('key', 'contact_phone_1')->first()->value ?? '' }}",
            "contactType": "Admissions",
            "email": "{{ $settings['contact']->where('key', 'contact_email')->first()->value ?? '' }}",
            "availableLanguage": ["Indonesian"]
        },
        "sameAs": [
            "{{ $settings['social_media']->where('key', 'social_media_facebook')->first()->value ?? '' }}",
            "{{ $settings['social_media']->where('key', 'social_media_instagram')->first()->value ?? '' }}",
            "{{ $settings['social_media']->where('key', 'social_media_website')->first()->value ?? '' }}"
        ]
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Merriweather:wght@300;400;700;900&display=swap"
        rel="stylesheet">
    <style>
        /* Default untuk body text tetap Inter agar bersih */
        body {
            font-family: 'Inter', sans-serif;
        }

        .text-outline-black {
            -webkit-text-stroke: 1.7px rgba(22, 141, 117, 1);
            text-stroke: 1.7px rgba(22, 141, 117, 1);
        }

        /* Khusus Heading/Judul menggunakan Merriweather agar terlihat berwibawa/akademis */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-serif-heading {
            font-family: 'Merriweather', serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.90) 0%, rgba(6, 182, 212, 0.90) 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }

        /* Registration Guide Animations */
        .step-badge {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .step-badge:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .step-card {
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateX(10px);
        }

        .timeline-line {
            background: linear-gradient(90deg,
                    #99f6e4 0%,
                    #14b8a6 25%,
                    #0d9488 50%,
                    #14b8a6 75%,
                    #99f6e4 100%);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 0.8;
            }

            50% {
                transform: scale(1);
                opacity: 0.4;
            }

            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 9999px;
            border: 3px solid #14b8a6;
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        .step-number {
            background: linear-gradient(135deg, #14b8a6 0%, #0891b2 100%);
            box-shadow: 0 10px 40px -10px rgba(20, 184, 166, 0.5);
        }

        .step-glow {
            box-shadow: 0 0 30px rgba(20, 184, 166, 0.3), 0 0 60px rgba(20, 184, 166, 0.1);
        }

        /* Progress Bar */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #0d9488 0%, #06b6d4 50%, #f59e0b 100%);
            z-index: 9999;
            transition: width 0.1s ease-out;
            box-shadow: 0 0 10px rgba(13, 148, 136, 0.5);
        }
    </style>
</head>

<body class="scroll-smooth">
    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex flex-col items-center">
                    @if ($settings['contact']->where('key', 'university_logo')->first()?->value)
                        <img src="{{ Storage::url($settings['contact']->where('key', 'university_logo')->first()->value) }}"
                            alt="Logo" class="h-10 w-10 object-contain">
                    @endif
                    <span class="text-sm font-bold text-teal-600 font-serif-heading leading-tight">PMB UNUKALTIM</span>
                </div>

                <!-- Desktop Menu (hidden on tablet and mobile) -->
                <div class="hidden lg:flex space-x-6">
                    <a href="#home" class="text-gray-700 hover:text-teal-600 transition text-sm">Beranda</a>
                    <a href="#features" class="text-gray-700 hover:text-teal-600 transition text-sm">Keunggulan</a>
                    <a href="#registration-guide" class="text-gray-700 hover:text-teal-600 transition text-sm">Alur
                        Pendaftaran</a>
                    <a href="#programs" class="text-gray-700 hover:text-teal-600 transition text-sm">Program Studi</a>
                    <a href="#about" class="text-gray-700 hover:text-teal-600 transition text-sm">Tentang</a>
                    <a href="#contact" class="text-gray-700 hover:text-teal-600 transition text-sm">Kontak</a>
                </div>

                <!-- Right side buttons -->
                <div class="flex items-center gap-2">
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn"
                        class=" lg:hidden p-2  rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>

                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-full transition text-sm">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('student.dashboard') }}"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-full transition text-sm">
                                Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-full transition text-sm">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu (hidden by default) -->
            <div id="mobile-menu" class="hidden lg:hidden pb-4">
                <div class="flex flex-col space-y-2 pt-2 border-t border-gray-200">
                    <a href="#home"
                        class="text-gray-700 hover:text-teal-600 hover:bg-teal-50 px-3 py-2 rounded-lg transition">Beranda</a>
                    <a href="#features"
                        class="text-gray-700 hover:text-teal-600 hover:bg-teal-50 px-3 py-2 rounded-lg transition">Keunggulan</a>
                    <a href="#registration-guide"
                        class="text-gray-700 hover:text-teal-600 hover:bg-teal-50 px-3 py-2 rounded-lg transition">Alur
                        Pendaftaran</a>
                    <a href="#programs"
                        class="text-gray-700 hover:text-teal-600 hover:bg-teal-50 px-3 py-2 rounded-lg transition">Program
                        Studi</a>
                    <a href="#about"
                        class="text-gray-700 hover:text-teal-600 hover:bg-teal-50 px-3 py-2 rounded-lg transition">Tentang</a>
                    <a href="#contact"
                        class="text-gray-700 hover:text-teal-600 hover:bg-teal-50 px-3 py-2 rounded-lg transition">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });

                // Close menu when clicking a link
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                    });
                });
            }
        });
    </script>

    <!-- Hero Section -->
    <section id="home" class="pt-16 min-h-screen flex items-center hero-gradient relative overflow-hidden">
        <!-- Desktop Background Image -->
        @if ($settings['hero']->where('key', 'hero_background_image_desktop')->first()?->value)
            <div class="absolute inset-0 hidden md:block">
                <img src="{{ Storage::url($settings['hero']->where('key', 'hero_background_image_desktop')->first()->value) }}"
                    alt="Kampus Universitas Nahdlatul Ulama Kalimantan Timur - PMB UNU Kaltim"
                    class="w-full h-full object-cover">
            </div>
            <!-- Dark Overlay untuk memastikan teks tetap terbaca -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/30 to-black/40 hidden md:block">
            </div>
        @endif

        <!-- Mobile Background Image -->
        @if ($settings['hero']->where('key', 'hero_background_image_mobile')->first()?->value)
            <div class="absolute inset-0 md:hidden">
                <img src="{{ Storage::url($settings['hero']->where('key', 'hero_background_image_mobile')->first()->value) }}"
                    alt="Kampus Universitas Nahdlatul Ulama Kalimantan Timur - PMB UNU Kaltim"
                    class="w-full h-full object-cover">
            </div>
            <!-- Dark Overlay untuk memastikan teks tetap terbaca -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/30 to-black/40 md:hidden"></div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="text-center text-white fade-in">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 text-white text-outline-black">
                    {{ $settings['hero']->where('key', 'hero_title')->first()->value ?? 'Selamat Datang' }}
                </h1>

                <div class="bg-black/20 backdrop-blur-sm px-6 py-4 rounded-xl">

                    <p class="text-xl md:text-3xl font-light mb-3 text-white/90">
                        {{ $settings['hero']->where('key', 'hero_subtitle')->first()->value ?? '' }}
                    </p>

                    <p class="text-base md:text-xl max-w-3xl mx-auto text-white/80">
                        {{ $settings['hero']->where('key', 'hero_description')->first()->value ?? '' }}
                    </p>

                </div>
                @if ($activePeriod)
                    <div class="mb-8 inline-block bg-white/20 backdrop-blur-sm rounded-lg px-6 py-3 my-3">
                        <p class="text-sm font-semibold">Periode Pendaftaran Aktif</p>
                        <p class="text-xs opacity-90">
                            {{ $activePeriod->name }}
                        </p>
                        <p class="text-xs opacity-90">
                            {{ \Carbon\Carbon::parse($activePeriod->start_date)->locale('id')->translatedFormat('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($activePeriod->end_date)->locale('id')->translatedFormat('d M Y') }}
                        </p>
                    </div>
                @endif

                <div class="flex justify-center gap-4">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-white text-teal-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('student.dashboard') }}"
                                class="bg-white text-teal-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                                Dashboard Mahasiswa
                            </a>
                        @endif
                    @else
                        <a href="{{ $settings['hero']->where('key', 'hero_button_url')->first()->value ?? '/login' }}"
                            class="bg-white text-teal-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                            {{ $settings['hero']->where('key', 'hero_button_text')->first()->value ?? 'Daftar Sekarang' }}
                        </a>
                    @endauth
                    <a href="#programs"
                        class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/10 transition">
                        Lihat Program
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i data-lucide="chevron-down" class="text-white w-8 h-8"></i>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Keunggulan Kami</h2>
                <p class="text-xl text-gray-600">Mengapa memilih kami untuk masa depan pendidikan Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach (['feature_1', 'feature_2', 'feature_3'] as $feature)
                    <div class="bg-white rounded-2xl p-8 card-hover">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mb-6">
                            <i data-lucide="{{ $settings['features']->where('key', $feature . '_icon')->first()->value ?? 'check' }}"
                                class="text-teal-600 w-8 h-8"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            {{ $settings['features']->where('key', $feature . '_title')->first()->value ?? '' }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            {{ $settings['features']->where('key', $feature . '_description')->first()->value ?? '' }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Registration Guide Section -->
    <section id="registration-guide"
        class="py-24 bg-gradient-to-br from-slate-900 via-teal-900 to-slate-900 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-10 w-72 h-72 bg-teal-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-500 rounded-full blur-3xl"></div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-teal-400 rounded-full blur-3xl">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <span
                    class="inline-block px-4 py-2 bg-teal-500/20 backdrop-blur-sm border border-teal-500/30 rounded-full text-teal-300 text-sm font-semibold mb-4">
                    <i data-lucide="route" class="w-4 h-4 inline mr-2"></i>
                    Panduan Lengkap
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Alur Pendaftaran <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-cyan-400">PMB</span>
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Ikuti 5 langkah mudah berikut untuk menyelesaikan pendaftaran mahasiswa baru
                </p>
            </div>

            <!-- Desktop Timeline (Hidden on Mobile) -->
            <div class="hidden lg:block">
                <div class="relative">
                    <!-- Animated Connecting Line -->
                    <div class="absolute top-24 left-0 right-0 h-1.5 rounded-full timeline-line"
                        style="margin: 0 8%;"></div>

                    <div class="grid grid-cols-5 gap-6 relative">
                        <!-- Step 1 -->
                        <div class="flex flex-col items-center text-center group">
                            <div class="relative mb-6">
                                <div
                                    class="step-badge step-number w-28 h-28 rounded-full flex items-center justify-center relative z-10 pulse-ring step-glow">
                                    <div class="text-center">
                                        <i data-lucide="user-plus"
                                            class="text-white w-10 h-10 mx-auto mb-1 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-white/80 text-xs font-medium">Step 1</span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 group-hover:bg-white/20 transition-all duration-300 group-hover:scale-105">
                                <h3 class="text-lg font-bold text-white mb-2">Registrasi Akun</h3>
                                <p class="text-sm text-gray-300 leading-relaxed">Buat akun dengan email aktif &
                                    verifikasi untuk mengaktifkan akun.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex flex-col items-center text-center group" style="animation-delay: 0.1s">
                            <div class="relative mb-6">
                                <div
                                    class="step-badge step-number w-28 h-28 rounded-full flex items-center justify-center relative z-10 step-glow">
                                    <div class="text-center">
                                        <i data-lucide="file-text"
                                            class="text-white w-10 h-10 mx-auto mb-1 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-white/80 text-xs font-medium">Step 2</span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 group-hover:bg-white/20 transition-all duration-300 group-hover:scale-105">
                                <h3 class="text-lg font-bold text-white mb-2">Lengkapi Biodata</h3>
                                <p class="text-sm text-gray-300 leading-relaxed">Isi data pribadi & upload dokumen
                                    yang diperlukan.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex flex-col items-center text-center group" style="animation-delay: 0.2s">
                            <div class="relative mb-6">
                                <div
                                    class="step-badge step-number w-28 h-28 rounded-full flex items-center justify-center relative z-10 float-animation step-glow">
                                    <div class="text-center">
                                        <i data-lucide="graduation-cap"
                                            class="text-white w-10 h-10 mx-auto mb-1 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-white/80 text-xs font-medium">Step 3</span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 group-hover:bg-white/20 transition-all duration-300 group-hover:scale-105">
                                <h3 class="text-lg font-bold text-white mb-2">Pilih Program Studi</h3>
                                <p class="text-sm text-gray-300 leading-relaxed">Pilih program studi & jalur
                                    pendaftaran yang sesuai.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex flex-col items-center text-center group" style="animation-delay: 0.3s">
                            <div class="relative mb-6">
                                <div
                                    class="step-badge step-number w-28 h-28 rounded-full flex items-center justify-center relative z-10 step-glow">
                                    <div class="text-center">
                                        <i data-lucide="shield-check"
                                            class="text-white w-10 h-10 mx-auto mb-1 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-white/80 text-xs font-medium">Step 4</span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 group-hover:bg-white/20 transition-all duration-300 group-hover:scale-105">
                                <h3 class="text-lg font-bold text-white mb-2">Verifikasi Data</h3>
                                <p class="text-sm text-gray-300 leading-relaxed">Tunggu verifikasi admin & kabar untuk
                                    proses daftar ulang.</p>
                            </div>
                        </div>

                        <!-- Step 5 -->
                        <div class="flex flex-col items-center text-center group" style="animation-delay: 0.4s">
                            <div class="relative mb-6">
                                <div
                                    class="step-badge step-number w-28 h-28 rounded-full flex items-center justify-center relative z-10 step-glow">
                                    <div class="text-center">
                                        <i data-lucide="party-popper"
                                            class="text-white w-10 h-10 mx-auto mb-1 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-white/80 text-xs font-medium">Step 5</span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 group-hover:bg-white/20 transition-all duration-300 group-hover:scale-105">
                                <h3 class="text-lg font-bold text-white mb-2">Daftar Ulang</h3>
                                <p class="text-sm text-gray-300 leading-relaxed">Lakukan daftar ulang & selamat
                                    bergabung menjadi mahasiswa baru!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile/Tablet Cards (Hidden on Large Desktop) -->
            <div class="lg:hidden space-y-4">
                <!-- Step 1 -->
                <div
                    class="step-card bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 hover:bg-white/20">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="step-number w-14 h-14 rounded-full flex items-center justify-center">
                                <i data-lucide="user-plus" class="text-white w-7 h-7"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="text-xs font-semibold text-teal-400 bg-teal-500/20 px-2 py-1 rounded-full">Step
                                    1</span>
                            </div>
                            <h3 class="text-lg font-bold text-white">Registrasi Akun</h3>
                            <p class="text-sm text-gray-300">Buat akun dengan email aktif & verifikasi untuk
                                mengaktifkan akun.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div
                    class="step-card bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 hover:bg-white/20">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="step-number w-14 h-14 rounded-full flex items-center justify-center">
                                <i data-lucide="file-text" class="text-white w-7 h-7"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="text-xs font-semibold text-teal-400 bg-teal-500/20 px-2 py-1 rounded-full">Step
                                    2</span>
                            </div>
                            <h3 class="text-lg font-bold text-white">Lengkapi Biodata</h3>
                            <p class="text-sm text-gray-300">Isi data pribadi, data orang tua, & upload dokumen yang
                                diperlukan.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div
                    class="step-card bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 hover:bg-white/20">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="step-number w-14 h-14 rounded-full flex items-center justify-center">
                                <i data-lucide="graduation-cap" class="text-white w-7 h-7"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="text-xs font-semibold text-teal-400 bg-teal-500/20 px-2 py-1 rounded-full">Step
                                    3</span>
                            </div>
                            <h3 class="text-lg font-bold text-white">Pilih Program Studi</h3>
                            <p class="text-sm text-gray-300">Pilih program studi & jalur pendaftaran yang sesuai.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div
                    class="step-card bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 hover:bg-white/20">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="step-number w-14 h-14 rounded-full flex items-center justify-center">
                                <i data-lucide="shield-check" class="text-white w-7 h-7"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="text-xs font-semibold text-teal-400 bg-teal-500/20 px-2 py-1 rounded-full">Step
                                    4</span>
                            </div>
                            <h3 class="text-lg font-bold text-white">Verifikasi Data</h3>
                            <p class="text-sm text-gray-300">Tunggu verifikasi admin & kabar untuk proses daftar ulang.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 5 -->
                <div
                    class="step-card bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 hover:bg-white/20">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <div class="step-number w-14 h-14 rounded-full flex items-center justify-center">
                                <i data-lucide="party-popper" class="text-white w-7 h-7"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span
                                    class="text-xs font-semibold text-teal-400 bg-teal-500/20 px-2 py-1 rounded-full">Step
                                    5</span>
                            </div>
                            <h3 class="text-lg font-bold text-white">Daftar Ulang</h3>
                            <p class="text-sm text-gray-300">Lakukan daftar ulang & selamat bergabung menjadi mahasiswa
                                baru!</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="text-center mt-16 flex flex-wrap justify-center gap-4">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-400 hover:to-cyan-400 text-white px-10 py-4 rounded-full font-semibold text-lg transition-all shadow-lg shadow-teal-500/30 hover:shadow-xl hover:shadow-teal-500/40 hover:scale-105">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('student.dashboard') }}"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-400 hover:to-cyan-400 text-white px-10 py-4 rounded-full font-semibold text-lg transition-all shadow-lg shadow-teal-500/30 hover:shadow-xl hover:shadow-teal-500/40 hover:scale-105">
                            <i data-lucide="rocket" class="w-5 h-5"></i>
                            Mulai Pendaftaran
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-400 hover:to-cyan-400 text-white px-10 py-4 rounded-full font-semibold text-lg transition-all shadow-lg shadow-teal-500/30 hover:shadow-xl hover:shadow-teal-500/40 hover:scale-105">
                        <i data-lucide="user-plus" class="w-5 h-5"></i>
                        Daftar Sekarang
                    </a>
                @endauth
                <a href="{{ route('guide.view') }}"
                    class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border-2 border-white/30 hover:bg-white/20 text-white px-10 py-4 rounded-full font-semibold text-lg transition-all hover:scale-105">
                    <i data-lucide="book-open" class="w-5 h-5"></i>
                    Lihat Panduan
                </a>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Program Studi</h2>
                <p class="text-xl text-gray-600">Pilih program studi yang sesuai dengan minat dan bakatmu</p>
            </div>

            @foreach ($fakultas as $fak)
                <div class="mb-12">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-2 h-8 bg-teal-600 rounded mr-4"></span>
                        {{ $fak->name }}
                    </h3>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($fak->programStudi as $prodi)
                            <div
                                class="border border-gray-200 rounded-xl p-6 hover:border-teal-500 hover:shadow-lg transition">
                                <div class="flex items-start justify-between mb-4">
                                    <span
                                        class="px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-sm font-semibold">
                                        {{ $prodi->jenjang }}
                                    </span>
                                    @if ($prodi->quota)
                                        <span class="text-sm text-gray-500">Kuota: {{ $prodi->quota }}</span>
                                    @endif
                                </div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $prodi->name }}</h4>
                                @if ($prodi->description)
                                    <p class="text-gray-600 text-sm">{{ Str::limit($prodi->description, 100) }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        {{ $settings['about']->where('key', 'about_title')->first()->value ?? 'Tentang Kami' }}
                    </h2>
                    <div class="text-gray-600 leading-relaxed space-y-4 text-justify">
                        <p>{{ $settings['about']->where('key', 'about_description')->first()->value ?? '' }}</p>
                    </div>
                </div>
                <div class="relative">
                    @if ($settings['about']->where('key', 'about_image')->first()?->value)
                        <!-- Display uploaded image -->
                        <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl">
                            <img src="{{ Storage::url($settings['about']->where('key', 'about_image')->first()->value) }}"
                                alt="Tentang {{ config('app.name') }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <!-- Display gradient if no image -->
                        <div class="aspect-square bg-gradient-to-br from-teal-400 to-cyan-500 rounded-3xl"></div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                <p class="text-xl text-gray-600">Kami siap membantu menjawab pertanyaan Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="map-pin" class="text-teal-600 w-8 h-8"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2 font-serif-heading">Alamat</h3>
                    <p class="text-gray-600">
                        {{ $settings['contact']->where('key', 'contact_address')->first()->value ?? '' }}
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="mail" class="text-teal-600 w-8 h-8"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2 font-serif-heading">Email</h3>
                    <p class="text-gray-600">
                        {{ $settings['contact']->where('key', 'contact_email')->first()->value ?? '' }}
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="phone" class="text-teal-600 w-8 h-8"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2 font-serif-heading">Whatsapp</h3>
                    <div class="text-gray-600 space-y-1">
                        @if ($settings['contact']->where('key', 'contact_phone_1')->first()?->value)
                            @php
                                $phone1 = $settings['contact']->where('key', 'contact_phone_1')->first()->value;
                                $label1 =
                                    $settings['contact']->where('key', 'contact_phone_1_label')->first()?->value ??
                                    'Admin PMB UNU Kaltim';
                                // Remove non-numeric characters and convert to international format
                                $waNumber1 = preg_replace('/[^0-9]/', '', $phone1);
                                if (substr($waNumber1, 0, 1) === '0') {
                                    $waNumber1 = '62' . substr($waNumber1, 1);
                                }
                                $waText1 = urlencode("Halo {$label1}");
                            @endphp
                            <p>
                                <a href="https://wa.me/{{ $waNumber1 }}?text={{ $waText1 }}" target="_blank"
                                    class="text-teal-600 hover:text-teal-700 hover:underline">
                                    {{ $phone1 }}
                                </a>
                                @if ($label1)
                                    <span class="text-sm text-gray-500">({{ $label1 }})</span>
                                @endif
                            </p>
                        @endif
                        @if ($settings['contact']->where('key', 'contact_phone_2')->first()?->value)
                            @php
                                $phone2 = $settings['contact']->where('key', 'contact_phone_2')->first()->value;
                                $label2 =
                                    $settings['contact']->where('key', 'contact_phone_2_label')->first()?->value ??
                                    'Admin PMB UNU Kaltim';
                                $waNumber2 = preg_replace('/[^0-9]/', '', $phone2);
                                if (substr($waNumber2, 0, 1) === '0') {
                                    $waNumber2 = '62' . substr($waNumber2, 1);
                                }
                                $waText2 = urlencode("Halo {$label2}");
                            @endphp
                            <p>
                                <a href="https://wa.me/{{ $waNumber2 }}?text={{ $waText2 }}" target="_blank"
                                    class="text-teal-600 hover:text-teal-700 hover:underline">
                                    {{ $phone2 }}
                                </a>
                                @if ($label2)
                                    <span class="text-sm text-gray-500">({{ $label2 }})</span>
                                @endif
                            </p>
                        @endif
                        @if ($settings['contact']->where('key', 'contact_phone_3')->first()?->value)
                            @php
                                $phone3 = $settings['contact']->where('key', 'contact_phone_3')->first()->value;
                                $label3 =
                                    $settings['contact']->where('key', 'contact_phone_3_label')->first()?->value ??
                                    'Admin PMB UNU Kaltim';
                                $waNumber3 = preg_replace('/[^0-9]/', '', $phone3);
                                if (substr($waNumber3, 0, 1) === '0') {
                                    $waNumber3 = '62' . substr($waNumber3, 1);
                                }
                                $waText3 = urlencode("Halo {$label3}");
                            @endphp
                            <p>
                                <a href="https://wa.me/{{ $waNumber3 }}?text={{ $waText3 }}" target="_blank"
                                    class="text-teal-600 hover:text-teal-700 hover:underline">
                                    {{ $phone3 }}
                                </a>
                                @if ($label3)
                                    <span class="text-sm text-gray-500">({{ $label3 }})</span>
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} Universitas Nahdlatul Ulama Kalimantan Timur. All
                    rights reserved.</p>
                <div class="mt-4 flex justify-center items-center space-x-6">
                    @if ($settings['social_media']->where('key', 'social_media_facebook')->first()?->value)
                        <a href="{{ $settings['social_media']->where('key', 'social_media_facebook')->first()->value }}"
                            target="_blank" class="text-gray-400 hover:text-white transition">
                            <i data-lucide="facebook" class="w-6 h-6"></i>
                        </a>
                    @endif
                    @if ($settings['social_media']->where('key', 'social_media_instagram')->first()?->value)
                        <a href="{{ $settings['social_media']->where('key', 'social_media_instagram')->first()->value }}"
                            target="_blank" class="text-gray-400 hover:text-white transition">
                            <i data-lucide="instagram" class="w-6 h-6"></i>
                        </a>
                    @endif
                    @if ($settings['social_media']->where('key', 'social_media_website')->first()?->value)
                        <a href="{{ $settings['social_media']->where('key', 'social_media_website')->first()->value }}"
                            target="_blank" class="hover:opacity-80 transition">
                            <img src="{{ asset('assets/images/logo_unu.png') }}" alt="Website UNU"
                                class="w-8 h-8 object-contain">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <script defer>
        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });

        // Scroll Progress Bar
        const scrollProgress = document.getElementById('scrollProgress');
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
