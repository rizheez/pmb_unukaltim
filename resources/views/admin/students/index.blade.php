<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800">
            Calon Mahasiswa
        </h2>
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
                        <option value="no_registration">Belum Daftar</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
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
        });
    </script>
</x-admin-layout>
