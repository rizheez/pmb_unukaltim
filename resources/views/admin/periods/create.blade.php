<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.periods.index') }}" class="text-blue-500 hover:text-blue-700">&larr; Kembali ke
            Daftar</a>
        <h2 class="text-2xl font-bold text-gray-800 mt-2">Buat Periode Pendaftaran</h2>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form method="POST" action="{{ route('admin.periods.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Periode</label>
                    <input type="text" name="name" id="name" placeholder="cth: Gelombang 1 2024"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="wave_number" class="block text-sm font-medium text-gray-700">Nomor Gelombang</label>
                    <input type="number" name="wave_number" id="wave_number" min="1" placeholder="1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="academic_year" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                    <input type="text" name="academic_year" id="academic_year" placeholder="2024/2025"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="quota" class="block text-sm font-medium text-gray-700">Kuota (Opsional)</label>
                    <input type="number" name="quota" id="quota" min="1" placeholder="100"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                </div>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Tetapkan sebagai Periode Aktif</span>
                </label>
                <p class="text-xs text-gray-500 mt-1">Hanya satu periode yang bisa aktif dalam satu waktu. Mengaktifkan
                    ini akan menonaktifkan periode lainnya.</p>
            </div>

            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700">Buat
                    Periode</button>
            </div>
        </form>
    </div>
</x-admin-layout>
