<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Primary Meta Tags -->
    <title>Panduan Pendaftaran Mahasiswa Baru - PMB UNU Kaltim {{ date('Y') }}</title>
    <meta name="title" content="Panduan Pendaftaran Mahasiswa Baru - PMB UNU Kaltim {{ date('Y') }}">
    <meta name="description"
        content="Panduan lengkap cara daftar mahasiswa baru di Universitas Nahdlatul Ulama Kalimantan Timur. 5 langkah mudah pendaftaran online PMB UNU Kaltim.">
    <meta name="keywords"
        content="panduan PMB UNU Kaltim, cara daftar kuliah Samarinda, pendaftaran mahasiswa baru Kaltim, alur PMB UNU, syarat pendaftaran kuliah">
    <meta name="author" content="Universitas Nahdlatul Ulama Kalimantan Timur">
    <meta name="robots" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ route('guide.view') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('guide.view') }}">
    <meta property="og:title" content="Panduan Pendaftaran Mahasiswa Baru - PMB UNU Kaltim {{ date('Y') }}">
    <meta property="og:description"
        content="Panduan lengkap cara daftar mahasiswa baru di Universitas Nahdlatul Ulama Kalimantan Timur. 5 langkah mudah pendaftaran online.">
    <meta property="og:image" content="{{ asset('assets/images/logo_unu.png') }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="PMB UNU Kaltim">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ route('guide.view') }}">
    <meta name="twitter:title" content="Panduan Pendaftaran Mahasiswa Baru - PMB UNU Kaltim">
    <meta name="twitter:description"
        content="Panduan lengkap cara daftar mahasiswa baru di Universitas Nahdlatul Ulama Kalimantan Timur.">
    <meta name="twitter:image" content="{{ asset('assets/images/logo_unu.png') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo_unu.png') }}">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "HowTo",
        "name": "Panduan Pendaftaran Mahasiswa Baru UNU Kaltim",
        "description": "Langkah-langkah mendaftar sebagai mahasiswa baru di Universitas Nahdlatul Ulama Kalimantan Timur",
        "totalTime": "PT30M",
        "step": [
            {
                "@type": "HowToStep",
                "name": "Registrasi Akun",
                "text": "Buka website PMB, klik Daftar, isi email aktif, nama, dan password. Verifikasi email."
            },
            {
                "@type": "HowToStep",
                "name": "Lengkapi Biodata",
                "text": "Login, lengkapi data pribadi: NIK, NISN, TTL, alamat, dan upload foto 4x6 latar merah."
            },
            {
                "@type": "HowToStep",
                "name": "Upload Dokumen",
                "text": "Upload KTP, Kartu Keluarga, dan Ijazah/SKL. Format: PDF/JPG/PNG, maks 2MB."
            },
            {
                "@type": "HowToStep",
                "name": "Pilih Program Studi",
                "text": "Pilih jenis pendaftaran, jalur masuk, dan 2 pilihan program studi."
            },
            {
                "@type": "HowToStep",
                "name": "Verifikasi & Daftar Ulang",
                "text": "Tunggu verifikasi Tim PMB, lalu lakukan daftar ulang setelah dinyatakan lolos."
            }
        ]
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite('resources/css/guide-view.css')
</head>

<body>
    <!-- Progress Bar -->
    <div class="progress-bar" id="progressBar"></div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="navbar-content">
            <a href="{{ route('landing-page') }}" class="nav-link">
                <i data-lucide="arrow-left"></i>
                <span>Kembali</span>
            </a>
            <div class="nav-brand">
                <img src="{{ asset('assets/images/logo_unu.png') }}" alt="Logo">
                <span class="md:block hidden">PMB UNUKALTIM</span>
            </div>
            <a href="{{ route('guide') }}" target="_blank" class="nav-link">
                <i data-lucide="printer"></i>
                <span>Cetak</span>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>

        <div class="free-badge">
            ✨ GRATIS!
        </div>

        <div class="hero-content">
            <div class="hero-badge">
                <i data-lucide="book-open"></i>
                <span>Panduan Lengkap</span>
            </div>
            <h1>Panduan Pendaftaran<br>Mahasiswa Baru</h1>
            <p>Universitas Nahdlatul Ulama Kalimantan Timur</p>

            @if ($activePeriod)
                <div class="period-box">
                    <i data-lucide="calendar"></i>
                    <div style="text-align: left;">
                        <div style="font-weight: 600;">{{ $activePeriod->name }}</div>
                        <div style="font-size: 0.9rem; opacity: 0.9;">
                            {{ \Carbon\Carbon::parse($activePeriod->start_date)->locale('id')->translatedFormat('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($activePeriod->end_date)->locale('id')->translatedFormat('d M Y') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="scroll-indicator">
            <a href="#content" style="color: white;">
                <i data-lucide="chevrons-down" style="width: 2rem; height: 2rem;"></i>
            </a>
        </div>
    </section>

    <!-- Main Content -->
    <main id="content">
        <section class="section-title">
            <h2>Langkah-Langkah Pendaftaran</h2>
            <p>Ikuti 5 langkah mudah berikut untuk mendaftar</p>
        </section>

        <!-- Steps Timeline -->
        <div class="steps-timeline">
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-card">
                    <h3>
                        <i data-lucide="user-plus"></i>
                        Registrasi Akun
                    </h3>
                    <p>Buka website PMB, klik tombol <strong>"Daftar"</strong>. Isi email aktif, nama lengkap, dan
                        password. Cek email untuk verifikasi dan aktifkan akun Anda.</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-card">
                    <h3>
                        <i data-lucide="file-text"></i>
                        Lengkapi Biodata
                    </h3>
                    <p>Login ke akun Anda, lalu lengkapi data pribadi: NIK, NISN, tempat tanggal lahir, alamat lengkap,
                        dan <strong>upload foto 4x6 latar merah</strong>.</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-card">
                    <h3>
                        <i data-lucide="upload"></i>
                        Upload Dokumen
                    </h3>
                    <p>Upload dokumen yang diperlukan: <strong>KTP</strong>, <strong>Kartu Keluarga</strong>, dan
                        <strong>Ijazah/SKL</strong>. Format: PDF, JPG, atau PNG (maks 2MB).
                    </p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">4</div>
                <div class="step-card">
                    <h3>
                        <i data-lucide="graduation-cap"></i>
                        Pilih Program Studi
                    </h3>
                    <p>Pilih jenis pendaftaran, jalur masuk, dan <strong>2 pilihan program studi</strong> sesuai dengan
                        minat dan bakat Anda.</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">5</div>
                <div class="step-card">
                    <h3>
                        <i data-lucide="shield-check"></i>
                        Verifikasi & Daftar Ulang
                    </h3>
                    <p>Tunggu proses verifikasi dari Tim PMB. Setelah dinyatakan lolos, Anda akan dihubungi untuk proses
                        <strong>daftar ulang</strong> dan informasi selanjutnya.
                    </p>
                </div>
            </div>
        </div>

        <!-- Info Cards Grid -->
        <div class="info-grid">
            <div class="info-card docs">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i data-lucide="file-check"></i>
                    </div>
                    <div class="info-card-title">Dokumen Diperlukan</div>
                </div>
                <ul>
                    <li><i data-lucide="check"></i> Foto 4x6 latar merah</li>
                    <li><i data-lucide="check"></i> Scan/Foto KTP</li>
                    <li><i data-lucide="check"></i> Scan/Foto Kartu Keluarga</li>
                    <li><i data-lucide="check"></i> Scan/Foto Ijazah/SKL</li>
                </ul>
            </div>

            <div class="info-card tips">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i data-lucide="lightbulb"></i>
                    </div>
                    <div class="info-card-title">Tips Sukses</div>
                </div>
                <ul>
                    <li><i data-lucide="check"></i> Gunakan email aktif</li>
                    <li><i data-lucide="check"></i> Siapkan dokumen sebelum daftar</li>
                    <li><i data-lucide="check"></i> Pastikan foto jelas & terbaca</li>
                    <li><i data-lucide="check"></i> Isi data sesuai dokumen resmi</li>
                    <li><i data-lucide="check"></i> Simpan nomor WA panitia</li>
                </ul>
            </div>

            <div class="info-card avoid">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <i data-lucide="alert-triangle"></i>
                    </div>
                    <div class="info-card-title">Yang Harus Dihindari</div>
                </div>
                <ul>
                    <li><i data-lucide="x"></i> Email tidak aktif</li>
                    <li><i data-lucide="x"></i> Upload foto blur/tidak jelas</li>
                    <li><i data-lucide="x"></i> Data tidak sesuai KTP</li>
                    <li><i data-lucide="x"></i> Lupa password akun</li>
                    <li><i data-lucide="x"></i> Tunggu deadline terlalu lama</li>
                </ul>
            </div>
        </div>

        <!-- QR Section -->
        <section class="qr-section">
            <div class="qr-code-wrapper">
                <img src="{{ asset('assets/images/qr-code-with-logo.png') }}" alt="QR Code PMB">
            </div>
            <div>
                <h3>
                    <i data-lucide="globe"></i>
                    Daftar Sekarang!
                </h3>
                <p style="margin: 1rem 0; opacity: 0.9;">Scan QR Code dengan kamera HP atau kunjungi:</p>
                <span class="qr-url">{{ config('app.url') }}</span>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <h3>Butuh Bantuan?</h3>
            <div class="contact-grid">
                @if ($settings['contact']->where('key', 'contact_phone_1')->first()?->value)
                    @php
                        $phone1 = $settings['contact']->where('key', 'contact_phone_1')->first()->value;
                        $label1 = 'Panitia PMB UNU Kaltim';
                        $waNumber1 = preg_replace('/[^0-9]/', '', $phone1);
                        if (substr($waNumber1, 0, 1) === '0') {
                            $waNumber1 = '62' . substr($waNumber1, 1);
                        }
                        $waText1 = urlencode("Halo {$label1}");
                    @endphp
                    <a href="https://wa.me/{{ $waNumber1 }}?text={{ $waText1 }}" target="_blank"
                        class="contact-btn whatsapp">
                        <i data-lucide="message-circle"></i>
                        <span>{{ $settings['contact']->where('key', 'contact_phone_1')->first()->value }}</span>
                    </a>
                @endif
                @if ($settings['contact']->where('key', 'contact_email')->first()?->value)
                    <a href="mailto:{{ $settings['contact']->where('key', 'contact_email')->first()->value }}"
                        class="contact-btn email">
                        <i data-lucide="mail"></i>
                        <span>{{ $settings['contact']->where('key', 'contact_email')->first()->value }}</span>
                    </a>
                @endif
            </div>
        </section>

        <!-- Warning Box -->
        <section class="warning-box">
            <div class="warning-box-header">
                <div class="warning-box-icon">
                    <i data-lucide="alert-circle"></i>
                </div>
                <h4>Catatan Penting</h4>
            </div>
            <ul>
                <li>
                    <i data-lucide="info"></i>
                    <span>Pendaftaran <strong>GRATIS</strong>, tidak dipungut biaya apapun.</span>
                </li>
                <li>
                    <i data-lucide="info"></i>
                    <span>Panitia <strong>TIDAK PERNAH</strong> meminta transfer uang melalui WhatsApp/telepon.</span>
                </li>
                <li>
                    <i data-lucide="info"></i>
                    <span>Hubungi panitia resmi jika mengalami kendala teknis.</span>
                </li>
            </ul>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <h3>Siap Untuk Mendaftar?</h3>
            <p>Mulai perjalanan akademikmu bersama UNU Kaltim!</p>
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="cta-btn">
                        <i data-lucide="layout-dashboard"></i>
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('student.dashboard') }}" class="cta-btn">
                        <i data-lucide="rocket"></i>
                        Lanjutkan Pendaftaran
                    </a>
                @endif
            @else
                <a href="{{ route('register') }}" class="cta-btn">
                    <i data-lucide="user-plus"></i>
                    Daftar Sekarang
                </a>
            @endauth
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} Universitas Nahdlatul Ulama Kalimantan Timur. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();

            // Progress Bar
            const progressBar = document.getElementById('progressBar');
            window.addEventListener('scroll', function() {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollPercent = (scrollTop / docHeight) * 100;
                progressBar.style.width = scrollPercent + '%';
            });

            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            // Observe step items
            document.querySelectorAll('.step-item').forEach((item, index) => {
                item.style.transitionDelay = (index * 0.1) + 's';
                observer.observe(item);
            });

            // Observe info cards
            document.querySelectorAll('.info-card').forEach((item, index) => {
                item.style.transitionDelay = (index * 0.15) + 's';
                observer.observe(item);
            });

            // Observe QR section
            document.querySelectorAll('.qr-section').forEach(item => {
                observer.observe(item);
            });
        });
    </script>
</body>

</html>
