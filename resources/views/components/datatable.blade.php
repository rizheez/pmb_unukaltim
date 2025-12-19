@props(['id' => 'datatable', 'ajax' => null, 'columns' => [], 'order' => null])

@php
    $tableId = str_replace('-', '_', $id);
@endphp

<div class="overflow-x-auto">
    <table {{ $attributes->merge(['id' => $id, 'class' => 'display w-full']) }}>
        {{ $slot }}
    </table>
</div>

<style>
    /* Fix DataTables dropdown spacing */
    div.dt-container select.dt-input {
        width: 75px !important;
        display: inline-block;
    }

    .dataTables_length select {
        margin-left: 0.5rem !important;
        margin-right: 0.5rem !important;
        padding: 0.375rem 0.75rem !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        appearance: auto !important;
    }

    .dataTables_filter input {
        margin-left: 0.5rem !important;
        padding: 0.375rem 0.75rem !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
    }

    .dataTables_wrapper {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .dataTables_info {
        font-size: 0.875rem;
        color: #374151;
    }

    .dataTables_paginate {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        cursor: pointer;
    }

    .dataTables_paginate .paginate_button:hover {
        background-color: #f9fafb;
    }

    .dataTables_paginate .paginate_button.current {
        background-color: #0d9488;
        color: white;
        border-color: #0d9488;
    }

    .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof DataTable !== 'undefined') {
            const tableElement = document.getElementById('{{ $id }}');
            if (tableElement && !tableElement.classList.contains('dataTable')) {
                @if ($ajax)
                    // Server-side processing
                    window.{{ $tableId }}DataTable = new DataTable('#{{ $id }}', {
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ $ajax }}',
                            data: function(d) {
                                // Add custom filter parameters
                                const statusFilter = document.getElementById('status-filter');
                                if (statusFilter) {
                                    d.status_filter = statusFilter.value;
                                }

                                const periodFilter = document.getElementById('period-filter');
                                if (periodFilter) {
                                    d.period_filter = periodFilter.value;
                                }
                            }
                        },
                        @if (count($columns) > 0)
                            columns: [
                                @foreach ($columns as $column)
                                    {
                                        data: '{{ $column['data'] ?? $column }}',
                                        name: '{{ $column['name'] ?? $column }}',
                                        orderable: {{ isset($column['orderable']) ? ($column['orderable'] ? 'true' : 'false') : 'true' }},
                                        searchable: {{ isset($column['searchable']) ? ($column['searchable'] ? 'true' : 'false') : 'true' }}
                                    },
                                @endforeach
                            ],
                        @endif
                        language: {
                            search: "Cari:",
                            lengthMenu: "Menampilkan _MENU_ data per halaman",
                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                            infoFiltered: "(difilter dari _MAX_ total data)",
                            paginate: {
                                first: "Pertama",
                                last: "Terakhir",
                                next: "Selanjutnya",
                                previous: "Sebelumnya"
                            },
                            processing: "Memproses...",
                            zeroRecords: "Tidak ada data yang ditemukan",
                            emptyTable: "Tidak ada data"
                        },
                        pageLength: 10,
                        lengthMenu: [
                            [5, 10, 25, 50, 100],
                            [5, 10, 25, 50, 100]
                        ],
                        order: @json($order ?? [[0, 'desc']])
                    });
                @else
                    // Client-side processing
                    window.{{ $tableId }}DataTable = new DataTable('#{{ $id }}', {
                        language: {
                            search: "Cari:",
                            lengthMenu: "Menampilkan _MENU_ data per halaman",
                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                            infoFiltered: "(difilter dari _MAX_ total data)",
                            paginate: {
                                first: "Pertama",
                                last: "Terakhir",
                                next: "Selanjutnya",
                                previous: "Sebelumnya"
                            },
                            zeroRecords: "Tidak ada data yang ditemukan",
                            emptyTable: "Tidak ada data",
                            lengthLabels: {
                                '-1': 'Show all'
                            }
                        },
                        pageLength: 10,
                        lengthMenu: [
                            [5, 10, 25, 50, 100],
                            [5, 10, 25, 50, 100]
                        ],
                        order: @json($order ?? [[0, 'desc']])
                    });
                @endif
            }
        }
    });
</script>
