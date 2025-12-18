<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.students.index') }}" class="text-blue-500 hover:text-blue-700">&larr; Kembali ke
            Daftar</a>
        <div class="flex items-center justify-between mt-2">
            <h2 class="text-2xl font-bold text-gray-800">Detail Calon Mahasiswa: {{ $student->name }}</h2>
            <div class="flex items-center space-x-3">
                @if ($student->email_verified_at)
                    <span class="px-3 py-1 text-sm rounded bg-green-100 text-green-800">
                        ✓ Email Terverifikasi
                    </span>
                    <span class="text-xs text-gray-500">
                        {{ $student->email_verified_at->locale('id')->isoFormat('D MMMM Y') }}
                    </span>
                @else
                    <span class="px-3 py-1 text-sm rounded bg-red-100 text-red-800">
                        ✗ Email Belum Terverifikasi
                    </span>
                @endif

                <!-- Edit Biodata Button -->
                @if ($student->studentBiodata)
                    <button onclick="confirmEdit()"
                        class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Biodata
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Biodata -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Biodata</h3>
            @if ($student->studentBiodata)
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->name }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">NIK</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->nik }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">NISN</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->nisn }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Telepon</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->phone }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->gender }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $student->studentBiodata->birth_place }},
                            {{ \Carbon\Carbon::parse($student->studentBiodata->birth_date)->format('d M Y') }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Agama</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->religion }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Alamat Lengkap</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->address }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Asal Sekolah</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->school_origin }}
                            ({{ $student->studentBiodata->major }})</dd>
                    </div>
                </dl>
                <div class="mt-4">
                    <img src="{{ $student->studentBiodata->photo_url }}" alt="Student Photo"
                        class="h-32 w-32 object-cover rounded-md border">
                    {{-- button lihat foto --}}
                    <a href="{{ $student->studentBiodata->photo_url }}" target="_blank"
                        class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Lihat Foto
                    </a>
                </div>
            @else
                <p class="text-gray-500 italic">Biodata belum diisi.</p>
            @endif
        </div>

        <!-- Registration -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Pendaftaran</h3>
            @if ($student->registration)
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Jenis Pendaftaran</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->registration->registrationType->name }}
                        </dd>
                    </div>
                    @if ($student->registration->registrationPath || $student->registration->registration_path)
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Jalur Pendaftaran</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->registration->registrationPath->name ?? $student->registration->registration_path }}
                            </dd>
                        </div>
                    @endif
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $student->registration->status_badge_class }}">
                                {{ $student->registration->status_label }}
                            </span>
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Pilihan 1</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $student->registration->programStudiChoice1->full_name ?? '-' }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Pilihan 2</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $student->registration->programStudiChoice2->full_name ?? '-' }}</dd>
                    </div>

                    @if ($student->registration->referral_source)
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Sumber Informasi</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $student->registration->referral_source }}
                            </dd>
                        </div>
                    @endif

                    @if ($student->registration->referral_detail)
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                @if ($student->registration->referral_source == 'Dosen/Panitia PMB UNU Kaltim')
                                    Nama Dosen/Panitia PMB
                                @else
                                    Detail Sumber Informasi
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $student->registration->referral_detail }}
                            </dd>
                        </div>
                    @endif
                </dl>
            @else
                <p class="text-gray-500 italic">Pendaftaran belum disubmit.</p>
            @endif
        </div>
    </div>
    <!-- Document Verification Section -->
    @if ($student->studentBiodata)
        <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Verifikasi Berkas & Data</h3>

            <form action="{{ route('admin.students.verify', $student->studentBiodata->id) }}" method="POST"
                class="space-y-6">
                @csrf

                <!-- Photo Verification -->
                <div class="border rounded-lg p-4 bg-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 mb-2">Foto</h4>
                            @if ($student->studentBiodata->photo_path)
                                <img src="{{ $student->studentBiodata->photo_url }}" alt="Photo"
                                    class="h-32 w-32 object-cover rounded-md border mb-3">
                                @php
                                    $photoVerification = $student->studentBiodata->verifications
                                        ->where('document_type', 'photo')
                                        ->first();
                                @endphp
                                @if ($photoVerification)
                                    <div class="mb-2">
                                        <span class="text-sm">Status: {!! $photoVerification->status_badge !!}</span>
                                        @if ($photoVerification->notes)
                                            <p class="text-sm text-gray-600 mt-1">Catatan:
                                                {{ $photoVerification->notes }}</p>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500 italic">Belum upload</p>
                            @endif
                        </div>
                        @if ($student->studentBiodata->photo_path)
                            <div class="ml-4 w-64">
                                <input type="hidden" name="verifications[0][document_type]" value="photo">
                                <select name="verifications[0][status]"
                                    class="w-full rounded-md border-gray-300 mb-2">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="approved">Setujui</option>
                                    <option value="rejected">Tolak</option>
                                </select>
                                <textarea name="verifications[0][notes]" rows="2" placeholder="Catatan (opsional)"
                                    class="w-full rounded-md border-gray-300 text-sm"></textarea>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- KK Verification -->
                <div class="border rounded-lg p-4 bg-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 mb-2">Kartu Keluarga (KK)</h4>
                            @if ($student->studentBiodata->kk_path)
                                <a href="{{ $student->studentBiodata->kk_url }}" target="_blank"
                                    class="text-blue-600 hover:underline text-sm">Lihat Dokumen</a>
                                @php
                                    $kkVerification = $student->studentBiodata->verifications
                                        ->where('document_type', 'kk')
                                        ->first();
                                @endphp
                                @if ($kkVerification)
                                    <div class="mt-2">
                                        <span class="text-sm">Status: {!! $kkVerification->status_badge !!}</span>
                                        @if ($kkVerification->notes)
                                            <p class="text-sm text-gray-600 mt-1">Catatan:
                                                {{ $kkVerification->notes }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500 italic">Belum upload</p>
                            @endif
                        </div>
                        @if ($student->studentBiodata->kk_path)
                            <div class="ml-4 w-64">
                                <input type="hidden" name="verifications[1][document_type]" value="kk">
                                <select name="verifications[1][status]"
                                    class="w-full rounded-md border-gray-300 mb-2">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="approved">Setujui</option>
                                    <option value="rejected">Tolak</option>
                                </select>
                                <textarea name="verifications[1][notes]" rows="2" placeholder="Catatan (opsional)"
                                    class="w-full rounded-md border-gray-300 text-sm"></textarea>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- KTP Verification -->
                <div class="border rounded-lg p-4 bg-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 mb-2">KTP</h4>
                            @if ($student->studentBiodata->ktp_path)
                                <a href="{{ $student->studentBiodata->ktp_url }}" target="_blank"
                                    class="text-blue-600 hover:underline text-sm">Lihat Dokumen</a>
                                @php
                                    $ktpVerification = $student->studentBiodata->verifications
                                        ->where('document_type', 'ktp')
                                        ->first();
                                @endphp
                                @if ($ktpVerification)
                                    <div class="mt-2">
                                        <span class="text-sm">Status: {!! $ktpVerification->status_badge !!}</span>
                                        @if ($ktpVerification->notes)
                                            <p class="text-sm text-gray-600 mt-1">Catatan:
                                                {{ $ktpVerification->notes }}</p>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500 italic">Belum upload</p>
                            @endif
                        </div>
                        @if ($student->studentBiodata->ktp_path)
                            <div class="ml-4 w-64">
                                <input type="hidden" name="verifications[2][document_type]" value="ktp">
                                <select name="verifications[2][status]"
                                    class="w-full rounded-md border-gray-300 mb-2">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="approved">Setujui</option>
                                    <option value="rejected">Tolak</option>
                                </select>
                                <textarea name="verifications[2][notes]" rows="2" placeholder="Catatan (opsional)"
                                    class="w-full rounded-md border-gray-300 text-sm"></textarea>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Certificate Verification -->
                <div class="border rounded-lg p-4 bg-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 mb-2">Ijazah/SKL</h4>
                            @if ($student->studentBiodata->certificate_path)
                                <a href="{{ $student->studentBiodata->certificate_url }}" target="_blank"
                                    class="text-blue-600 hover:underline text-sm">Lihat Dokumen</a>
                                @php
                                    $certVerification = $student->studentBiodata->verifications
                                        ->where('document_type', 'certificate')
                                        ->first();
                                @endphp
                                @if ($certVerification)
                                    <div class="mt-2">
                                        <span class="text-sm">Status: {!! $certVerification->status_badge !!}</span>
                                        @if ($certVerification->notes)
                                            <p class="text-sm text-gray-600 mt-1">Catatan:
                                                {{ $certVerification->notes }}</p>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <p class="text-sm text-gray-500 italic">Belum upload</p>
                            @endif
                        </div>
                        @if ($student->studentBiodata->certificate_path)
                            <div class="ml-4 w-64">
                                <input type="hidden" name="verifications[3][document_type]" value="certificate">
                                <select name="verifications[3][status]"
                                    class="w-full rounded-md border-gray-300 mb-2">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="approved">Setujui</option>
                                    <option value="rejected">Tolak</option>
                                </select>
                                <textarea name="verifications[3][notes]" rows="2" placeholder="Catatan (opsional)"
                                    class="w-full rounded-md border-gray-300 text-sm"></textarea>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Biodata Verification -->
                <div class="border rounded-lg p-4 bg-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 mb-2">Data Biodata</h4>
                            <div class="text-sm space-y-1">
                                <p><span class="text-gray-600">Nama Lengkap:</span>
                                    {{ $student->studentBiodata->name }}</p>
                                <p><span class="text-gray-600">NIK:</span> {{ $student->studentBiodata->nik }}</p>
                                <p><span class="text-gray-600">NISN:</span> {{ $student->studentBiodata->nisn }}</p>
                                <p><span class="text-gray-600">Asal Sekolah:</span>
                                    {{ $student->studentBiodata->school_origin }}</p>
                                <p><span class="text-gray-600">Telepon:</span> {{ $student->studentBiodata->phone }}
                                </p>
                                <p><span class="text-gray-600">Jenis Kelamin:</span>
                                    {{ $student->studentBiodata->gender }}</p>
                                <p><span class="text-gray-600">Tempat, Tanggal Lahir:</span>
                                    {{ $student->studentBiodata->birth_place }},
                                    {{ $student->studentBiodata->birth_date }}</p>
                                <p><span class="text-gray-600">Agama:</span> {{ $student->studentBiodata->religion }}
                                </p>
                                <p><span class="text-gray-600">Alamat Lengkap:</span>
                                    {{ $student->studentBiodata->address }}</p>

                            </div>
                            @php
                                $biodataVerification = $student->studentBiodata->verifications
                                    ->where('document_type', 'biodata')
                                    ->first();
                            @endphp
                            @if ($biodataVerification)
                                <div class="mt-2">
                                    <span class="text-sm">Status: {!! $biodataVerification->status_badge !!}</span>
                                    @if ($biodataVerification->notes)
                                        <p class="text-sm text-gray-600 mt-1">Catatan:
                                            {{ $biodataVerification->notes }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="ml-4 w-64">
                            <input type="hidden" name="verifications[4][document_type]" value="biodata">
                            <select name="verifications[4][status]" class="w-full rounded-md border-gray-300 mb-2">
                                <option value="">-- Pilih Status --</option>
                                <option value="approved">Setujui</option>
                                <option value="rejected">Tolak</option>
                            </select>
                            <textarea name="verifications[4][notes]" rows="2" placeholder="Catatan (opsional)"
                                class="w-full rounded-md border-gray-300 text-sm"></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan Verifikasi
                    </button>
                </div>
            </form>
        </div>
    @endif
    </div>



    <script>
        // Form validation and confirmation
        document.addEventListener('DOMContentLoaded', function() {
            const verificationForm = document.querySelector('form[action*="verify"]');

            if (verificationForm) {
                verificationForm.addEventListener('submit', function(e) {
                    // Check if at least one status is selected
                    const statusSelects = this.querySelectorAll('select[name*="[status]"]');
                    let hasSelection = false;

                    statusSelects.forEach(select => {
                        if (select.value) {
                            hasSelection = true;
                        }
                    });

                    if (!hasSelection) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian!',
                            text: 'Silakan pilih status verifikasi untuk minimal satu dokumen.',
                            confirmButtonColor: '#0d9488'
                        });
                        return false;
                    }

                    // Confirm submission
                    e.preventDefault();
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menyimpan verifikasi ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#0d9488',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Simpan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            verificationForm.submit();
                        }
                    });
                });
            }
        });

        // Confirm Edit Biodata
        function confirmEdit() {
            Swal.fire({
                title: 'Edit Biodata Mahasiswa?',
                html: `
                    <div class="text-left">
                        <p class="text-gray-700 mb-2">Anda akan mengedit biodata mahasiswa:</p>
                        <p class="font-semibold text-gray-900">{{ $student->name }}</p>
                        <div class="mt-4 p-3 bg-yellow-50 border-l-4 border-yellow-400 text-sm">
                            <p class="text-yellow-800">
                                <strong>⚠️ Perhatian:</strong><br>
                                • Pastikan data yang diubah sudah benar<br>
                                • Perubahan akan tersimpan di database<br>
                                • Calon Mahasiswa akan melihat data yang diupdate
                            </p>
                        </div>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d97706',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Edit Biodata',
                cancelButtonText: 'Batal',
                width: '500px'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('admin.students.edit-biodata', $student->id) }}';
                }
            });
        }
    </script>
</x-admin-layout>
