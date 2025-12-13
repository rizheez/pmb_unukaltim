@extends('layouts.student')

@section('content')
    <div class="space-y-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Edit Biodata
                </h2>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            @if (session()->has('message'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('student.biodata.update') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Photo Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Foto Calon Mahasiswa</label>
                    <div class="mt-2 flex items-center space-x-4">
                        <img src="{{ $biodata->photo_url ?? asset('images/default-avatar.png') }}" id="photo-preview"
                            class="h-24 w-24 rounded-full object-cover">

                        <label
                            class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <span>Upload Foto</span>
                            <input type="file" name="photo" id="photo" class="hidden" accept="image/*"
                                onchange="previewImage(event, 'photo-preview')">
                        </label>
                    </div>
                    @error('photo')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <!-- Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $biodata->name ?? auth()->user()->name) }}"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <div class="mt-1">
                            <input type="text" name="nik" id="nik" value="{{ old('nik', $biodata->nik) }}"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('nik')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- NISN -->
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                        <div class="mt-1">
                            <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $biodata->nisn) }}"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('nisn')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <div class="mt-1">
                            <select name="gender" id="gender"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">Pilih...</option>
                                <option value="Laki-laki"
                                    {{ old('gender', $biodata->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="Perempuan"
                                    {{ old('gender', $biodata->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        @error('gender')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Birth Place -->
                    <div>
                        <label for="birth_place" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <div class="mt-1">
                            <input type="text" name="birth_place" id="birth_place"
                                value="{{ old('birth_place', $biodata->birth_place) }}"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('birth_place')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <div class="mt-1">
                            <input type="date" name="birth_date" id="birth_date"
                                value="{{ old('birth_date', $biodata->birth_date) }}"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('birth_date')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Religion -->
                    <div>
                        <label for="religion" class="block text-sm font-medium text-gray-700">Agama</label>
                        <div class="mt-1">
                            <select name="religion" id="religion"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">Pilih...</option>
                                <option value="Islam"
                                    {{ old('religion', $biodata->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen Protestan"
                                    {{ old('religion', $biodata->religion) == 'Kristen Protestan' ? 'selected' : '' }}>
                                    Kristen Protestan</option>
                                <option value="Kristen Katolik"
                                    {{ old('religion', $biodata->religion) == 'Kristen Katolik' ? 'selected' : '' }}>
                                    Kristen Katolik</option>
                                <option value="Hindu"
                                    {{ old('religion', $biodata->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha"
                                    {{ old('religion', $biodata->religion) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu"
                                    {{ old('religion', $biodata->religion) == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                </option>
                            </select>
                        </div>
                        @error('religion')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <div class="mt-1">
                            <textarea id="address" name="address" rows="3"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('address', $biodata->address) }}</textarea>
                        </div>
                        @error('address')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Handphone /
                            WhatsApp</label>
                        <div class="mt-1">
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $biodata->phone ?? auth()->user()->phone) }}"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('phone')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- School Origin -->
                    <div>
                        <label for="school_origin" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                        <div class="mt-1">
                            <input type="text" name="school_origin" id="school_origin"
                                value="{{ old('school_origin', $biodata->school_origin) }}"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('school_origin')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Last Education -->
                    <div>
                        <label for="last_education" class="block text-sm font-medium text-gray-700">Pendidikan
                            Terakhir</label>
                        <div class="mt-1">
                            <select name="last_education" id="last_education"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">Pilih...</option>
                                <option value="SD"
                                    {{ old('last_education', $biodata->last_education) == 'SD' ? 'selected' : '' }}>SD
                                </option>
                                <option value="SMP"
                                    {{ old('last_education', $biodata->last_education) == 'SMP' ? 'selected' : '' }}>SMP
                                </option>
                                <option value="SMA/SMK Sederajat"
                                    {{ old('last_education', $biodata->last_education) == 'SMA/SMK Sederajat' ? 'selected' : '' }}>
                                    SMA/SMK Sederajat</option>
                                <option value="D1"
                                    {{ old('last_education', $biodata->last_education) == 'D1' ? 'selected' : '' }}>D1
                                </option>
                                <option value="D2"
                                    {{ old('last_education', $biodata->last_education) == 'D2' ? 'selected' : '' }}>D2
                                </option>
                                <option value="D3"
                                    {{ old('last_education', $biodata->last_education) == 'D3' ? 'selected' : '' }}>D3
                                </option>
                                <option value="D4"
                                    {{ old('last_education', $biodata->last_education) == 'D4' ? 'selected' : '' }}>D4
                                </option>
                                <option value="S1"
                                    {{ old('last_education', $biodata->last_education) == 'S1' ? 'selected' : '' }}>S1
                                </option>
                                <option value="S2"
                                    {{ old('last_education', $biodata->last_education) == 'S2' ? 'selected' : '' }}>S2
                                </option>
                            </select>
                        </div>
                        @error('last_education')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Major -->
                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700">Jurusan Sekolah</label>
                        <div class="mt-1">
                            <input type="text" name="major" id="major"
                                value="{{ old('major', $biodata->major) }}"
                                class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('major')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Document Upload Section -->
                <div class="border-t pt-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen Pendukung</h3>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-3">
                        <!-- Kartu Keluarga -->
                        <div>
                            <label for="kk" class="block text-sm font-medium text-gray-700">Kartu Keluarga
                                (KK)</label>
                            <div class="mt-1">
                                <label
                                    class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 block text-center">
                                    <span id="kk-filename">Pilih File</span>
                                    <input type="file" name="kk" id="kk" class="hidden"
                                        accept=".pdf,.jpg,.jpeg,.png" onchange="updateFilename(event, 'kk-filename')">
                                </label>
                            </div>

                            @if ($biodata->kk_url)
                                <div class="mt-2">
                                    <a href="{{ $biodata->kk_url }}" target="_blank"
                                        class="text-xs text-teal-600 hover:text-teal-800 inline-flex items-center">
                                        Lihat file saat ini
                                    </a>
                                </div>
                            @endif

                            @error('kk')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max: 2MB)</p>
                        </div>

                        <!-- KTP -->
                        <div>
                            <label for="ktp" class="block text-sm font-medium text-gray-700">KTP</label>
                            <div class="mt-1">
                                <label
                                    class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 block text-center">
                                    <span id="ktp-filename">Pilih File</span>
                                    <input type="file" name="ktp" id="ktp" class="hidden"
                                        accept=".pdf,.jpg,.jpeg,.png" onchange="updateFilename(event, 'ktp-filename')">
                                </label>
                            </div>

                            @if ($biodata->ktp_url)
                                <div class="mt-2">
                                    <a href="{{ $biodata->ktp_url }}" target="_blank"
                                        class="text-xs text-teal-600 hover:text-teal-800 inline-flex items-center">
                                        Lihat file saat ini
                                    </a>
                                </div>
                            @endif

                            @error('ktp')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max: 2MB)</p>
                        </div>

                        <!-- Surat Keterangan Lain -->
                        <div>
                            <label for="certificate" class="block text-sm font-medium text-gray-700">Ijazah/SKL</label>
                            <div class="mt-1">
                                <label
                                    class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 block text-center">
                                    <span id="certificate-filename">Pilih File</span>
                                    <input type="file" name="certificate" id="certificate" class="hidden"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        onchange="updateFilename(event, 'certificate-filename')">
                                </label>
                            </div>

                            @if ($biodata->certificate_url)
                                <div class="mt-2">
                                    <a href="{{ $biodata->certificate_url }}" target="_blank"
                                        class="text-xs text-teal-600 hover:text-teal-800 inline-flex items-center">
                                        Lihat file saat ini
                                    </a>
                                </div>
                            @endif

                            @error('certificate')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max: 2MB)</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Simpan Biodata
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function updateFilename(event, spanId) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById(spanId).textContent = file.name;
            }
        }
    </script>
@endsection
