@extends('layouts.student')

@section('content')
    <div class="space-y-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Biodata Wajib
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Calon mahasiswa wajib mengisi bagian ini sebelum melakukan pendaftaran.
                </p>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Pribadi</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Detail data diri dan kontak.</p>
                </div>
                @if (optional($biodata)->photo_url)
                    <img src="{{ optional($biodata)->photo_url }}" alt="Foto Profil"
                        class="h-16 w-16 rounded-full object-cover border-2 border-teal-500">
                @else
                    <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center">
                        <i data-lucide="user" class="text-gray-400 w-8 h-8"></i>
                    </div>
                @endif
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ optional($biodata)->name ?? (optional(Auth::user())->name ?? '-') }}</dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ optional($biodata)->gender ?? '-' }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if (optional($biodata)->birth_date)
                                {{ optional($biodata)->birth_place }},
                                {{ \Carbon\Carbon::parse(optional($biodata)->birth_date)->locale('id')->translatedFormat('d F Y') }}
                            @else
                                -
                            @endif
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Agama</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ optional($biodata)->religion ?? '-' }}</dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Alamat Lengkap</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ optional($biodata)->address ?? '-' }}</dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">NIK</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ optional($biodata)->nik ?? '-' }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">NISN</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ optional($biodata)->nisn ?? '-' }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Pendidikan Terakhir</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ optional($biodata)->last_education ?? '-' }}</dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Asal Sekolah</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ optional($biodata)->school_origin ?? '-' }}</dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Jurusan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ optional($biodata)->major ?? '-' }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nomor Handphone / WhatsApp</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ optional($biodata)->phone ?? (optional(Auth::user())->phone ?? '-') }}</dd>
                    </div>


                    @if (optional($biodata)->kk_path)
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Berkas KK</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <a href="{{ asset('storage/' . optional($biodata)->kk_path) }}" target="_blank"
                                    class="text-teal-600 hover:text-teal-800">Lihat Berkas</a>
                            </dd>
                        </div>
                    @endif

                    @if (optional($biodata)->ktp_path)
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Berkas KTP</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <a href="{{ asset('storage/' . optional($biodata)->ktp_path) }}" target="_blank"
                                    class="text-teal-600 hover:text-teal-800">Lihat Berkas</a>
                            </dd>
                        </div>
                    @endif

                    @if (optional($biodata)->certificate_path)
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Berkas Ijazah</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <a href="{{ asset('storage/' . optional($biodata)->certificate_path) }}" target="_blank"
                                    class="text-teal-600 hover:text-teal-800">Lihat Berkas</a>
                            </dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                @php
                    $activePeriod = \App\Models\RegistrationPeriod::active()->first();
                @endphp

                @if ($activePeriod)
                    <a href="{{ route('student.biodata.edit') }}"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Ubah Biodata
                    </a>
                @else
                    <div class="flex items-center justify-end gap-3">
                        <span class="text-sm text-red-600">
                            (Periode pendaftaran belum dibuka)
                        </span>
                        <button disabled
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-400 cursor-not-allowed">
                            Ubah Biodata
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
