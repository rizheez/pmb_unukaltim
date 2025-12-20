<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pendaftaran - PMB UNU Kaltim</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
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
            --dark: #1e293b;
            --gray: #64748b;
            --light: #f1f5f9;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: white;
            color: var(--dark);
        }

        .container {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            background: white;
            position: relative;
            overflow: hidden;
        }

        /* Decorative Background Elements */
        .container::before {
            content: '';
            position: absolute;
            top: -50mm;
            right: -50mm;
            width: 150mm;
            height: 150mm;
            background: radial-gradient(circle, rgba(13, 148, 136, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .container::after {
            content: '';
            position: absolute;
            bottom: -30mm;
            left: -30mm;
            width: 100mm;
            height: 100mm;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* Header Section */
        .header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 50%, #0891b2 100%);
            color: white;
            padding: 8mm 10mm;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 6mm;
            position: relative;
            z-index: 1;
        }

        .logo-container {
            width: 20mm;
            height: 20mm;
            background: white;
            border-radius: 3mm;
            padding: 2mm;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-text h1 {
            font-size: 16pt;
            font-weight: 800;
            margin-bottom: 1mm;
            text-transform: uppercase;
            letter-spacing: 0.5mm;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header-text p {
            font-size: 10pt;
            font-weight: 500;
            opacity: 0.95;
        }

        .badge-free {
            position: absolute;
            right: 10mm;
            top: 50%;
            transform: translateY(-50%) rotate(-5deg);
            background: var(--accent);
            color: var(--dark);
            padding: 2mm 5mm;
            border-radius: 2mm;
            font-size: 10pt;
            font-weight: 800;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }

        /* Period Banner */
        .period-banner {
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--dark);
            text-align: center;
            padding: 3mm 5mm;
            font-size: 10pt;
            font-weight: 600;
        }

        .period-banner strong {
            font-weight: 800;
        }

        /* Main Content */
        .main-content {
            padding: 6mm 10mm;
            position: relative;
            z-index: 1;
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 5mm;
        }

        .section-title h2 {
            font-size: 14pt;
            font-weight: 800;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            gap: 2mm;
        }

        .section-title h2::before,
        .section-title h2::after {
            content: '';
            width: 15mm;
            height: 1mm;
            background: linear-gradient(90deg, transparent, var(--primary));
            border-radius: 1mm;
        }

        .section-title h2::after {
            background: linear-gradient(90deg, var(--primary), transparent);
        }

        /* Steps Grid */
        .steps-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3mm;
            margin-bottom: 5mm;
        }

        .step-card {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border-radius: 3mm;
            padding: 4mm;
            border: 0.3mm solid #e2e8f0;
            position: relative;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .step-card.highlight {
            grid-column: span 2;
            background: linear-gradient(135deg, #f0fdfa 0%, #ecfeff 100%);
            border-color: var(--primary-light);
        }

        .step-header {
            display: flex;
            align-items: center;
            gap: 3mm;
            margin-bottom: 2mm;
        }

        .step-number {
            width: 8mm;
            height: 8mm;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10pt;
            font-weight: 800;
            box-shadow: 0 3px 10px rgba(13, 148, 136, 0.3);
        }

        .step-title {
            font-size: 10pt;
            font-weight: 700;
            color: var(--dark);
        }

        .step-desc {
            font-size: 8pt;
            color: var(--gray);
            line-height: 1.4;
            padding-left: 11mm;
        }

        .step-desc strong {
            color: var(--primary);
            font-weight: 600;
        }

        /* Three Column Cards */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 3mm;
            margin-bottom: 5mm;
        }

        .info-card {
            background: white;
            border-radius: 3mm;
            padding: 3mm;
            border: 0.3mm solid #e2e8f0;
        }

        .info-card.docs {
            border-color: var(--primary-light);
            background: linear-gradient(135deg, #f0fdfa 0%, #ffffff 100%);
        }

        .info-card.tips {
            border-color: #10b981;
            background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%);
        }

        .info-card.avoid {
            border-color: #ef4444;
            background: linear-gradient(135deg, #fef2f2 0%, #ffffff 100%);
        }

        .info-card-header {
            display: flex;
            align-items: center;
            gap: 2mm;
            margin-bottom: 2mm;
            padding-bottom: 2mm;
            border-bottom: 0.3mm solid #e2e8f0;
        }

        .info-card-icon {
            width: 6mm;
            height: 6mm;
            border-radius: 1.5mm;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8pt;
        }

        .info-card.docs .info-card-icon {
            background: var(--primary);
            color: white;
        }

        .info-card.tips .info-card-icon {
            background: #10b981;
            color: white;
        }

        .info-card.avoid .info-card-icon {
            background: #ef4444;
            color: white;
        }

        .info-card-title {
            font-size: 8pt;
            font-weight: 700;
            color: var(--dark);
        }

        .info-card ul {
            list-style: none;
            font-size: 7pt;
        }

        .info-card ul li {
            padding: 0.8mm 0;
            padding-left: 3mm;
            position: relative;
            color: var(--gray);
        }

        .info-card ul li::before {
            content: "✓";
            position: absolute;
            left: 0;
            font-weight: 700;
            font-size: 6pt;
        }

        .info-card.docs ul li::before {
            color: var(--primary);
        }

        .info-card.tips ul li::before {
            color: #10b981;
        }

        .info-card.avoid ul li::before {
            content: "✗";
            color: #ef4444;
        }

        /* QR Section */
        .qr-section {
            display: flex;
            gap: 4mm;
            background: linear-gradient(135deg, var(--primary) 0%, #0891b2 100%);
            padding: 5mm;
            border-radius: 3mm;
            margin-bottom: 4mm;
            position: relative;
            overflow: hidden;
        }

        .qr-section::before {
            content: '';
            position: absolute;
            top: -20mm;
            right: -20mm;
            width: 60mm;
            height: 60mm;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .qr-code-box {
            width: 25mm;
            height: 25mm;
            background: white;
            border-radius: 2mm;
            padding: 1.5mm;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }

        .qr-code-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .qr-info {
            color: white;
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .qr-info h3 {
            font-size: 12pt;
            font-weight: 700;
            margin-bottom: 1mm;
            display: flex;
            align-items: center;
            gap: 2mm;
        }

        .qr-info p {
            font-size: 8pt;
            opacity: 0.9;
            margin-bottom: 2mm;
        }

        .qr-url {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 2mm 4mm;
            border-radius: 2mm;
            font-size: 10pt;
            font-weight: 700;
            backdrop-filter: blur(5px);
        }

        /* Contact Grid */
        .contact-grid {
            display: flex;
            justify-content: center;
            gap: 5mm;
            margin-bottom: 4mm;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 2mm;
            background: var(--light);
            padding: 2mm 4mm;
            border-radius: 2mm;
            font-size: 8pt;
        }

        .contact-item span:first-child {
            font-size: 10pt;
        }

        .contact-item strong {
            color: var(--primary);
            font-weight: 600;
        }

        /* Warning Box */
        .warning-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%);
            border: 0.5mm solid #f59e0b;
            border-radius: 3mm;
            padding: 3mm 4mm;
            position: relative;
        }

        .warning-box::before {
            content: '⚠️';
            position: absolute;
            top: -3mm;
            left: 4mm;
            background: white;
            padding: 0 2mm;
            font-size: 10pt;
        }

        .warning-box h4 {
            font-size: 8pt;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 1.5mm;
        }

        .warning-box ul {
            display: flex;
            flex-wrap: wrap;
            gap: 2mm 5mm;
            list-style: none;
            font-size: 7pt;
            color: #78350f;
        }

        .warning-box ul li {
            display: flex;
            align-items: center;
            gap: 1mm;
        }

        .warning-box ul li::before {
            content: "•";
            font-weight: 700;
            color: #f59e0b;
        }

        /* Footer */
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--dark);
            color: white;
            text-align: center;
            padding: 3mm;
            font-size: 7pt;
        }

        .footer p {
            opacity: 0.8;
        }

        /* Print Button */
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(13, 148, 136, 0.3);
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(13, 148, 136, 0.4);
        }

        /* Print Styles */
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .print-btn {
                display: none !important;
            }

            .container {
                margin: 0;
            }
        }

        @page {
            size: A4;
            margin: 0;
        }
    </style>
</head>

<body>
    <button class="print-btn" onclick="window.print()">
        <span>🖨️</span>
        <span>Cetak Poster</span>
    </button>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="logo-container">
                    <img src="{{ asset('assets/images/logo_unu.png') }}" alt="Logo UNU Kaltim">
                </div>
                <div class="header-text">
                    <h1>Panduan Pendaftaran Mahasiswa Baru</h1>
                    <p>Universitas Nahdlatul Ulama Kalimantan Timur</p>
                </div>
            </div>
            <div class="badge-free">GRATIS!</div>
        </div>

        <!-- Period Banner -->
        @if ($activePeriod)
            <div class="period-banner">
                📅 <strong>Periode Pendaftaran:</strong> {{ $activePeriod->name }}
                ({{ \Carbon\Carbon::parse($activePeriod->start_date)->locale('id')->isoFormat('D MMM Y') }} -
                {{ \Carbon\Carbon::parse($activePeriod->end_date)->locale('id')->isoFormat('D MMM Y') }})
            </div>
        @endif

        <!-- Main Content -->
        <div class="main-content">
            <!-- Steps Section -->
            <div class="section-title">
                <h2>Langkah Pendaftaran</h2>
            </div>

            <div class="steps-container">
                <div class="step-card">
                    <div class="step-header">
                        <div class="step-number">1</div>
                        <div class="step-title">Registrasi Akun</div>
                    </div>
                    <p class="step-desc">Buka website PMB, klik <strong>"Daftar"</strong>. Isi email aktif, nama, dan
                        password. Verifikasi email melalui link yang dikirim.</p>
                </div>

                <div class="step-card">
                    <div class="step-header">
                        <div class="step-number">2</div>
                        <div class="step-title">Lengkapi Biodata</div>
                    </div>
                    <p class="step-desc">Login, lengkapi data pribadi: NIK, NISN, TTL, alamat, dan <strong>upload foto
                            4x6 latar merah</strong>.</p>
                </div>

                <div class="step-card">
                    <div class="step-header">
                        <div class="step-number">3</div>
                        <div class="step-title">Upload Dokumen</div>
                    </div>
                    <p class="step-desc">Upload <strong>KTP</strong>, <strong>Kartu Keluarga</strong>, dan
                        <strong>Ijazah/SKL</strong>. Format: PDF/JPG/PNG, maks 2MB.</p>
                </div>

                <div class="step-card">
                    <div class="step-header">
                        <div class="step-number">4</div>
                        <div class="step-title">Pilih Program Studi</div>
                    </div>
                    <p class="step-desc">Pilih jenis pendaftaran, jalur masuk, dan <strong>2 pilihan prodi</strong>
                        sesuai minat Anda.</p>
                </div>

                <div class="step-card highlight">
                    <div class="step-header">
                        <div class="step-number">5</div>
                        <div class="step-title">Verifikasi & Daftar Ulang</div>
                    </div>
                    <p class="step-desc">Tunggu verifikasi Tim PMB. Setelah lolos, Anda akan dihubungi untuk proses
                        <strong>daftar ulang</strong> dan pembayaran UKT. Pantau email dan status pendaftaran Anda
                        secara berkala.</p>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="info-grid">
                <div class="info-card docs">
                    <div class="info-card-header">
                        <div class="info-card-icon">📋</div>
                        <div class="info-card-title">Dokumen Diperlukan</div>
                    </div>
                    <ul>
                        <li>Foto 4x6 latar merah</li>
                        <li>Scan/Foto KTP</li>
                        <li>Scan/Foto Kartu Keluarga</li>
                        <li>Scan/Foto Ijazah/SKL</li>
                    </ul>
                </div>

                <div class="info-card tips">
                    <div class="info-card-header">
                        <div class="info-card-icon">💡</div>
                        <div class="info-card-title">Tips Sukses</div>
                    </div>
                    <ul>
                        <li>Gunakan email aktif</li>
                        <li>Siapkan dokumen sebelum daftar</li>
                        <li>Pastikan foto jelas & terbaca</li>
                        <li>Isi data sesuai dokumen resmi</li>
                        <li>Simpan nomor WA panitia</li>
                    </ul>
                </div>

                <div class="info-card avoid">
                    <div class="info-card-header">
                        <div class="info-card-icon">⚠️</div>
                        <div class="info-card-title">Yang Harus Dihindari</div>
                    </div>
                    <ul>
                        <li>Menggunakan email tidak aktif</li>
                        <li>Upload foto blur/tidak jelas</li>
                        <li>Isi data tidak sesuai KTP</li>
                        <li>Lupa password akun</li>
                        <li>Tunggu deadline terlalu lama</li>
                    </ul>
                </div>
            </div>

            <!-- QR Section -->
            <div class="qr-section">
                <div class="qr-code-box">
                    <img src="{{ asset('assets/images/qr-code-with-logo.png') }}" alt="QR Code PMB">
                </div>
                <div class="qr-info">
                    <h3>🌐 Daftar Sekarang!</h3>
                    <p>Scan QR Code dengan kamera HP atau kunjungi:</p>
                    <span class="qr-url">{{ config('app.url') }}</span>
                </div>
            </div>

            <!-- Contact -->
            <div class="contact-grid">
                @if ($settings['contact']->where('key', 'contact_phone_1')->first()?->value)
                    <div class="contact-item">
                        <span>📱</span>
                        <span><strong>WhatsApp:</strong>
                            {{ $settings['contact']->where('key', 'contact_phone_1')->first()->value }}</span>
                    </div>
                @endif
                @if ($settings['contact']->where('key', 'contact_email')->first()?->value)
                    <div class="contact-item">
                        <span>✉️</span>
                        <span><strong>Email:</strong>
                            {{ $settings['contact']->where('key', 'contact_email')->first()->value }}</span>
                    </div>
                @endif
            </div>

            <!-- Warning Box -->
            <div class="warning-box">
                <h4>Catatan Penting:</h4>
                <ul>
                    <li>Pendaftaran <strong>GRATIS</strong>, tidak dipungut biaya apapun</li>
                    <li>Panitia <strong>TIDAK PERNAH</strong> meminta transfer uang</li>
                    <li>Hubungi panitia resmi jika mengalami kendala teknis</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Universitas Nahdlatul Ulama Kalimantan Timur</p>
        </div>
    </div>
</body>

</html>
