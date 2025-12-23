@extends('layouts.student')

@section('content')
    <div class="space-y-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Pendaftaran
                </h2>
            </div>
        </div>

        <!-- Pendaftaran Form -->
        <div class="bg-white shadow rounded-lg p-6">
            @if ($registration && !in_array($registration->status, ['draft', 'submitted']))
                <div class="text-center py-8">
                    <i data-lucide="check-circle" class="mx-auto h-12 w-12 text-green-500"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Pendaftaran Berhasil Dikirim</h3>
                    <p class="mt-1 text-sm text-gray-500">Anda telah mendaftar. Silakan tunggu informasi selanjutnya.</p>
                    @if ($registration->registration_number)
                        <p class="mt-2 text-sm text-gray-600">
                            Nomor Pendaftaran: <span
                                class="font-mono font-bold">{{ $registration->registration_number }}</span>
                        </p>
                    @endif
                </div>
            @elseif ($registration && $registration->status === 'submitted' && !request()->has('edit'))
                {{-- Read-only view with Edit button --}}
                <div class="space-y-6">
                    <div class="bg-green-50 border border-green-200 rounded-md p-4">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="h-5 w-5 text-green-600"></i>
                            <p class="text-sm text-green-700">
                                Pendaftaran berhasil dengan nomor <span
                                    class="font-mono font-bold">{{ $registration->registration_number }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-y-4 gap-x-6 sm:grid-cols-2">
                        <div class="border-b pb-3">
                            <dt class="text-sm font-medium text-gray-500">Jenis Pendaftaran</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $registration->registrationType->name ?? '-' }}</dd>
                        </div>
                        <div class="border-b pb-3">
                            <dt class="text-sm font-medium text-gray-500">Jalur Pendaftaran</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $registration->registrationPath->name ?? '-' }}</dd>
                        </div>
                        <div class="border-b pb-3">
                            <dt class="text-sm font-medium text-gray-500">Pilihan 1</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $registration->programStudiChoice1->full_name ?? '-' }}</dd>
                        </div>
                        <div class="border-b pb-3">
                            <dt class="text-sm font-medium text-gray-500">Pilihan 2</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $registration->programStudiChoice2->full_name ?? '-' }}</dd>
                        </div>
                        <div class="border-b pb-3 sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Sumber Informasi PMB</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $registration->referral_source ?? '-' }}
                                @if ($registration->referral_detail)
                                    <span class="text-gray-500">({{ $registration->referral_detail }})</span>
                                @endif
                            </dd>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <a href="{{ route('student.pendaftaran.index', ['edit' => 1]) }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <i data-lucide="pencil" class="h-4 w-4 mr-2"></i>
                            Ubah Pendaftaran
                        </a>
                    </div>
                </div>
            @else
                {{-- Show form for new registration or when editing --}}
                @if ($registration && $registration->status === 'submitted')
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                        <div class="flex items-center gap-2">
                            <i data-lucide="info" class="h-5 w-5 text-blue-600"></i>
                            <p class="text-sm text-blue-700">
                                Anda sedang mengubah pendaftaran dengan nomor <span
                                    class="font-mono font-bold">{{ $registration->registration_number }}</span>.
                            </p>
                        </div>
                    </div>
                @endif
                <form action="{{ route('student.pendaftaran.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="registration_type_id" class="block text-sm font-medium text-gray-700">Jenis
                                Pendaftaran</label>
                            <select name="registration_type_id" id="registration_type_id"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Jenis Pendaftaran</option>
                                @foreach ($registrationTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('registration_type_id', $registration?->registration_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('registration_type_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="registration_path_id" class="block text-sm font-medium text-gray-700">Jalur
                                Pendaftaran</label>
                            <select name="registration_path_id" id="registration_path_id"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Jalur Pendaftaran</option>
                                @foreach ($registrationPaths as $path)
                                    <option value="{{ $path->id }}"
                                        {{ old('registration_path_id', $registration?->registration_path_id) == $path->id ? 'selected' : '' }}>
                                        {{ $path->name }}</option>
                                @endforeach
                            </select>
                            @error('registration_path_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Referral Source -->
                        <div class="sm:col-span-2">
                            <label for="referral_source" class="block text-sm font-medium text-gray-700">Dari mana Anda
                                mengetahui informasi PMB UNU Kaltim?</label>
                            <select name="referral_source" id="referral_source"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Sumber Informasi</option>
                                <option value="Dosen/Panitia PMB UNU Kaltim"
                                    {{ old('referral_source', $registration?->referral_source) == 'Dosen/Panitia PMB UNU Kaltim' ? 'selected' : '' }}>
                                    Dosen/Panitia PMB UNU Kaltim</option>
                                <option value="Media Sosial (Instagram/Facebook/Twitter)"
                                    {{ old('referral_source', $registration?->referral_source) == 'Media Sosial (Instagram/Facebook/Twitter)' ? 'selected' : '' }}>
                                    Media Sosial
                                    (Instagram/Facebook/Twitter)</option>
                                <option value="Website Resmi UNU Kaltim"
                                    {{ old('referral_source', $registration?->referral_source) == 'Website Resmi UNU Kaltim' ? 'selected' : '' }}>
                                    Website Resmi UNU Kaltim</option>
                                <option value="Teman/Keluarga"
                                    {{ old('referral_source', $registration?->referral_source) == 'Teman/Keluarga' ? 'selected' : '' }}>
                                    Teman/Keluarga</option>
                                <option value="Sekolah/Guru"
                                    {{ old('referral_source', $registration?->referral_source) == 'Sekolah/Guru' ? 'selected' : '' }}>
                                    Sekolah/Guru</option>
                                <option value="Brosur/Spanduk"
                                    {{ old('referral_source', $registration?->referral_source) == 'Brosur/Spanduk' ? 'selected' : '' }}>
                                    Brosur/Spanduk</option>
                                <option value="Event/Pameran Pendidikan"
                                    {{ old('referral_source', $registration?->referral_source) == 'Event/Pameran Pendidikan' ? 'selected' : '' }}>
                                    Event/Pameran Pendidikan</option>
                                <option value="Lainnya"
                                    {{ old('referral_source', $registration?->referral_source) == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya</option>
                            </select>
                            @error('referral_source')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Referral Detail (shown when "Dosen/Panitia PMB UNU Kaltim" or "Lainnya" is selected) -->
                        <div class="sm:col-span-2" id="referral_detail_wrapper"
                            style="{{ in_array(old('referral_source', $registration?->referral_source), ['Dosen/Panitia PMB UNU Kaltim', 'Lainnya']) ? '' : 'display: none;' }}">
                            <label for="referral_detail" class="block text-sm font-medium text-gray-700"
                                id="referral_detail_label">Sebutkan sumber
                                informasi lainnya</label>
                            <input type="text" name="referral_detail" id="referral_detail"
                                value="{{ old('referral_detail', $registration?->referral_detail) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                placeholder="Contoh: Radio, Iklan Google, dll">
                            @error('referral_detail')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Program Studi Pilihan -->
                        <div class="sm:col-span-2">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Pilihan Program Studi (Maksimal 2)</h4>
                        </div>

                        <div>
                            <label for="choice_1" class="block text-sm font-medium text-gray-700">Pilihan 1</label>
                            <select name="choice_1" id="choice_1"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Program Studi 1</option>
                                @foreach ($fakultas as $fak)
                                    <optgroup label="{{ $fak->name }}">
                                        @foreach ($fak->programStudi as $ps)
                                            <option value="{{ $ps->id }}"
                                                {{ old('choice_1', $registration?->choice_1) == $ps->id ? 'selected' : '' }}>
                                                {{ $ps->full_name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('choice_1')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="choice_2" class="block text-sm font-medium text-gray-700">Pilihan 2
                                (Opsional)</label>
                            <select name="choice_2" id="choice_2"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Program Studi 2</option>
                                @foreach ($fakultas as $fak)
                                    <optgroup label="{{ $fak->name }}">
                                        @foreach ($fak->programStudi as $ps)
                                            <option value="{{ $ps->id }}"
                                                {{ old('choice_2', $registration?->choice_2) == $ps->id ? 'selected' : '' }}>
                                                {{ $ps->full_name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('choice_2')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-gray-50 border border-gray-200 rounded-md p-4 mt-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="info" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Persyaratan Pendaftaran</h3>
                                <div class="mt-2 text-sm text-gray-500">
                                    <ol class="list-decimal pl-5 space-y-1">
                                        <li>Warga Negara Indonesia</li>
                                        <li>Warga Negara Asing yang memiliki izin tinggal di Indonesia</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            {{ $registration ? 'Simpan Perubahan' : 'Lanjut Pendaftaran' }}
                        </button>
                    </div>
                </form>
            @endif
        </div>


        <!-- Riwayat Pendaftaran -->
        <div class="mt-8">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Riwayat Pendaftaran</h3>
            @if ($registration)
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tanggal</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Jenis</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Jalur</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Pilihan 1</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $registration->updated_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $registration->registrationType->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $registration->registrationPath->name ?? ($registration->registration_path ?? '-') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $registration->programStudiChoice1->full_name ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    {{ ucfirst($registration->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white shadow rounded-lg p-6 text-center text-gray-500">
                    <i data-lucide="history" class="h-10 w-10 mx-auto mb-2 opacity-50"></i>
                    <p>Belum ada riwayat pendaftaran :(</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const referralSourceSelect = document.getElementById('referral_source');
            const referralDetailWrapper = document.getElementById('referral_detail_wrapper');
            const referralDetailInput = document.getElementById('referral_detail');
            const referralDetailLabel = document.getElementById('referral_detail_label');

            if (referralSourceSelect) {
                referralSourceSelect.addEventListener('change', function() {
                    if (this.value === 'Dosen/Panitia PMB UNU Kaltim') {
                        referralDetailWrapper.style.display = 'block';
                        referralDetailInput.required = true;
                        referralDetailLabel.textContent = 'Nama Dosen/Panitia PMB';
                        referralDetailInput.placeholder = 'Contoh: Dr. Ahmad Fauzi, M.Pd';
                    } else if (this.value === 'Lainnya') {
                        referralDetailWrapper.style.display = 'block';
                        referralDetailInput.required = true;
                        referralDetailLabel.textContent = 'Sebutkan sumber informasi lainnya';
                        referralDetailInput.placeholder = 'Contoh: Radio, Iklan Google, dll';
                    } else {
                        referralDetailWrapper.style.display = 'none';
                        referralDetailInput.required = false;
                        referralDetailInput.value = '';
                    }
                });
            }
        });
    </script>
@endpush
