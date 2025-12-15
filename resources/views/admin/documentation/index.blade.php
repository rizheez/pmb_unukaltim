<x-admin-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    📚 Dokumentasi & Panduan Sistem PMB
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Panduan lengkap penggunaan sistem untuk staf admin
                </p>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <a href="#pendaftaran"
                class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition hover:bg-gray-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Pendaftaran</dt>
                                <dd class="text-lg font-medium text-gray-900">Manual</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#periode"
                class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition hover:bg-gray-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Periode</dt>
                                <dd class="text-lg font-medium text-gray-900">Pendaftaran</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#verifikasi"
                class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md hover:bg-gray-200 transition">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Verifikasi</dt>
                                <dd class="text-lg font-medium text-gray-900">Dokumen</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#tips"
                class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md hover:bg-gray-200 transition">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Tips &</dt>
                                <dd class="text-lg font-medium text-gray-900">Trik</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Contact Support -->
        <div class="bg-teal-50 border-l-4 border-teal-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-teal-700">
                        <strong>Butuh Bantuan?</strong> Jika ada pertanyaan yang belum terjawab, hubungi IT Support atau
                        Admin Sistem.
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Documentation -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">

                <!-- 1. PENDAFTARAN MANUAL -->
                <div id="pendaftaran" class="mb-12">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span
                            class="bg-teal-100 text-teal-800 rounded-full w-8 h-8 flex items-center justify-center mr-3">1</span>
                        Pendaftaran Manual Calon Mahasiswa
                    </h3>

                    <div class="prose max-w-none">
                        <p class="text-gray-600 mb-4">Fitur ini digunakan untuk membantu calon mahasiswa yang kesulitan
                            mendaftar secara online.</p>

                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Penting:</strong> Pastikan periode pendaftaran sedang aktif sebelum
                                        mendaftarkan calon mahasiswa.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <h4 class="font-semibold text-gray-900 mt-6 mb-3">Langkah-langkah:</h4>
                        <ol class="list-decimal list-inside space-y-2 text-gray-700">
                            <li>Klik menu <strong>"Daftarkan Manual"</strong> di sidebar</li>
                            <li>Isi semua data yang diperlukan:
                                <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                    <li><strong>Data Akun:</strong> Email dan Nomor Telepon</li>
                                    <li><strong>Data Pribadi:</strong> Nama, NIK, NISN, Jenis Kelamin, dll</li>
                                    <li><strong>Dokumen:</strong> Upload Foto, KTP, KK, dan Ijazah (opsional)</li>
                                    <li><strong>Pendaftaran:</strong> Pilih jenis, jalur, dan program studi</li>
                                    <li><strong>Referral:</strong> Dari mana calon mahasiswa tahu info PMB</li>
                                </ul>
                            </li>
                            <li>Klik tombol <strong>"Daftarkan Mahasiswa"</strong></li>
                            <li>Sistem akan otomatis:
                                <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                    <li>Membuat akun dengan password default: <code
                                            class="bg-gray-100 px-2 py-1 rounded">pmbunukaltim</code></li>
                                    <li>Mengirim email berisi kredensial login ke calon mahasiswa</li>
                                    <li>Status pendaftaran otomatis "Terdaftar"</li>
                                </ul>
                            </li>
                        </ol>

                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        <strong>Catatan:</strong> Pastikan email yang diinput benar karena kredensial
                                        login akan dikirim ke email tersebut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-8">

                <!-- 2. PERIODE PENDAFTARAN -->
                <div id="periode" class="mb-12">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span
                            class="bg-blue-100 text-blue-800 rounded-full w-8 h-8 flex items-center justify-center mr-3">2</span>
                        Mengelola Periode Pendaftaran
                    </h3>

                    <div class="prose max-w-none">
                        <p class="text-gray-600 mb-4">Periode pendaftaran mengatur kapan calon mahasiswa bisa
                            mendaftar.</p>

                        <h4 class="font-semibold text-gray-900 mt-6 mb-3">Status Periode:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="border rounded-lg p-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 mb-2">
                                    Aktif
                                </span>
                                <p class="text-sm text-gray-600">Periode sedang berjalan dan calon mahasiswa bisa
                                    mendaftar</p>
                            </div>
                            <div class="border rounded-lg p-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 mb-2">
                                    Akan Datang
                                </span>
                                <p class="text-sm text-gray-600">Periode belum dimulai, tidak bisa diaktifkan</p>
                            </div>
                            <div class="border rounded-lg p-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800 mb-2">
                                    Berakhir
                                </span>
                                <p class="text-sm text-gray-600">Periode sudah lewat, tidak bisa diaktifkan lagi</p>
                            </div>
                            <div class="border rounded-lg p-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 mb-2">
                                    Nonaktif
                                </span>
                                <p class="text-sm text-gray-600">Periode dalam range tapi dinonaktifkan manual</p>
                            </div>
                        </div>

                        <h4 class="font-semibold text-gray-900 mt-6 mb-3">Aturan Penting:</h4>
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li><strong>Hanya 1 periode yang bisa aktif</strong> dalam satu waktu</li>
                            <li><strong>Periode otomatis nonaktif</strong> jika tanggal sudah lewat</li>
                            <li><strong>Tidak bisa mengaktifkan</strong> periode yang sudah berakhir atau belum dimulai
                            </li>
                            <li><strong>End date berlaku sampai jam 23:59:59</strong> di hari tersebut</li>
                        </ul>

                        <div class="bg-green-50 border-l-4 border-green-400 p-4 mt-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">
                                        <strong>Contoh:</strong> Periode dengan end_date 15 Desember akan tetap aktif
                                        sampai 15 Desember jam 23:59:59, baru nonaktif di tanggal 16 Desember.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-8">

                <!-- 3. VERIFIKASI DOKUMEN -->
                <div id="verifikasi" class="mb-12">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span
                            class="bg-green-100 text-green-800 rounded-full w-8 h-8 flex items-center justify-center mr-3">3</span>
                        Verifikasi Dokumen Calon Mahasiswa
                    </h3>

                    <div class="prose max-w-none">
                        <p class="text-gray-600 mb-4">Proses verifikasi dokumen untuk memastikan kelengkapan dan
                            keabsahan data.</p>

                        <h4 class="font-semibold text-gray-900 mt-6 mb-3">Langkah-langkah:</h4>
                        <ol class="list-decimal list-inside space-y-2 text-gray-700">
                            <li>Buka menu <strong>"Calon Mahasiswa"</strong></li>
                            <li>Klik <strong>"Detail"</strong> pada mahasiswa yang ingin diverifikasi</li>
                            <li>Periksa setiap dokumen:
                                <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                    <li>Foto 3x4</li>
                                    <li>KTP</li>
                                    <li>Kartu Keluarga</li>
                                    <li>Ijazah/SKL</li>
                                    <li>Biodata</li>
                                </ul>
                            </li>
                            <li>Untuk setiap dokumen, pilih:
                                <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                    <li><span class="text-green-600 font-semibold">✓ Setujui</span> - Jika dokumen
                                        valid</li>
                                    <li><span class="text-red-600 font-semibold">✗ Tolak</span> - Jika ada masalah
                                        (wajib isi alasan)</li>
                                </ul>
                            </li>
                            <li>Jika <strong>semua dokumen disetujui</strong>, status otomatis berubah menjadi <span
                                    class="text-green-600 font-semibold">"Terverifikasi"</span></li>
                        </ol>

                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mt-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        <strong>Penting:</strong> Jika menolak dokumen, WAJIB isi alasan penolakan agar
                                        mahasiswa tahu apa yang harus diperbaiki.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-8">

                <!-- 4. TIPS & TRIK -->
                <div id="tips" class="mb-12">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span
                            class="bg-yellow-100 text-yellow-800 rounded-full w-8 h-8 flex items-center justify-center mr-3">4</span>
                        Tips & Trik
                    </h3>

                    <div class="prose max-w-none">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg p-4 border border-teal-200">
                                <h4 class="font-semibold text-teal-900 mb-2">💡 Filter Data</h4>
                                <p class="text-sm text-teal-700">Gunakan filter periode dan status untuk mempermudah
                                    pencarian data mahasiswa.</p>
                            </div>

                            <div
                                class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                                <h4 class="font-semibold text-blue-900 mb-2">📊 Export Data</h4>
                                <p class="text-sm text-blue-700">Klik tombol "Export Excel" untuk download data
                                    mahasiswa dalam format Excel.</p>
                            </div>

                            <div
                                class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                                <h4 class="font-semibold text-purple-900 mb-2">🔍 Search</h4>
                                <p class="text-sm text-purple-700">Gunakan fitur search untuk mencari mahasiswa
                                    berdasarkan nama, email, atau nomor telepon.</p>
                            </div>

                            <div
                                class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                                <h4 class="font-semibold text-green-900 mb-2">⚡ Shortcut</h4>
                                <p class="text-sm text-green-700">Klik langsung pada badge status periode untuk toggle
                                    aktif/nonaktif (jika memungkinkan).</p>
                            </div>
                        </div>

                        <h4 class="font-semibold text-gray-900 mt-8 mb-3">🎯 Best Practices:</h4>
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li>Selalu cek periode aktif sebelum mendaftarkan mahasiswa manual</li>
                            <li>Verifikasi dokumen sesegera mungkin agar mahasiswa tidak menunggu lama</li>
                            <li>Berikan alasan yang jelas saat menolak dokumen</li>
                            <li>Backup data secara berkala dengan export Excel</li>
                            <li>Koordinasi dengan tim untuk memastikan hanya 1 periode yang aktif</li>
                        </ul>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="bg-gray-50 rounded-lg p-6 mt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">❓ FAQ (Frequently Asked Questions)</h3>

                    <div class="space-y-4">
                        <details class="bg-white rounded-lg p-4 shadow-sm">
                            <summary class="font-semibold text-gray-900 cursor-pointer">Bagaimana jika lupa password
                                admin
                                ?</summary>
                            <p class="mt-2 text-gray-600 text-sm">Hubungi IT Support untuk reset password. Hanya IT
                                Support yang bisa mengelola akun admin.</p>
                        </details>

                        <details class="bg-white rounded-lg p-4 shadow-sm">
                            <summary class="font-semibold text-gray-900 cursor-pointer">Apakah bisa mengaktifkan 2
                                periode sekaligus?</summary>
                            <p class="mt-2 text-gray-600 text-sm">Tidak bisa. Sistem hanya mengizinkan 1 periode aktif
                                dalam satu waktu untuk menghindari konflik data.</p>
                        </details>

                        <details class="bg-white rounded-lg p-4 shadow-sm">
                            <summary class="font-semibold text-gray-900 cursor-pointer">Bagaimana cara menghapus data
                                mahasiswa?</summary>
                            <p class="mt-2 text-gray-600 text-sm">Saat ini sistem tidak menyediakan fitur hapus untuk
                                menjaga integritas data. Jika ada masalah, hubungi IT Support.</p>
                        </details>

                        <details class="bg-white rounded-lg p-4 shadow-sm">
                            <summary class="font-semibold text-gray-900 cursor-pointer">Apa yang harus dilakukan jika
                                email tidak terkirim?</summary>
                            <p class="mt-2 text-gray-600 text-sm">Pastikan email yang diinput benar. Jika masih
                                bermasalah, cek spam folder atau hubungi IT support untuk cek konfigurasi email server.
                            </p>
                        </details>
                    </div>
                </div>

            </div>
        </div>


    </div>
</x-admin-layout>
