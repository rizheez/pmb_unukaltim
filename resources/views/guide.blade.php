<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pendaftaran - PMB UNU Kaltim</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            font-size: 11pt;
            line-height: 1.3;
            color: #1f2937;
            background: white;
        }

        .container {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 8mm;
            overflow: hidden;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 4mm;
            padding-bottom: 3mm;
            border-bottom: 2px solid #0d9488;
        }

        .header h1 {
            font-size: 14pt;
            font-weight: 700;
            color: #0d9488;
            margin-bottom: 1mm;
        }

        .header p {
            font-size: 11pt;
            color: #6b7280;
        }

        /* Period Info */
        .period-info {
            background: #f0fdfa;
            border: 1px solid #99f6e4;
            border-radius: 2mm;
            padding: 2mm 3mm;
            text-align: center;
            margin-bottom: 4mm;
            font-size: 11pt;
        }

        .period-info strong {
            color: #0d9488;
        }

        /* Steps Grid */
        .steps-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3mm;
            margin-bottom: 10mm;
        }

        .step {
            display: flex;
            gap: 2mm;
            padding: 2mm;
            margin-bottom: 5mm;
            margin-top: 5mm;
            background: #f9fafb;
            border-radius: 2mm;
            border-left: 2px solid #0d9488;
        }

        .step.full-width {
            grid-column: span 2;
        }

        .step-number {
            flex-shrink: 0;
            width: 6mm;
            height: 6mm;
            background: #0d9488;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 8pt;
        }

        .step-content h3 {
            font-size: 11pt;
            font-weight: 600;
            color: #0d9488;
            margin-bottom: 0.5mm;
        }

        .step-content p {
            font-size: 11pt;
            color: #4b5563;
            line-height: 1.25;
        }

        /* Three Column Section */
        .three-columns {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 3mm;
            margin-bottom: 4mm;
        }

        .column h2 {
            font-size: 9pt;
            font-weight: 600;
            color: #0d9488;
            margin-bottom: 2mm;
            padding-bottom: 1mm;
            border-bottom: 1px solid #e5e7eb;
        }

        .column ul {
            list-style: none;
            font-size: 8pt;
        }

        .column ul li {
            padding: 1mm 0;
            padding-left: 3mm;
            position: relative;
            line-height: 1.2;
        }

        .column ul li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #0d9488;
            font-weight: 600;
            font-size: 7pt;
        }

        /* QR Section */
        .qr-section {
            display: flex;
            gap: 4mm;
            background: linear-gradient(135deg, #0d9488 0%, #0891b2 100%);
            color: white;
            padding: 3mm;
            border-radius: 2mm;
            margin-bottom: 3mm;
        }

        .qr-code {
            flex-shrink: 0;
            width: 20mm;
            height: 20mm;
            background: white;
            border-radius: 1mm;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 7pt;
            color: #6b7280;
        }

        .qr-info h3 {
            font-size: 10pt;
            font-weight: 600;
            margin-bottom: 1mm;
        }

        .qr-info p {
            font-size: 8pt;
            opacity: 0.9;
        }

        .qr-info .url {
            font-size: 9pt;
            font-weight: 600;
            margin-top: 1mm;
        }

        /* Contact */
        .contact {
            display: flex;
            justify-content: center;
            gap: 6mm;
            padding: 2mm;
            background: #f9fafb;
            border-radius: 2mm;
            font-size: 8pt;
            margin-bottom: 3mm;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1mm;
        }

        .contact-item strong {
            color: #0d9488;
        }

        /* Important Notes */
        .notes {
            padding: 2mm 3mm;
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 2mm;
        }

        .notes h3 {
            font-size: 8pt;
            color: #92400e;
            margin-bottom: 1mm;
        }

        .notes ul {
            font-size: 7pt;
            color: #78350f;
            padding-left: 4mm;
            margin: 0;
        }

        .notes ul li {
            margin-bottom: 0.5mm;
        }

        /* Print Styles */
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .container {
                padding: 5mm;
            }

            .no-print {
                display: none !important;
            }
        }

        /* Print Button */
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #0d9488;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .print-btn:hover {
            background: #0f766e;
        }

        @page {
            size: A4;
            margin: 0;
        }
    </style>
</head>

<body>
    <button class="print-btn no-print" onclick="window.print()">🖨️ Cetak Panduan</button>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>PANDUAN PENDAFTARAN MAHASISWA BARU</h1>
            <p>Universitas Nahdlatul Ulama Kalimantan Timur</p>
        </div>

        <!-- Period Info -->
        @if ($activePeriod)
            <div class="period-info">
                <strong>📅 Periode Aktif:</strong> {{ $activePeriod->name }}
                ({{ \Carbon\Carbon::parse($activePeriod->start_date)->locale('id')->isoFormat('D MMM Y') }} -
                {{ \Carbon\Carbon::parse($activePeriod->end_date)->locale('id')->isoFormat('D MMM Y') }})
            </div>
        @endif

        <!-- Steps Grid -->
        <div class="steps-grid">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Registrasi Akun</h3>
                    <p>Buka website PMB, klik <strong>"Daftar"</strong>. Isi email aktif, nama, dan password. Verifikasi
                        email melalui link yang dikirim.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Lengkapi Biodata</h3>
                    <p>Login, lengkapi data pribadi: NIK, NISN, TTL, alamat, dan upload foto 4x6 latar merah.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Upload Dokumen</h3>
                    <p>Upload <strong>KTP</strong>, <strong>Kartu Keluarga</strong>, dan <strong>Ijazah/SKL</strong>.
                        Format: PDF/JPG/PNG, maks 2MB.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3>Pilih Program Studi</h3>
                    <p>Pilih jenis pendaftaran, jalur masuk, dan <strong>2 pilihan prodi</strong> sesuai minat Anda.</p>
                </div>
            </div>

            <div class="step full-width">
                <div class="step-number">5</div>
                <div class="step-content">
                    <h3>Verifikasi & Daftar Ulang</h3>
                    <p>Tunggu verifikasi Tim PMB. Setelah lolos, Anda akan dihubungi untuk proses <strong>daftar
                            ulang</strong> dan pembayaran UKT.</p>
                </div>
            </div>
        </div>

        <!-- Three Columns -->
        <div class="three-columns">
            <div class="column">
                <h2>📋 Dokumen Diperlukan</h2>
                <ul>
                    <li>Foto 4x6 latar merah</li>
                    <li>Scan/Foto KTP</li>
                    <li>Scan/Foto Kartu Keluarga</li>
                    <li>Scan/Foto Ijazah/SKL</li>
                </ul>
            </div>
            <div class="column">
                <h2>✅ Tips Sukses</h2>
                <ul>
                    <li>Gunakan email aktif</li>
                    <li>Siapkan dokumen sebelum daftar</li>
                    <li>Pastikan foto jelas & terbaca</li>
                    <li>Isi data sesuai dokumen resmi</li>
                    <li>Simpan nomor WA panitia</li>
                </ul>
            </div>
            <div class="column">
                <h2>❌ Yang Harus Dihindari</h2>
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
            <div class="qr-code">
                <img src="{{ asset('assets/images/qr-code-with-logo.png') }}" alt="QR Code PMB"
                    style="width: 100%; height: 100%; object-fit: contain; border-radius: 1mm;">
            </div>
            <div class="qr-info">
                <h3>🌐 Akses Website PMB</h3>
                <p>Scan QR Code atau kunjungi:</p>
                <p class="url">{{ config('app.url') }}</p>
            </div>
        </div>

        <!-- Contact -->
        <div class="contact">
            @if ($settings['contact']->where('key', 'contact_phone_1')->first()?->value)
                <div class="contact-item">
                    <span>📱</span>
                    <span><strong>WA:</strong>
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

        <!-- Important Notes -->
        <div class="notes">
            <h3>⚠️ Catatan Penting:</h3>
            <ul>
                <li>Pendaftaran <strong>GRATIS</strong>, tidak dipungut biaya apapun</li>
                <li>Panitia TIDAK PERNAH meminta transfer uang melalui WhatsApp/telepon</li>
                <li>Hubungi panitia resmi jika mengalami kendala teknis</li>
            </ul>
        </div>
    </div>
</body>

</html>
