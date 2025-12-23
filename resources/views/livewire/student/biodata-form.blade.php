<div class="bg-white shadow rounded-lg p-6">
    @if (session()->has('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Photo Section -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Foto Calon Mahasiswa</label>
            <div class="mt-2 flex items-center space-x-4">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="h-24 w-24 rounded-full object-cover">
                @else
                    <img src="{{ $existingPhoto }}" class="h-24 w-24 rounded-full object-cover">
                @endif

                <label
                    class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    <span>Upload Foto</span>
                    <input type="file" wire:model="photo" class="hidden">
                </label>
            </div>
            @error('photo')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            <p class="text-xs text-gray-500 mt-1">Foto ukuran 4x6 (Max: 1MB)</p>
        </div>

        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
            <!-- Name -->
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <div class="mt-1">
                    <input type="text" wire:model="name" id="name"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Nama sesuai KTP/Ijazah</p>
            </div>

            <!-- NIK -->
            <div>
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <div class="mt-1">
                    <input type="text" wire:model="nik" id="nik"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('nik')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">16 digit angka</p>
            </div>

            <!-- NISN -->
            <div>
                <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                <div class="mt-1">
                    <input type="text" wire:model="nisn" id="nisn"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('nisn')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">10 digit angka</p>
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <div class="mt-1">
                    <select wire:model="gender" id="gender"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="">Pilih...</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                @error('gender')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Birth Date -->
            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <div class="mt-1">
                    <input type="date" wire:model="birth_date" id="birth_date"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('birth_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">
                    Nomor Handphone / WhatsApp <span class="text-red-500">*</span>
                </label>
                <div class="mt-1">
                    <input type="text" wire:model="phone" id="phone"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('phone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
                <div class="mt-2 p-3 bg-amber-50 border border-amber-200 rounded-md">
                    <p class="text-xs text-amber-800 font-semibold flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                        Gunakan Nomor WhatsApp Aktif!
                    </p>
                </div>
                <p class="text-xs text-gray-500 mt-1">Contoh: 08123456789 (tanpa tanda - atau +62)</p>
            </div>

            <!-- School Origin -->
            <div>
                <label for="school_origin" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                <div class="mt-1">
                    <input type="text" wire:model="school_origin" id="school_origin"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('school_origin')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Education -->
            <div>
                <label for="last_education" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                <div class="mt-1">
                    <select wire:model="last_education" id="last_education"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="">Pilih...</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK Sederajat">SMA/SMK Sederajat</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                    </select>
                </div>
                @error('last_education')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Major -->
            <div>
                <label for="major" class="block text-sm font-medium text-gray-700">Jurusan Sekolah <span
                        class="text-gray-400 font-normal">(Opsional)</span></label>
                <div class="mt-1">
                    <input type="text" wire:model="major" id="major"
                        placeholder="Contoh: IPA, IPS, TKJ, Akuntansi"
                        class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('major')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ada jurusan</p>
            </div>
        </div>

        <!-- Document Upload Section -->
        <div class="border-t pt-6 mt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen Pendukung</h3>
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-3">
                <!-- Kartu Keluarga -->
                <div>
                    <label for="kk" class="block text-sm font-medium text-gray-700">Kartu Keluarga (KK)</label>
                    <div class="mt-1">
                        <label
                            class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 block text-center">
                            <span>{{ $kk ? $kk->getClientOriginalName() : 'Pilih File' }}</span>
                            <input type="file" wire:model="kk" id="kk" class="hidden"
                                accept=".pdf,.jpg,.jpeg,.png">
                        </label>
                    </div>

                    <!-- Preview -->
                    @if ($kk)
                        <div class="mt-2 p-2 border border-gray-200 rounded">
                            @if (in_array($kk->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']))
                                <img src="{{ $kk->temporaryUrl() }}" class="w-full h-32 object-cover rounded">
                            @else
                                <div class="flex items-center justify-center h-32 bg-gray-100 rounded">
                                    <div class="text-center">
                                        <i data-lucide="file-text" class="w-8 h-8 mx-auto text-gray-400"></i>
                                        <p class="text-xs text-gray-500 mt-1">{{ $kk->getClientOriginalName() }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @elseif($existingKk)
                        <div class="mt-2">
                            <a href="{{ $existingKk }}" target="_blank"
                                class="text-xs text-teal-600 hover:text-teal-800 inline-flex items-center">
                                <i data-lucide="external-link" class="w-3 h-3 mr-1"></i>
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
                            <span>{{ $ktp ? $ktp->getClientOriginalName() : 'Pilih File' }}</span>
                            <input type="file" wire:model="ktp" id="ktp" class="hidden"
                                accept=".pdf,.jpg,.jpeg,.png">
                        </label>
                    </div>

                    <!-- Preview -->
                    @if ($ktp)
                        <div class="mt-2 p-2 border border-gray-200 rounded">
                            @if (in_array($ktp->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']))
                                <img src="{{ $ktp->temporaryUrl() }}" class="w-full h-32 object-cover rounded">
                            @else
                                <div class="flex items-center justify-center h-32 bg-gray-100 rounded">
                                    <div class="text-center">
                                        <i data-lucide="file-text" class="w-8 h-8 mx-auto text-gray-400"></i>
                                        <p class="text-xs text-gray-500 mt-1">{{ $ktp->getClientOriginalName() }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @elseif($existingKtp)
                        <div class="mt-2">
                            <a href="{{ $existingKtp }}" target="_blank"
                                class="text-xs text-teal-600 hover:text-teal-800 inline-flex items-center">
                                <i data-lucide="external-link" class="w-3 h-3 mr-1"></i>
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
                            <span>{{ $certificate ? $certificate->getClientOriginalName() : 'Pilih File' }}</span>
                            <input type="file" wire:model="certificate" id="certificate" class="hidden"
                                accept=".pdf,.jpg,.jpeg,.png">
                        </label>
                    </div>

                    <!-- Preview -->
                    @if ($certificate)
                        <div class="mt-2 p-2 border border-gray-200 rounded">
                            @if (in_array($certificate->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']))
                                <img src="{{ $certificate->temporaryUrl() }}"
                                    class="w-full h-32 object-cover rounded">
                            @else
                                <div class="flex items-center justify-center h-32 bg-gray-100 rounded">
                                    <div class="text-center">
                                        <i data-lucide="file-text" class="w-8 h-8 mx-auto text-gray-400"></i>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $certificate->getClientOriginalName() }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @elseif($existingCertificate)
                        <div class="mt-2">
                            <a href="{{ $existingCertificate }}" target="_blank"
                                class="text-xs text-teal-600 hover:text-teal-800 inline-flex items-center">
                                <i data-lucide="external-link" class="w-3 h-3 mr-1"></i>
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
