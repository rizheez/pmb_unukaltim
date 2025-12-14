@extends('layouts.student')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Dashboard
                </h2>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-600 rounded-lg shadow-lg text-white p-6 relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl font-bold mb-2">Selamat Datang di Website PMB UNUKALTIM</h2>
                <p class="text-teal-100 max-w-2xl">
                    Sistem Penerimaan Mahasiswa Baru Universitas Nahdlatul Ulama Kalimantan Timur.
                    Silakan lengkapi biodata dan ikuti alur pendaftaran yang tersedia.
                </p>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute right-0 top-0 h-full w-1/3 opacity-10 transform translate-x-10 -translate-y-10">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor"
                        d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.3,82.3,22.9,71.3,35.1C60.3,47.3,49.5,58.1,36.9,64.9C24.3,71.7,9.9,74.5,-3.3,80.2C-16.5,85.9,-28.5,94.5,-39.2,87.3C-49.9,80.1,-59.3,57.1,-65.8,38.3C-72.3,19.5,-75.9,4.9,-73.4,-8.6C-70.9,-22.1,-62.3,-34.5,-52,-44.9C-41.7,-55.3,-29.7,-63.7,-16.8,-68.2C-3.9,-72.7,10,-73.3,23.5,-73.8L37,-74.3Z"
                        transform="translate(100 100)" />
                </svg>
            </div>
        </div>

        <!-- Period Info -->
        @if ($activePeriod)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="calendar" class="h-5 w-5 text-blue-600"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">{{ $activePeriod->name }}</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>Periode: {{ $activePeriod->start_date->format('d M Y') }} -
                                {{ $activePeriod->end_date->format('d M Y') }}</p>
                            @if ($activePeriod->quota)
                                <p>Kuota: {{ $activePeriod->quota }} pendaftar</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="alert-triangle" class="h-5 w-5 text-yellow-600"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Periode Pendaftaran Belum Dibuka</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Saat ini tidak ada periode pendaftaran yang aktif. Silakan tunggu pengumuman lebih lanjut.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Document Verification Notifications -->
        @if ($rejectedVerifications->count() > 0)
            <div id="verification-alert" class="bg-red-50 border-l-4 border-red-500 p-4 rounded relative">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="alert-circle" class="h-5 w-5 text-red-600"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-medium text-red-800">Pemberitahuan Verifikasi Berkas</h3>
                        <div class="mt-2 text-sm text-red-700 space-y-2">
                            <p>Beberapa dokumen/data Anda memerlukan perbaikan:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($rejectedVerifications as $verification)
                                    <li>
                                        <strong>{{ $verification->document_type_name }}</strong>
                                        @if ($verification->notes)
                                            <br><span class="ml-5 text-xs">Catatan: {{ $verification->notes }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3 flex items-center gap-3">
                                <a href="{{ route('student.biodata.edit') }}"
                                    class="font-medium underline hover:text-red-900">
                                    Perbaiki sekarang →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function dismissNotification() {
                    Swal.fire({
                        title: 'Tandai sebagai sudah dibaca?',
                        text: 'Notifikasi ini akan disembunyikan',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#0d9488',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('{{ route('student.verifications.mark-read') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    document.getElementById('verification-alert').style.display = 'none';
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    // Hide anyway on error
                                    document.getElementById('verification-alert').style.display = 'none';
                                });
                        }
                    });
                }
            </script>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Pengumuman Card -->
            <div class="col-span-1 lg:col-span-2 bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4 border-b pb-2">
                    <h3 class="text-lg font-medium text-gray-900">Pengumuman</h3>
                </div>
                @if ($announcements->count() > 0)
                    <div class="space-y-4 overflow-y-auto max-h-64 lg:max-h-96 pr-1">
                        @foreach ($announcements as $announcement)
                            <div class="border-l-4 border-teal-500 bg-teal-50 p-4 rounded">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i data-lucide="megaphone" class="h-5 w-5 text-teal-600"></i>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <h4 class="text-sm font-medium text-teal-800">{{ $announcement->title }}</h4>
                                        <div class="mt-2 text-sm text-teal-700 text-left lg:text-justify">
                                            <p>{{ $announcement->content }}</p>
                                        </div>
                                        <div class="mt-2 text-xs text-teal-600">
                                            {{ $announcement->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-48 text-gray-400">
                        <i data-lucide="inbox" class="h-10 w-10 mb-2 opacity-50"></i>
                        <p>Belum ada pengumuman :(</p>
                    </div>
                @endif
            </div>
            <!-- Biodata Wajib Card -->
            <div class="col-span-1 bg-white shadow rounded-lg p-6 border-t-4 border-teal-600">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Biodata Wajib</h3>
                @if ($biodata)
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Nama Lengkap</span>
                            <span class="font-medium text-gray-900">{{ $biodata->name }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">NIK</span>
                            <span class="font-medium text-gray-900">{{ $biodata->nik ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">NISN</span>
                            <span class="font-medium text-gray-900">{{ $biodata->nisn ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Asal Sekolah</span>
                            <span class="font-medium text-gray-900">{{ $biodata->school_origin ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Telepon</span>
                            <span class="font-medium text-gray-900">{{ $biodata->phone ?? '-' }}</span>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-3">
                            <i data-lucide="alert-circle" class="h-6 w-6 text-red-600"></i>
                        </div>
                        <p class="text-sm text-gray-500 mb-3">Biodata belum diisi.</p>
                        @if ($activePeriod)
                            <a href="{{ route('student.biodata.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700">
                                Isi Biodata
                            </a>
                        @else
                            <button disabled
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-400 cursor-not-allowed">
                                Isi Biodata
                            </button>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Registration Status Card -->
            <div class="col-span-1 bg-white shadow rounded-lg p-6 border-t-4 border-teal-600">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Status Pendaftaran</h3>
                @if ($registration)
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Jenis Pendaftaran</span>
                            <span
                                class="font-medium text-gray-900">{{ $registration->registrationType->name ?? '-' }}</span>
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
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $registration->status_badge_class }}">
                                {{ $registration->status_label }}
                            </span>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-3">
                            <i data-lucide="file-text" class="h-6 w-6 text-gray-400"></i>
                        </div>
                        <p class="text-sm text-gray-500 mb-3">Belum mendaftar.</p>
                        @if ($activePeriod && $biodata)
                            <a href="{{ route('student.pendaftaran.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Daftar Sekarang
                            </a>
                        @else
                            <button disabled
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-400 cursor-not-allowed">
                                Daftar Sekarang
                            </button>
                            @if (!$biodata)
                                <p class="text-xs text-gray-400 mt-2">Lengkapi biodata terlebih dahulu</p>
                            @endif
                        @endif
                    </div>
                @endif
            </div>


        </div>

        <!-- Alur Pendaftaran -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Alur Pendaftaran</h3>
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-between">
                    @foreach ($steps as $index => $step)
                        <div class="flex flex-col items-center group">
                            <span
                                class="h-8 w-8 rounded-full flex items-center justify-center ring-4 ring-white {{ $step['completed'] ? 'bg-teal-600' : ($step['active'] ? 'bg-blue-600' : 'bg-gray-200') }}">
                                @if ($step['completed'])
                                    <i data-lucide="check" class="h-5 w-5 text-white"></i>
                                @else
                                    <span class="text-white text-xs">{{ $index + 1 }}</span>
                                @endif
                            </span>
                            <span
                                class="mt-2 text-xs font-medium {{ $step['active'] || $step['completed'] ? 'text-gray-900' : 'text-gray-500' }}">{{ $step['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
