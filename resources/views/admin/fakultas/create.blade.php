<x-admin-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Fakultas</h2>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.fakultas.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">Kode</label>
                <input type="text" name="code" id="code" value="{{ old('code') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    required maxlength="10">
                @error('code')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    required>
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" checked
                        class="rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.fakultas.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                    Batal
                </a>
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
