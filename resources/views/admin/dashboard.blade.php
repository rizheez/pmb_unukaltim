<x-admin-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800">Total Calon Mahasiswa yang sudah mendaftar</h2>
            <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalStudents }}</p>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800">Total Pengumuman</h2>
            <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalAnnouncements }}</p>
        </div>
    </div>
</x-admin-layout>
