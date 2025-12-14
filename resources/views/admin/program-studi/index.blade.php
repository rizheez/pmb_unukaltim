<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Program Studi</h2>
        <a href="{{ route('admin.program-studi.create') }}"
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md">
            Tambah Program Studi
        </a>
    </div>

    <!-- Filter -->
    <div class="bg-white shadow rounded-lg p-4 mb-4">
        <form method="GET" action="{{ route('admin.program-studi.index') }}" class="flex items-end gap-4">
            <div class="flex-1">
                <label for="fakultas_id" class="block text-sm font-medium text-gray-700 mb-1">Filter Fakultas</label>
                <select name="fakultas_id" id="fakultas_id"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    <option value="">Semua Fakultas</option>
                    @foreach ($fakultas as $fak)
                        <option value="{{ $fak->id }}" {{ request('fakultas_id') == $fak->id ? 'selected' : '' }}>
                            {{ $fak->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6">
            <x-datatable id="program-studi-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenjang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fakultas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($programStudi as $ps)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $ps->code }}</td>
                            <td class="px-6 py-4">{{ $ps->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">{{ $ps->jenjang }}</span>
                            </td>
                            <td class="px-6 py-4">{{ $ps->fakultas->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">{{ $ps->quota ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.program-studi.toggle', $ps) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="px-2 py-1 text-xs rounded {{ $ps->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $ps->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('admin.program-studi.edit', $ps) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.program-studi.destroy', $ps) }}" method="POST"
                                    class="inline" onsubmit="return confirmDelete(this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada program studi</td>
                        </tr>
                    @endforelse
                </tbody>
            </x-datatable>
        </div>
    </div>
</x-admin-layout>
