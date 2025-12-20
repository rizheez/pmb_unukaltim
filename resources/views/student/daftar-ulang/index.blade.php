@extends('layouts.student')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Daftar Ulang
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Selamat! Anda telah dinyatakan lolos seleksi. Silakan lakukan proses daftar ulang.
                </p>
            </div>
        </div>

        <!-- Status Card -->
        <div
            class="bg-gradient-to-r from-green-500 to-teal-600 rounded-lg shadow-lg text-white p-6 relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i data-lucide="party-popper" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Selamat, {{ $biodata->name ?? auth()->user()->name }}!</h3>
                        <p class="text-green-100">Status Pendaftaran: <span
                                class="font-semibold">{{ $registration->status_label }}</span></p>
                    </div>
                </div>
                <p class="text-green-100">
                    Anda dinyatakan lolos seleksi dan dapat melanjutkan proses daftar ulang untuk menjadi mahasiswa baru UNU
                    Kaltim.
                </p>
            </div>
            <!-- Decorative -->
            <div class="absolute right-0 top-0 h-full w-1/3 opacity-10 transform translate-x-10 -translate-y-10">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor"
                        d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.3,82.3,22.9,71.3,35.1C60.3,47.3,49.5,58.1,36.9,64.9C24.3,71.7,9.9,74.5,-3.3,80.2C-16.5,85.9,-28.5,94.5,-39.2,87.3C-49.9,80.1,-59.3,57.1,-65.8,38.3C-72.3,19.5,-75.9,4.9,-73.4,-8.6C-70.9,-22.1,-62.3,-34.5,-52,-44.9C-41.7,-55.3,-29.7,-63.7,-16.8,-68.2C-3.9,-72.7,10,-73.3,23.5,-73.8L37,-74.3Z"
                        transform="translate(100 100)" />
                </svg>
            </div>
        </div>

        <!-- Registration Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Data Pendaftaran -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center gap-2">
                    <i data-lucide="file-text" class="w-5 h-5 text-teal-600"></i>
                    Data Pendaftaran Anda
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">Nama Lengkap</span>
                        <span class="font-medium text-gray-900">{{ $biodata->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">NIK</span>
                        <span class="font-medium text-gray-900">{{ $biodata->nik ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">Jenis Pendaftaran</span>
                        <span class="font-medium text-gray-900">{{ $registration->registrationType->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">Jalur Masuk</span>
                        <span class="font-medium text-gray-900">{{ $registration->registrationPath->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500">Pilihan 1</span>
                        <span
                            class="font-medium text-gray-900">{{ $registration->programStudiChoice1->full_name ?? '-' }}</span>
                    </div>
                    @if ($registration->choice_2)
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Pilihan 2</span>
                            <span
                                class="font-medium text-gray-900">{{ optional($registration->programStudiChoice2)->full_name ?? '-' }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $registration->status_badge_class }}">
                            {{ $registration->status_label }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Persyaratan Daftar Ulang -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center gap-2">
                    <i data-lucide="clipboard-check" class="w-5 h-5 text-teal-600"></i>
                    Persyaratan Daftar Ulang
                </h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-3 h-3 text-teal-600"></i>
                        </div>
                        <span class="text-gray-700">Ijazah/SKL asli dan fotokopi (2 lembar)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-3 h-3 text-teal-600"></i>
                        </div>
                        <span class="text-gray-700">KTP dan Kartu Keluarga fotokopi (2 lembar)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-3 h-3 text-teal-600"></i>
                        </div>
                        <span class="text-gray-700">Pas foto 3x4 latar merah (6 lembar)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-3 h-3 text-teal-600"></i>
                        </div>
                        <span class="text-gray-700">Bukti pembayaran UKT (sesuai ketentuan)</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-3 h-3 text-teal-600"></i>
                        </div>
                        <span class="text-gray-700">Surat keterangan sehat dari dokter</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-3 h-3 text-teal-600"></i>
                        </div>
                        <span class="text-gray-700">Materai 10.000 (2 lembar)</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Langkah Daftar Ulang -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center gap-2">
                <i data-lucide="list-ordered" class="w-5 h-5 text-teal-600"></i>
                Langkah-Langkah Daftar Ulang
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-teal-500">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold">
                            1</div>
                        <h4 class="font-semibold text-gray-900">Siapkan Berkas</h4>
                    </div>
                    <p class="text-sm text-gray-600">Siapkan semua dokumen persyaratan yang tercantum di atas.</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-teal-500">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold">
                            2</div>
                        <h4 class="font-semibold text-gray-900">Bayar UKT</h4>
                    </div>
                    <p class="text-sm text-gray-600">Lakukan pembayaran UKT sesuai dengan tagihan yang diberikan panitia.
                    </p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-teal-500">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold">
                            3</div>
                        <h4 class="font-semibold text-gray-900">Datang ke Kampus</h4>
                    </div>
                    <p class="text-sm text-gray-600">Datang ke kampus untuk proses daftar ulang dengan membawa semua
                        berkas.</p>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i data-lucide="phone" class="w-5 h-5 text-amber-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-amber-800 mb-2">Hubungi Panitia PMB</h3>
                    <p class="text-sm text-amber-700 mb-3">
                        Untuk informasi lebih lanjut mengenai jadwal, lokasi, dan biaya daftar ulang, silakan hubungi
                        panitia PMB.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            WhatsApp Panitia
                        </a>
                        <a href="{{ route('landing-page') }}#contact"
                            class="inline-flex items-center gap-2 bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            <i data-lucide="info" class="w-4 h-4"></i>
                            Info Kontak Lainnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
