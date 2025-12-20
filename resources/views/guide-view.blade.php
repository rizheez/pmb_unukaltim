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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0d9488;
            --primary-dark: #0f766e;
            --primary-light: #14b8a6;
            --accent: #f59e0b;
            --accent-light: #fbbf24;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Progress Bar */
        .progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
            z-index: 9999;
            transition: width 0.1s ease;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 1rem 2rem;
            z-index: 100;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.75rem 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }

        .nav-link:hover {
            color: var(--primary);
            background: rgba(13, 148, 136, 0.1);
        }

        .nav-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-brand img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary) 0%, #0891b2 50%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 6rem 2rem 4rem;
        }

        /* Animated Background */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            animation: float 30s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(1deg);
            }
        }

        /* Floating Shapes */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: floatShape 20s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        .floating-shape:nth-child(3) {
            width: 150px;
            height: 150px;
            top: 50%;
            right: 10%;
            animation-delay: -10s;
        }

        @keyframes floatShape {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .hero-content {
            text-align: center;
            color: white;
            position: relative;
            z-index: 2;
            max-width: 800px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
        }

        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
            animation: fadeInUp 0.8s ease 0.2s forwards;
            opacity: 0;
        }

        .hero p {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease 0.4s forwards;
            opacity: 0;
        }

        .period-box {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            animation: fadeInUp 0.8s ease 0.6s forwards;
            opacity: 0;
        }

        .period-box i {
            width: 2rem;
            height: 2rem;
        }

        .free-badge {
            position: absolute;
            top: 6rem;
            right: 2rem;
            background: var(--accent);
            color: #1e293b;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            font-weight: 800;
            font-size: 1.25rem;
            transform: rotate(5deg);
            box-shadow: 0 10px 40px rgba(245, 158, 11, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: rotate(5deg) scale(1);
            }

            50% {
                transform: rotate(5deg) scale(1.05);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            40% {
                transform: translateX(-50%) translateY(-15px);
            }

            60% {
                transform: translateX(-50%) translateY(-7px);
            }
        }

        /* Main Content */
        main {
            max-width: 900px;
            margin: 0 auto;
            padding: 4rem 1.5rem;
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .section-title p {
            color: #64748b;
        }

        /* Steps Timeline */
        .steps-timeline {
            position: relative;
        }

        .steps-timeline::before {
            content: '';
            position: absolute;
            left: 2rem;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: 3px;
        }

        .step-item {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.6s ease;
        }

        .step-item.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .step-number {
            flex-shrink: 0;
            width: 4rem;
            height: 4rem;
            background: linear-gradient(135deg, var(--primary) 0%, #0891b2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(13, 148, 136, 0.3);
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .step-item:hover .step-number {
            transform: scale(1.1);
            box-shadow: 0 15px 40px rgba(13, 148, 136, 0.4);
        }

        .step-card {
            flex: 1;
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .step-item:hover .step-card {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-light);
        }

        .step-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .step-card h3 i {
            color: var(--primary);
        }

        .step-card p {
            color: #64748b;
            line-height: 1.6;
        }

        .step-card p strong {
            color: var(--primary);
        }

        /* Info Cards Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin: 4rem 0;
        }

        .info-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .info-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .info-card.docs {
            border-top: 4px solid var(--primary);
        }

        .info-card.tips {
            border-top: 4px solid #10b981;
        }

        .info-card.avoid {
            border-top: 4px solid #ef4444;
        }

        .info-card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .info-card-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-card.docs .info-card-icon {
            background: rgba(13, 148, 136, 0.1);
            color: var(--primary);
        }

        .info-card.tips .info-card-icon {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .info-card.avoid .info-card-icon {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .info-card-title {
            font-weight: 600;
            color: #1e293b;
        }

        .info-card ul {
            list-style: none;
        }

        .info-card ul li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0;
            color: #64748b;
            font-size: 0.9rem;
        }

        .info-card ul li i {
            width: 1rem;
            height: 1rem;
        }

        .info-card.docs ul li i {
            color: var(--primary);
        }

        .info-card.tips ul li i {
            color: #10b981;
        }

        .info-card.avoid ul li i {
            color: #ef4444;
        }

        /* QR Section */
        .qr-section {
            background: linear-gradient(135deg, var(--primary) 0%, #0891b2 100%);
            padding: 3rem;
            border-radius: 2rem;
            margin: 4rem 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: scale(0.95);
            transition: all 0.6s ease;
        }

        .qr-section.visible {
            opacity: 1;
            transform: scale(1);
        }

        .qr-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -150px;
            right: -150px;
        }

        .qr-code-wrapper {
            background: white;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            animation: floatQR 3s ease-in-out infinite;
        }

        @keyframes floatQR {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .qr-code-wrapper img {
            width: 150px;
            height: 150px;
            object-fit: contain;
        }

        .qr-section h3 {
            font-size: 1.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            gap: 0.5rem;
        }

        .qr-url {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Contact Section */
        .contact-section {
            background: white;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            margin: 4rem 0;
        }

        .contact-section h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.5rem;
        }

        .contact-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-btn.whatsapp {
            background: #dcfce7;
            color: #166534;
        }

        .contact-btn.whatsapp:hover {
            background: #166534;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(22, 101, 52, 0.2);
        }

        .contact-btn.email {
            background: #dbeafe;
            color: #1e40af;
        }

        .contact-btn.email:hover {
            background: #1e40af;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(30, 64, 175, 0.2);
        }

        /* Warning Box */
        .warning-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%);
            border: 2px solid #f59e0b;
            border-radius: 1.5rem;
            padding: 2rem;
            margin: 4rem 0;
        }

        .warning-box-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .warning-box-icon {
            width: 3rem;
            height: 3rem;
            background: #f59e0b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .warning-box h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #92400e;
        }

        .warning-box ul {
            list-style: none;
        }

        .warning-box ul li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.5rem 0;
            color: #78350f;
        }

        .warning-box ul li i {
            color: #f59e0b;
            margin-top: 0.25rem;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #f0fdfa 0%, #ecfeff 100%);
            border-radius: 2rem;
            margin: 4rem 0;
        }

        .cta-section h3 {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .cta-section p {
            color: #64748b;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, var(--primary) 0%, #0891b2 100%);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            box-shadow: 0 10px 40px rgba(13, 148, 136, 0.3);
            transition: all 0.3s ease;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(13, 148, 136, 0.4);
        }

        /* Footer */
        footer {
            background: #1e293b;
            color: white;
            text-align: center;
            padding: 2rem;
        }

        footer p {
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (min-width: 768px) {
            .qr-section {
                flex-direction: row;
                text-align: left;
            }

            .steps-timeline::before {
                left: 2rem;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.75rem 1rem;
            }

            .free-badge {
                top: 1rem;
                right: 1rem;
                font-size: 1rem;
                padding: 0.75rem 1rem;
            }

            .steps-timeline::before {
                left: 1.75rem;
            }

            .step-item {
                gap: 1rem;
            }

            .step-number {
                width: 3.5rem;
                height: 3.5rem;
                font-size: 1.25rem;
            }
        }
    </style>
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
                <span>PMB UNUKALTIM</span>
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
