<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800">
            Calon Mahasiswa
        </h2>
        <a href="#" id="export-btn"
            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            Export Excel
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <!-- Filter Section -->
            <div class="flex flex-wrap gap-4 mb-4">
                <!-- Filter Period -->
                <div class="flex items-center gap-2">
                    <label for="period-filter" class="text-sm font-medium text-gray-700">Periode:</label>
                    <select id="period-filter"
                        class="rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm w-48">
                        <option value="all">Semua Periode</option>
                        @foreach ($periods as $period)
                            <option value="{{ $period->id }}">{{ $period->name }}
                                {{ $period->is_active ? '(Aktif)' : '' }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Status -->
                <div class="flex items-center gap-2">
                    <label for="status-filter" class="text-sm font-medium text-gray-700">Status:</label>
                    <select id="status-filter"
                        class="rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm w-40">
                        <option value="all">Semua Status</option>
                        <option value="submitted">Terdaftar</option>
                        <option value="verified">Verified</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <x-datatable id="students-table" ajax="{{ route('admin.students.datatable') }}" :columns="[
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone', 'name' => 'phone'],
                ['data' => 'status', 'name' => 'status', 'orderable' => false],
                ['data' => 'period_name', 'name' => 'period_name', 'orderable' => false],
                ['data' => 'registered_at', 'name' => 'registered_at'],
                ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
            ]">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Telepon
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Gelombang
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Terdaftar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data will be loaded via AJAX -->
                </tbody>
            </x-datatable>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('status-filter');

            if (statusFilter) {
                statusFilter.addEventListener('change', function() {
                    // students-table becomes students_table in JavaScript
                    if (window.students_tableDataTable) {
                        window.students_tableDataTable.ajax.reload();
                    }
                });
            }

            const periodFilter = document.getElementById('period-filter');
            if (periodFilter) {
                periodFilter.addEventListener('change', function() {
                    if (window.students_tableDataTable) {
                        window.students_tableDataTable.ajax.reload();
                    }
                });
            }

            // Export button handler
            const exportBtn = document.getElementById('export-btn');
            if (exportBtn) {
                exportBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const periodValue = periodFilter ? periodFilter.value : 'all';
                    const statusValue = statusFilter ? statusFilter.value : 'all';

                    const url = new URL('{{ route('admin.students.export') }}');
                    url.searchParams.append('period_filter', periodValue);
                    url.searchParams.append('status_filter', statusValue);

                    window.location.href = url.toString();
                });
            }
        });
    </script>
</x-admin-layout>
