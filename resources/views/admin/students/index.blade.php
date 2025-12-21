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

            <x-datatable id="students-table" ajax="{{ route('admin.students.datatable') }}" :order="[6, 'desc']"
                :columns="[
                    ['data' => 'name', 'name' => 'name'],
                    ['data' => 'email', 'name' => 'email'],
                    ['data' => 'phone', 'name' => 'phone'],
                    ['data' => 'status', 'name' => 'status', 'orderable' => false],
                    ['data' => 'period_name', 'name' => 'period_name', 'orderable' => false],
                    ['data' => 'referral_source', 'name' => 'referral_source', 'orderable' => false],
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
                            Sumber Info
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

    <!-- Modal Backdrop -->
    <div id="modal-backdrop" class="hidden bg-gray-900/50 fixed inset-0 z-40"></div>

    <!-- Accept Modal (Flowbite) -->
    <div id="accept-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Terima Mahasiswa
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="accept-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-600">
                        Apakah Anda yakin ingin menerima <strong id="accept-student-name"></strong>?
                    </p>

                    <!-- Program Studi Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Diterima di Program Studi <span class="text-red-500">*</span>
                        </label>
                        <div id="prodi-choices" class="space-y-2">
                            <!-- Choices will be populated by JavaScript -->
                        </div>
                        <p id="prodi-error" class="hidden mt-1 text-xs text-red-500">
                            * Pilih program studi yang diterima
                        </p>
                    </div>

                    <div>
                        <label for="accept-notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan
                            (opsional)</label>
                        <textarea id="accept-notes" rows="2" placeholder="Catatan tambahan..."
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button data-modal-hide="accept-modal" type="button"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        Batal
                    </button>
                    <button id="accept-submit-btn" type="button"
                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:opacity-50 disabled:cursor-not-allowed">
                        Terima
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal (Flowbite) -->
    <div id="reject-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Tolak Mahasiswa
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="reject-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-600">
                        Apakah Anda yakin ingin menolak <strong id="reject-student-name"></strong>?
                    </p>

                    <div>
                        <label for="reject-reason" class="block text-sm font-medium text-gray-700 mb-1">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="reject-reason" rows="3" placeholder="Masukkan alasan penolakan..." required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"></textarea>
                        <p class="mt-1 text-xs text-gray-500">* Alasan penolakan wajib diisi</p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button data-modal-hide="reject-modal" type="button"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        Batal
                    </button>
                    <button id="reject-submit-btn" type="button"
                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:opacity-50 disabled:cursor-not-allowed">
                        Tolak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal state
        let currentStudentId = null;
        let selectedProdiId = null;
        let acceptModal = null;
        let rejectModal = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flowbite modals with backdrop options
            const acceptModalEl = document.getElementById('accept-modal');
            const rejectModalEl = document.getElementById('reject-modal');

            const modalOptions = {
                placement: 'center',
                backdrop: 'static',
                backdropClasses: 'bg-gray-900/50 fixed inset-0 z-40',
                closable: true,
            };

            if (typeof Modal !== 'undefined') {
                acceptModal = new Modal(acceptModalEl, modalOptions);
                rejectModal = new Modal(rejectModalEl, modalOptions);
            }

            // Add event listeners for all close buttons to hide backdrop
            document.querySelectorAll('[data-modal-hide]').forEach(btn => {
                btn.addEventListener('click', function() {
                    hideBackdrop();
                });
            });

            // Accept submit handler
            document.getElementById('accept-submit-btn').addEventListener('click', function() {
                const prodiError = document.getElementById('prodi-error');

                if (!selectedProdiId) {
                    prodiError.classList.remove('hidden');
                    return;
                }
                prodiError.classList.add('hidden');

                const notes = document.getElementById('accept-notes').value;
                const btn = this;
                btn.disabled = true;
                btn.innerHTML = 'Loading...';

                fetch(`/admin/students/${currentStudentId}/accept`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            notes: notes,
                            program_studi_id: selectedProdiId
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            if (window.students_tableDataTable) {
                                window.students_tableDataTable.ajax.reload();
                            }
                            if (acceptModal) acceptModal.hide();
                            else acceptModalEl.classList.add('hidden');
                            hideBackdrop();
                            Swal.fire('Berhasil!', data.message, 'success');
                        } else {
                            Swal.fire('Error!', data.error || 'Terjadi kesalahan', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire('Error!', 'Terjadi kesalahan saat memproses permintaan', 'error');
                    })
                    .finally(() => {
                        btn.disabled = false;
                        btn.innerHTML = 'Terima';
                    });
            });

            // Reject submit handler
            document.getElementById('reject-submit-btn').addEventListener('click', function() {
                const reason = document.getElementById('reject-reason').value;

                if (!reason.trim()) {
                    Swal.fire('Perhatian!', 'Alasan penolakan wajib diisi', 'warning');
                    return;
                }

                const btn = this;
                btn.disabled = true;
                btn.innerHTML = 'Loading...';

                fetch(`/admin/students/${currentStudentId}/reject`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            reason: reason
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            if (window.students_tableDataTable) {
                                window.students_tableDataTable.ajax.reload();
                            }
                            if (rejectModal) rejectModal.hide();
                            else rejectModalEl.classList.add('hidden');
                            hideBackdrop();
                            Swal.fire('Berhasil!', data.message, 'success');
                        } else {
                            Swal.fire('Error!', data.error || 'Terjadi kesalahan', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire('Error!', 'Terjadi kesalahan saat memproses permintaan', 'error');
                    })
                    .finally(() => {
                        btn.disabled = false;
                        btn.innerHTML = 'Tolak';
                    });
            });
        });

        function openAcceptModal(id, name, choice1Id, choice1Name, choice2Id, choice2Name) {
            currentStudentId = id;
            selectedProdiId = choice1Id; // Default to choice 1
            document.getElementById('accept-student-name').textContent = name;
            document.getElementById('accept-notes').value = '';
            document.getElementById('prodi-error').classList.add('hidden');

            // Build prodi choices
            const choicesContainer = document.getElementById('prodi-choices');
            choicesContainer.innerHTML = '';

            if (choice1Id) {
                choicesContainer.innerHTML += `
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-green-50 transition ${selectedProdiId == choice1Id ? 'border-green-500 bg-green-50' : 'border-gray-200'}" onclick="selectProdi(${choice1Id}, this)">
                        <input type="radio" name="prodi" value="${choice1Id}" ${selectedProdiId == choice1Id ? 'checked' : ''}
                            class="h-4 w-4 text-green-600 focus:ring-green-500">
                        <span class="ml-3">
                            <span class="block text-sm font-medium text-gray-900">${choice1Name}</span>
                            <span class="block text-xs text-gray-500">Pilihan 1</span>
                        </span>
                    </label>
                `;
            }

            if (choice2Id && choice2Id != 0) {
                choicesContainer.innerHTML += `
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-green-50 transition border-gray-200" onclick="selectProdi(${choice2Id}, this)">
                        <input type="radio" name="prodi" value="${choice2Id}"
                            class="h-4 w-4 text-green-600 focus:ring-green-500">
                        <span class="ml-3">
                            <span class="block text-sm font-medium text-gray-900">${choice2Name}</span>
                            <span class="block text-xs text-gray-500">Pilihan 2</span>
                        </span>
                    </label>
                `;
            }

            // Show modal with backdrop
            const modalEl = document.getElementById('accept-modal');
            const backdrop = document.getElementById('modal-backdrop');
            backdrop.classList.remove('hidden');
            if (acceptModal) {
                acceptModal.show();
            } else {
                modalEl.classList.remove('hidden');
                modalEl.classList.add('flex');
            }
        }

        function selectProdi(id, element) {
            selectedProdiId = id;
            document.getElementById('prodi-error').classList.add('hidden');

            // Update styling
            document.querySelectorAll('#prodi-choices label').forEach(label => {
                label.classList.remove('border-green-500', 'bg-green-50');
                label.classList.add('border-gray-200');
            });
            element.classList.remove('border-gray-200');
            element.classList.add('border-green-500', 'bg-green-50');
        }

        function openRejectModal(id, name) {
            currentStudentId = id;
            document.getElementById('reject-student-name').textContent = name;
            document.getElementById('reject-reason').value = '';

            // Show modal with backdrop
            const modalEl = document.getElementById('reject-modal');
            const backdrop = document.getElementById('modal-backdrop');
            backdrop.classList.remove('hidden');
            if (rejectModal) {
                rejectModal.show();
            } else {
                modalEl.classList.remove('hidden');
                modalEl.classList.add('flex');
            }
        }

        // Helper function to hide backdrop
        function hideBackdrop() {
            document.getElementById('modal-backdrop').classList.add('hidden');
        }
    </script>
</x-admin-layout>
