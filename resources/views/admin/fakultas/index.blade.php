<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Fakultas</h2>
        <a href="{{ route('admin.fakultas.create') }}"
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md">
            Tambah Fakultas
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6">
            <x-datatable id="fakultas-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Prodi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($fakultas as $fak)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $fak->code }}</td>
                            <td class="px-6 py-4">{{ $fak->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">{{ $fak->program_studi_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.fakultas.toggle', $fak) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="px-2 py-1 text-xs rounded {{ $fak->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $fak->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('admin.fakultas.edit', $fak) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.fakultas.destroy', $fak) }}" method="POST" class="inline"
                                    onsubmit="return confirmDelete(this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada fakultas</td>
                        </tr>
                    @endforelse
                </tbody>
            </x-datatable>
        </div>
    </div>
</x-admin-layout>
