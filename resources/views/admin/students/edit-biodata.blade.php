<x-admin-layout>
    <div class="space-y-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Edit Biodata Calon Mahasiswa
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Edit biodata untuk: <strong>{{ $student->name }}</strong>
                </p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg">
            <form action="{{ route('admin.students.update-biodata', $student->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6 space-y-8">
                @csrf
                @method('PUT')

                {{-- Data Akun --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Data Akun</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $student->email) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $student->phone) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('phone')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Data Pribadi --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Data Pribadi</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $student->studentBiodata->name) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nik" id="nik"
                                value="{{ old('nik', $student->studentBiodata->nik) }}" maxlength="16"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('nik')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                            <input type="text" name="nisn" id="nisn"
                                value="{{ old('nisn', $student->studentBiodata->nisn) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('nisn')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin <span
                                    class="text-red-500">*</span></label>
                            <select name="gender" id="gender"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki"
                                    {{ old('gender', $student->studentBiodata->gender) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan"
                                    {{ old('gender', $student->studentBiodata->gender) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @error('gender')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_place" class="block text-sm font-medium text-gray-700">Tempat Lahir <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="birth_place" id="birth_place"
                                value="{{ old('birth_place', $student->studentBiodata->birth_place) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('birth_place')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="birth_date" id="birth_date"
                                value="{{ old('birth_date', $student->studentBiodata->birth_date) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('birth_date')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="religion" class="block text-sm font-medium text-gray-700">Agama <span
                                    class="text-red-500">*</span></label>
                            <select name="religion" id="religion"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Agama</option>
                                <option value="Islam"
                                    {{ old('religion', $student->studentBiodata->religion) == 'Islam' ? 'selected' : '' }}>
                                    Islam
                                </option>
                                <option value="Kristen"
                                    {{ old('religion', $student->studentBiodata->religion) == 'Kristen' ? 'selected' : '' }}>
                                    Kristen
                                </option>
                                <option value="Katolik"
                                    {{ old('religion', $student->studentBiodata->religion) == 'Katolik' ? 'selected' : '' }}>
                                    Katolik
                                </option>
                                <option value="Hindu"
                                    {{ old('religion', $student->studentBiodata->religion) == 'Hindu' ? 'selected' : '' }}>
                                    Hindu
                                </option>
                                <option value="Buddha"
                                    {{ old('religion', $student->studentBiodata->religion) == 'Buddha' ? 'selected' : '' }}>
                                    Buddha
                                </option>
                                <option value="Konghucu"
                                    {{ old('religion', $student->studentBiodata->religion) == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu
                                </option>
                            </select>
                            @error('religion')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap <span
                                    class="text-red-500">*</span></label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">{{ old('address', $student->studentBiodata->address) }}</textarea>
                            @error('address')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="last_education" class="block text-sm font-medium text-gray-700">Pendidikan
                                Terakhir
                                <span class="text-red-500">*</span></label>
                            <select name="last_education" id="last_education"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Pendidikan Terakhir</option>
                                <option value="SMA/SMK"
                                    {{ old('last_education', $student->studentBiodata->last_education) == 'SMA/SMK' ? 'selected' : '' }}>
                                    SMA/SMK
                                </option>
                                <option value="D3"
                                    {{ old('last_education', $student->studentBiodata->last_education) == 'D3' ? 'selected' : '' }}>
                                    D3
                                </option>
                                <option value="S1"
                                    {{ old('last_education', $student->studentBiodata->last_education) == 'S1' ? 'selected' : '' }}>
                                    S1
                                </option>
                            </select>
                            @error('last_education')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="school_origin" class="block text-sm font-medium text-gray-700">Asal Sekolah
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="school_origin" id="school_origin"
                                value="{{ old('school_origin', $student->studentBiodata->school_origin) }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('school_origin')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="major" class="block text-sm font-medium text-gray-700">Jurusan
                                Sekolah <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="text" name="major" id="major"
                                value="{{ old('major', $student->studentBiodata->major) }}"
                                placeholder="Contoh: IPA, IPS, TKJ, Akuntansi"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            @error('major')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ada jurusan
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Dokumen --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Dokumen Pendukung</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Foto (Opsional -
                                Upload baru jika ingin ganti)</label>
                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="mt-1 text-xs text-gray-500">Maksimal 1MB</p>
                            @error('photo')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="ktp" class="block text-sm font-medium text-gray-700">KTP (Opsional -
                                Upload baru jika ingin ganti)</label>
                            <input type="file" name="ktp" id="ktp" accept="image/*,.pdf"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="mt-1 text-xs text-gray-500">Maksimal 2MB (PDF/JPG/PNG)</p>
                            @error('ktp')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="kk" class="block text-sm font-medium text-gray-700">Kartu Keluarga
                                (Opsional - Upload baru jika ingin ganti)</label>
                            <input type="file" name="kk" id="kk" accept="image/*,.pdf"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="mt-1 text-xs text-gray-500">Maksimal 2MB (PDF/JPG/PNG)</p>
                            @error('kk')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="certificate" class="block text-sm font-medium text-gray-700">Ijazah/SKL
                                (Opsional)</label>
                            <input type="file" name="certificate" id="certificate" accept="image/*,.pdf"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="mt-1 text-xs text-gray-500">Maksimal 2MB (PDF/JPG/PNG). Bisa diupload nanti jika
                                belum lulus</p>
                            @error('certificate')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Pendaftaran --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Data Pendaftaran</h3>
                    @if ($student->registration && $student->registration->registration_number)
                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="hash" class="h-5 w-5 text-blue-600"></i>
                                <p class="text-sm text-blue-700">
                                    Nomor Pendaftaran: <span
                                        class="font-mono font-bold">{{ $student->registration->registration_number }}</span>
                                </p>
                            </div>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="registration_type_id" class="block text-sm font-medium text-gray-700">Jenis
                                Pendaftaran <span class="text-red-500">*</span></label>
                            <select name="registration_type_id" id="registration_type_id"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">

                                <option value="">Pilih Jenis Pendaftaran</option>

                                @foreach ($registrationTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('registration_type_id', $student->registration->registration_type_id ?? '') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('registration_type_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="registration_path_id" class="block text-sm font-medium text-gray-700">Jalur
                                Pendaftaran <span class="text-red-500">*</span></label>
                            <select name="registration_path_id" id="registration_path_id"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Jalur Pendaftaran</option>
                                @foreach ($registrationPaths as $path)
                                    <option value="{{ $path->id }}"
                                        {{ old('registration_path_id', $student->registration->registration_path_id ?? '') == $path->id ? 'selected' : '' }}>
                                        {{ $path->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('registration_path_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>


                        <div>
                            <label for="choice_1" class="block text-sm font-medium text-gray-700">Pilihan 1 <span
                                    class="text-red-500">*</span></label>
                            <select name="choice_1" id="choice_1"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Program Studi 1</option>
                                @foreach ($fakultas as $fak)
                                    <optgroup label="{{ $fak->name }}">
                                        @foreach ($fak->programStudi as $ps)
                                            <option value="{{ $ps->id }}"
                                                {{ old('choice_1', $student->registration->choice_1 ?? '') == $ps->id ? 'selected' : '' }}>
                                                {{ $ps->full_name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('choice_1')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="choice_2" class="block text-sm font-medium text-gray-700">Pilihan 2 <span
                                    class="text-red-500">*</span></label>
                            <select name="choice_2" id="choice_2"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Program Studi 2</option>
                                @foreach ($fakultas as $fak)
                                    <optgroup label="{{ $fak->name }}">
                                        @foreach ($fak->programStudi as $ps)
                                            <option value="{{ $ps->id }}"
                                                {{ old('choice_2', $student->registration->choice_2 ?? '') == $ps->id ? 'selected' : '' }}>
                                                {{ $ps->full_name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('choice_2')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Referral Information --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Informasi Referral</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Referral Source -->
                        <div class="sm:col-span-2">
                            <label for="referral_source" class="block text-sm font-medium text-gray-700">Dari mana
                                calon mahasiswa mengetahui informasi PMB?</label>
                            <select name="referral_source" id="referral_source_admin"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Pilih Sumber Informasi</option>
                                <option value="Dosen/Panitia PMB UNU Kaltim"
                                    {{ old('referral_source', $student->registration->referral_source ?? '') == 'Dosen/Panitia PMB UNU Kaltim' ? 'selected' : '' }}>
                                    Dosen/Panitia PMB UNU Kaltim</option>
                                <option value="Media Sosial (Instagram/Facebook/Twitter)"
                                    {{ old('referral_source', $student->registration->referral_source ?? '') == 'Media Sosial (Instagram/Facebook/Twitter)' ? 'selected' : '' }}>
                                    Media Sosial (Instagram/Facebook/Twitter)</option>
                                <option value="Website Resmi UNU Kaltim"
                                    {{ old('referral_source', $student->registration->referral_source ?? '') == 'Website Resmi UNU Kaltim' ? 'selected' : '' }}>
                                    Website Resmi UNU Kaltim</option>
                                <option value="Teman/Keluarga"
                                    {{ old('referral_source', $student->registration->referral_source ?? '') == 'Teman/Keluarga' ? 'selected' : '' }}>
                                    Teman/Keluarga
                                </option>
                                <option value="Sekolah/Guru"
                                    {{ old('referral_source', $student->registration->referral_source ?? '') == 'Sekolah/Guru' ? 'selected' : '' }}>
                                    Sekolah/Guru
                                </option>
                                <option value="Brosur/Spanduk"
                                    {{ old('referral_source', $student->registration->referral_source ?? '') == 'Brosur/Spanduk' ? 'selected' : '' }}>
                                    Brosur/Spanduk
                                </option>
                                <option value="Event/Pameran Pendidikan"
                                    {{ old('referral_source', $student->registration->referral_source ?? '') == 'Event/Pameran Pendidikan' ? 'selected' : '' }}>
                                    Event/Pameran Pendidikan</option>
                                <option value="Lainnya"
                                    {{ old('referral_source', $student->registration->referral_source ?? '') == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya</option>
                            </select>
                            @error('referral_source')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Referral Detail -->
                        <div class="sm:col-span-2" id="referral_detail_wrapper_admin"
                            style="display: {{ old('referral_source', $student->registration->referral_source ?? '') == 'Lainnya' || old('referral_source', $student->registration->referral_source ?? '') == 'Dosen/Panitia PMB UNU Kaltim' ? 'block' : 'none' }};">
                            <label for="referral_detail" class="block text-sm font-medium text-gray-700"
                                id="referral_detail_label_admin">
                                {{ old('referral_source', $student->registration->referral_source ?? '') == 'Dosen/Panitia PMB UNU Kaltim' ? 'Nama Dosen/Panitia PMB' : 'Sebutkan sumber informasi lainnya' }}</label>
                            <input type="text" name="referral_detail" id="referral_detail_admin"
                                value="{{ old('referral_detail', $student->registration->referral_detail ?? '') }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                placeholder="{{ old('referral_source', $student->registration->referral_source ?? '') == 'Dosen/Panitia PMB UNU Kaltim' ? 'Contoh: Dr. Ahmad Fauzi, M.Pd' : 'Contoh: Radio, Iklan Google, dll' }}">
                            @error('referral_detail')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('admin.students.show', $student->id) }}"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Update Biodata
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const referralSourceSelect = document.getElementById('referral_source_admin');
                const referralDetailWrapper = document.getElementById('referral_detail_wrapper_admin');
                const referralDetailInput = document.getElementById('referral_detail_admin');
                const referralDetailLabel = document.getElementById('referral_detail_label_admin');

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
</x-admin-layout>
