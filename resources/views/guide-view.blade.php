<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pendaftaran - PMB UNU Kaltim</title>
    <meta name="description"
        content="Panduan lengkap pendaftaran mahasiswa baru Universitas Nahdlatul Ulama Kalimantan Timur">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

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

        .step-number-gradient {
            background: linear-gradient(135deg, #14b8a6 0%, #0891b2 100%);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('landing-page') }}"
                    class="flex items-center space-x-2 text-teal-600 hover:text-teal-700 transition">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    <span class="font-medium">Kembali</span>
                </a>
                <span class="text-xl font-bold text-teal-600 font-serif-heading">PMB UNUKALTIM</span>
                <a href="{{ route('guide') }}"
                    class="flex items-center space-x-2 text-gray-600 hover:text-teal-600 transition">
                    <i data-lucide="printer" class="w-5 h-5"></i>
                    <span class="hidden sm:inline font-medium">Cetak</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg text-white py-12 md:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6">
                <i data-lucide="book-open" class="w-5 h-5"></i>
                <span class="text-sm font-medium">Panduan Lengkap</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 font-serif-heading">
                Panduan Pendaftaran <br class="hidden sm:block">Mahasiswa Baru
            </h1>
            <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto">
                Universitas Nahdlatul Ulama Kalimantan Timur
            </p>

            @if ($activePeriod)
                <div class="mt-8 inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl px-6 py-4">
                    <i data-lucide="calendar" class="w-6 h-6"></i>
                    <div class="text-left">
                        <p class="text-sm font-semibold">{{ $activePeriod->name }}</p>
                        <p class="text-xs text-white/80">
                            {{ \Carbon\Carbon::parse($activePeriod->start_date)->locale('id')->translatedFormat('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($activePeriod->end_date)->locale('id')->translatedFormat('d M Y') }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Steps Section -->
        <section class="mb-16">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8 text-center font-serif-heading">
                Langkah-Langkah Pendaftaran
            </h2>

            <div class="space-y-6">
                <!-- Step 1 -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="step-number-gradient w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center shadow-lg">
                                <i data-lucide="user-plus" class="w-6 h-6 md:w-7 md:h-7 text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">Step
                                    1</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2">Registrasi Akun</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Buka website PMB, klik tombol <strong class="text-teal-600">"Daftar"</strong>.
                                Isi email aktif, nama lengkap, dan password.
                                Cek email untuk verifikasi dan aktifkan akun Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="step-number-gradient w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center shadow-lg">
                                <i data-lucide="file-text" class="w-6 h-6 md:w-7 md:h-7 text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">Step
                                    2</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2">Lengkapi Biodata</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Login ke akun Anda, lalu lengkapi data pribadi: NIK, NISN, tempat tanggal lahir, alamat
                                lengkap,
                                dan upload foto 4x6 dengan latar belakang merah.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="step-number-gradient w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center shadow-lg">
                                <i data-lucide="upload" class="w-6 h-6 md:w-7 md:h-7 text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">Step
                                    3</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2">Upload Dokumen</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Upload dokumen yang diperlukan: <strong>KTP</strong>, <strong>Kartu Keluarga</strong>,
                                dan
                                <strong>Ijazah/SKL</strong>. Format file: PDF, JPG, atau PNG dengan ukuran maksimal 2MB.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="step-number-gradient w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center shadow-lg">
                                <i data-lucide="graduation-cap" class="w-6 h-6 md:w-7 md:h-7 text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">Step
                                    4</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2">Pilih Program Studi</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Pilih jenis pendaftaran, jalur masuk, dan <strong>2 pilihan program studi</strong>
                                sesuai dengan minat dan bakat Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 5 -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="step-number-gradient w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center shadow-lg">
                                <i data-lucide="shield-check" class="w-6 h-6 md:w-7 md:h-7 text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">Step
                                    5</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2">Verifikasi & Daftar Ulang</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Tunggu proses verifikasi dari Tim PMB. Setelah data diverifikasi dan dinyatakan lolos,
                                Anda akan dihubungi untuk proses <strong>daftar ulang</strong> dan informasi
                                selanjutnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Info Cards -->
        <section class="grid md:grid-cols-3 gap-6 mb-16">
            <!-- Dokumen Diperlukan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="file-check" class="w-5 h-5 text-teal-600"></i>
                    </div>
                    <h3 class="font-bold text-gray-900">Dokumen Diperlukan</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-teal-500"></i>
                        Foto 4x6 latar merah
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-teal-500"></i>
                        Scan/Foto KTP
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-teal-500"></i>
                        Scan/Foto Kartu Keluarga
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-teal-500"></i>
                        Scan/Foto Ijazah/SKL
                    </li>

                </ul>
            </div>

            <!-- Tips Sukses -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="lightbulb" class="w-5 h-5 text-emerald-600"></i>
                    </div>
                    <h3 class="font-bold text-gray-900">Tips Sukses</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                        Gunakan email aktif
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                        Siapkan dokumen sebelum daftar
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                        Pastikan foto jelas & terbaca
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                        Isi data sesuai dokumen resmi
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                        Simpan nomor WA panitia
                    </li>
                </ul>
            </div>

            <!-- Yang Harus Dihindari -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
                    </div>
                    <h3 class="font-bold text-gray-900">Yang Harus Dihindari</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center gap-2">
                        <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
                        Email tidak aktif
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
                        Upload foto blur/tidak jelas
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
                        Data tidak sesuai KTP
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
                        Lupa password akun
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
                        Tunggu deadline terlalu lama
                    </li>
                </ul>
            </div>
        </section>

        <!-- QR Section -->
        <section class="gradient-bg rounded-2xl p-6 md:p-8 text-white mb-12">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="flex-shrink-0 w-24 h-24 md:w-28 md:h-28 bg-white rounded-xl p-2 shadow-lg">
                    <img src="{{ asset('assets/images/qr-code-with-logo.png') }}" alt="QR Code PMB"
                        class="w-full h-full object-contain">
                </div>
                <div class="text-center md:text-left">
                    <h3
                        class="text-xl md:text-2xl font-bold mb-2 flex items-center justify-center md:justify-start gap-2">
                        <i data-lucide="globe" class="w-6 h-6"></i>
                        Akses Website PMB
                    </h3>
                    <p class="text-white/90 mb-2">Scan QR Code atau kunjungi:</p>
                    <p class="text-lg font-semibold bg-white/20 inline-block px-4 py-2 rounded-lg">
                        {{ config('app.url') }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-12">
            <h3 class="text-xl font-bold text-gray-900 mb-6 text-center">Butuh Bantuan?</h3>
            <div class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-8">
                @if ($settings['contact']->where('key', 'contact_phone_1')->first()?->value)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact']->where('key', 'contact_phone_1')->first()->value) }}"
                        target="_blank"
                        class="flex items-center justify-center gap-3 bg-green-50 hover:bg-green-100 text-green-700 px-6 py-3 rounded-xl transition">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        <span
                            class="font-medium">{{ $settings['contact']->where('key', 'contact_phone_1')->first()->value }}</span>
                    </a>
                @endif
                @if ($settings['contact']->where('key', 'contact_email')->first()?->value)
                    <a href="mailto:{{ $settings['contact']->where('key', 'contact_email')->first()->value }}"
                        class="flex items-center justify-center gap-3 bg-blue-50 hover:bg-blue-100 text-blue-700 px-6 py-3 rounded-xl transition">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                        <span
                            class="font-medium">{{ $settings['contact']->where('key', 'contact_email')->first()->value }}</span>
                    </a>
                @endif
            </div>
        </section>

        <!-- Important Notes -->
        <section class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-12">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-amber-600"></i>
                </div>
                <div>
                    <h3 class="font-bold text-amber-800 mb-3">Catatan Penting</h3>
                    <ul class="space-y-2 text-sm text-amber-700">
                        <li class="flex items-start gap-2">
                            <i data-lucide="info" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                            <span>Pendaftaran <strong>GRATIS</strong>, tidak dipungut biaya apapun.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="info" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                            <span>Panitia <strong>TIDAK PERNAH</strong> meminta transfer uang melalui
                                WhatsApp/telepon.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="info" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                            <span>Hubungi panitia resmi jika mengalami kendala teknis.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="text-center">
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center gap-2 gradient-bg text-white px-8 py-4 rounded-full font-semibold text-lg hover:opacity-90 transition shadow-lg">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('student.dashboard') }}"
                        class="inline-flex items-center gap-2 gradient-bg text-white px-8 py-4 rounded-full font-semibold text-lg hover:opacity-90 transition shadow-lg">
                        <i data-lucide="rocket" class="w-5 h-5"></i>
                        Mulai Pendaftaran
                    </a>
                @endif
            @else
                <a href="{{ route('register') }}"
                    class="inline-flex items-center gap-2 gradient-bg text-white px-8 py-4 rounded-full font-semibold text-lg hover:opacity-90 transition shadow-lg">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                    Daftar Sekarang
                </a>
            @endauth
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} Universitas Nahdlatul Ulama Kalimantan Timur. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>

</html>
