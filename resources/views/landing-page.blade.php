<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['hero'][0]->value ?? 'PMB Universitas Nurul Kaltim' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #0d9488 0%, #06b6d4 100%);
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.85) 0%, rgba(6, 182, 212, 0.85) 100%);
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
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .scroll-smooth {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="scroll-smooth">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    @if($settings['contact']->where('key', 'university_logo')->first()?->value)
                        <img src="{{ Storage::url($settings['contact']->where('key', 'university_logo')->first()->value) }}" 
                             alt="Logo" class="h-10 w-10 object-contain">
                    @endif
                    <span class="text-xl font-bold text-teal-600">PMB UNUKALTIM</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-teal-600 transition">Beranda</a>
                    <a href="#features" class="text-gray-700 hover:text-teal-600 transition">Keunggulan</a>
                    <a href="#programs" class="text-gray-700 hover:text-teal-600 transition">Program Studi</a>
                    <a href="#about" class="text-gray-700 hover:text-teal-600 transition">Tentang</a>
                    <a href="#contact" class="text-gray-700 hover:text-teal-600 transition">Kontak</a>
                </div>
                <div>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" 
                               class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-full transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('student.dashboard') }}" 
                               class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-full transition">
                                Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-full transition">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-16 min-h-screen flex items-center hero-gradient relative overflow-hidden">
        @if($settings['hero']->where('key', 'hero_background_image')->first()?->value)
            <div class="absolute inset-0 opacity-50">
                <img src="{{ Storage::url($settings['hero']->where('key', 'hero_background_image')->first()->value) }}" 
                     alt="Background" class="w-full h-full object-cover">
            </div>
        @endif
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="text-center text-white fade-in">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    {{ $settings['hero']->where('key', 'hero_title')->first()->value ?? 'Selamat Datang' }}
                </h1>
                <p class="text-2xl md:text-3xl font-light mb-4">
                    {{ $settings['hero']->where('key', 'hero_subtitle')->first()->value ?? '' }}
                </p>
                <p class="text-lg md:text-xl mb-8 max-w-3xl mx-auto opacity-90">
                    {{ $settings['hero']->where('key', 'hero_description')->first()->value ?? '' }}
                </p>
                
                @if($activePeriod)
                    <div class="mb-8 inline-block bg-white/20 backdrop-blur-sm rounded-lg px-6 py-3">
                        <p class="text-sm font-semibold">Periode Pendaftaran Aktif</p>
                        <p class="text-xs opacity-90">
                            {{ \Carbon\Carbon::parse($activePeriod->start_date)->format('d M Y') }} - 
                            {{ \Carbon\Carbon::parse($activePeriod->end_date)->format('d M Y') }}
                        </p>
                    </div>
                @endif
                
                <div class="flex justify-center gap-4">
                    @auth
                        @if(auth()->user()->isAdmin())
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
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Keunggulan Kami</h2>
                <p class="text-xl text-gray-600">Mengapa memilih kami untuk masa depan pendidikan Anda</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                @foreach(['feature_1', 'feature_2', 'feature_3'] as $feature)
                    <div class="bg-white rounded-2xl p-8 card-hover">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mb-6">
                            <i data-lucide="{{ $settings['features']->where('key', $feature . '_icon')->first()->value ?? 'check' }}" 
                               class="text-teal-600 w-8 h-8"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            {{ $settings['features']->where('key', $feature . '_title')->first()->value ?? '' }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $settings['features']->where('key', $feature . '_description')->first()->value ?? '' }}
                        </p>
                    </div>
                @endforeach
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
            
            @foreach($fakultas as $fak)
                <div class="mb-12">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-2 h-8 bg-teal-600 rounded mr-4"></span>
                        {{ $fak->name }}
                    </h3>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($fak->programStudi as $prodi)
                            <div class="border border-gray-200 rounded-xl p-6 hover:border-teal-500 hover:shadow-lg transition">
                                <div class="flex items-start justify-between mb-4">
                                    <span class="px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-sm font-semibold">
                                        {{ $prodi->jenjang }}
                                    </span>
                                    @if($prodi->quota)
                                        <span class="text-sm text-gray-500">Kuota: {{ $prodi->quota }}</span>
                                    @endif
                                </div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $prodi->name }}</h4>
                                @if($prodi->description)
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
    <section id="about" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        {{ $settings['about']->where('key', 'about_title')->first()->value ?? 'Tentang Kami' }}
                    </h2>
                    <div class="text-gray-600 leading-relaxed space-y-4">
                        <p>{{ $settings['about']->where('key', 'about_description')->first()->value ?? '' }}</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-square bg-gradient-to-br from-teal-400 to-cyan-500 rounded-3xl"></div>
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
                    <h3 class="font-semibold text-gray-900 mb-2">Alamat</h3>
                    <p class="text-gray-600">
                        {{ $settings['contact']->where('key', 'contact_address')->first()->value ?? '' }}
                    </p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="mail" class="text-teal-600 w-8 h-8"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600">
                        {{ $settings['contact']->where('key', 'contact_email')->first()->value ?? '' }}
                    </p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="phone" class="text-teal-600 w-8 h-8"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600">
                        {{ $settings['contact']->where('key', 'contact_phone')->first()->value ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} Universitas Nurul Kaltim. All rights reserved.</p>
                <div class="mt-4 flex justify-center space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i data-lucide="facebook" class="w-6 h-6"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i data-lucide="instagram" class="w-6 h-6"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i data-lucide="twitter" class="w-6 h-6"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>
