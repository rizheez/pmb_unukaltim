<x-admin-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Program Studi</h2>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.program-studi.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="fakultas_id" class="block text-sm font-medium text-gray-700">Fakultas</label>
                <select name="fakultas_id" id="fakultas_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    required>
                    <option value="">Pilih Fakultas</option>
                    @foreach ($fakultas as $fak)
                        <option value="{{ $fak->id }}" {{ old('fakultas_id') == $fak->id ? 'selected' : '' }}>
                            {{ $fak->name }}
                        </option>
                    @endforeach
                </select>
                @error('fakultas_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

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
                <label for="jenjang" class="block text-sm font-medium text-gray-700">Jenjang</label>
                <select name="jenjang" id="jenjang"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                    required>
                    <option value="">Pilih Jenjang</option>
                    <option value="D3" {{ old('jenjang') == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="D4" {{ old('jenjang') == 'D4' ? 'selected' : '' }}>D4</option>
                    <option value="S1" {{ old('jenjang') == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ old('jenjang') == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ old('jenjang') == 'S3' ? 'selected' : '' }}>S3</option>
                </select>
                @error('jenjang')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="quota" class="block text-sm font-medium text-gray-700">Kuota</label>
                <input type="number" name="quota" id="quota" value="{{ old('quota') }}" min="0"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                @error('quota')
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
                <a href="{{ route('admin.program-studi.index') }}"
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
