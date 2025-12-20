<x-admin-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Selamat datang di sistem PMB UNU Kaltim</p>
            </div>
            @if ($activePeriod)
                <div class="bg-teal-50 border border-teal-200 rounded-lg px-4 py-2">
                    <p class="text-sm font-medium text-teal-800">{{ $activePeriod->name }}</p>
                    <p class="text-xs text-teal-600">
                        {{ $activePeriod->start_date->format('d M Y') }} -
                        {{ $activePeriod->end_date->format('d M Y') }}
                    </p>
                </div>
            @endif
        </div>

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Pendaftar -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pendaftar</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalStudents }}</p>
                        <p class="text-xs text-gray-500 mt-1">Semua periode</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Hari Ini -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pendaftar Hari Ini</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $todayRegistrations }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ now()->format('d M Y') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Minggu Ini -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Minggu Ini</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $weekRegistrations }}</p>
                        <p class="text-xs text-gray-500 mt-1">7 hari terakhir</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Verifikasi -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Perlu Verifikasi</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingVerifications }}</p>
                        <p class="text-xs text-gray-500 mt-1">Dokumen pending</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Breakdown -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Status Pendaftaran -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Status Pendaftaran</h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Draft</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900">{{ $totalDraft }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Terdaftar</span>
                        </div>
                        <span class="text-lg font-bold text-blue-600">{{ $totalSubmitted }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Terverifikasi</span>
                        </div>
                        <span class="text-lg font-bold text-green-600">{{ $totalVerified }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-teal-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-teal-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Diterima</span>
                        </div>
                        <span class="text-lg font-bold text-teal-600">{{ $totalAccepted }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">Ditolak</span>
                        </div>
                        <span class="text-lg font-bold text-red-600">{{ $totalRejected }}</span>
                    </div>
                </div>
            </div>

            <!-- Top Program Studi -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Program Studi Terpopuler</h2>
                <div class="space-y-3">
                    @forelse($programStats as $stat)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $stat->programStudiChoice1->name ?? 'N/A' }}
                                </p>
                                <div class="mt-2 bg-gray-200 rounded-full h-2">
                                    <div class="bg-teal-500 h-2 rounded-full"
                                        style="width: {{ ($stat->total / $totalStudents) * 100 }}%"></div>
                                </div>
                            </div>
                            <span class="ml-4 text-lg font-bold text-teal-600">{{ $stat->total }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.students.index') }}"
                    class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-lg hover:border-teal-500 hover:bg-teal-50 transition">
                    <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Kelola Mahasiswa</p>
                        <p class="text-xs text-gray-500">Lihat semua pendaftar</p>
                    </div>
                </a>

                <a href="{{ route('admin.students.index') }}?status=pending"
                    class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Verifikasi Dokumen</p>
                        <p class="text-xs text-gray-500">{{ $pendingVerifications }} pending</p>
                    </div>
                </a>

                <a href="{{ route('admin.periods.index') }}"
                    class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Periode Pendaftaran</p>
                        <p class="text-xs text-gray-500">Kelola periode</p>
                    </div>
                </a>

                <a href="{{ route('admin.announcements.index') }}"
                    class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Pengumuman</p>
                        <p class="text-xs text-gray-500">{{ $totalAnnouncements }} pengumuman</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Pendaftar Terbaru</h2>
                <a href="{{ route('admin.students.index') }}"
                    class="text-sm text-teal-600 hover:text-teal-700 font-medium">
                    Lihat Semua →
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Program Studi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentRegistrations as $registration)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $registration->user->studentBiodata->name ?? $registration->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $registration->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $registration->programStudiChoice1->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $registration->status_badge_class }}">
                                        {{ $registration->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $registration->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada pendaftar baru
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
