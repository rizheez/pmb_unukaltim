<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.students.index') }}" class="text-blue-500 hover:text-blue-700">&larr; Back to List</a>
        <h2 class="text-2xl font-bold text-gray-800 mt-2">Student Details: {{ $student->name }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Biodata -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Biodata</h3>
            @if ($student->studentBiodata)
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">NIK</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->nik }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">NISN</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->nisn }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->phone }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Gender</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->gender }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">School Origin</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->studentBiodata->school_origin }}
                            ({{ $student->studentBiodata->major }})</dd>
                    </div>
                </dl>
                <div class="mt-4">
                    <img src="{{ $student->studentBiodata->photo_url }}" alt="Student Photo"
                        class="h-32 w-32 object-cover rounded-md border">
                </div>
            @else
                <p class="text-gray-500 italic">Biodata not filled yet.</p>
            @endif
        </div>

        <!-- Registration -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Registration</h3>
            @if ($student->registration)
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $student->registration->status_badge_class }}">
                                {{ $student->registration->status_label }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Registration Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->registration->registrationType->name }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Choice 1</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->registration->choice_1 }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Choice 2</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $student->registration->choice_2 }}</dd>
                    </div>
                </dl>
            @else
                <p class="text-gray-500 italic">Registration not submitted yet.</p>
            @endif
        </div>
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
                                <select name="verifications[0][status]" class="w-full rounded-md border-gray-300 mb-2">
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
                                            <p class="text-sm text-gray-600 mt-1">Catatan: {{ $kkVerification->notes }}
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
                                <select name="verifications[1][status]" class="w-full rounded-md border-gray-300 mb-2">
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
                                <p><span class="text-gray-600">NIK:</span> {{ $student->studentBiodata->nik }}</p>
                                <p><span class="text-gray-600">NISN:</span> {{ $student->studentBiodata->nisn }}</p>
                                <p><span class="text-gray-600">Asal Sekolah:</span>
                                    {{ $student->studentBiodata->school_origin }}</p>
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
                        alert('Silakan pilih status verifikasi untuk minimal satu dokumen.');
                        return false;
                    }

                    // Confirm submission
                    if (!confirm('Apakah Anda yakin ingin menyimpan verifikasi ini?')) {
                        e.preventDefault();
                        return false;
                    }
                });
            }
        });
    </script>
</x-admin-layout>
