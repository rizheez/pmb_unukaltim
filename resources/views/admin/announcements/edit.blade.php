<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.announcements.index') }}" class="text-blue-500 hover:text-blue-700">&larr; Kembali ke
            Daftar</a>
        <h2 class="text-2xl font-bold text-gray-800 mt-2">Edit Pengumuman</h2>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form method="POST" action="{{ route('admin.announcements.update', $announcement->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" value="{{ $announcement->title }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                <textarea name="content" id="content" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>{{ $announcement->content }}</textarea>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        {{ $announcement->is_published ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-700">Dipublikasikan</span>
                </label>
            </div>

            <div class="flex justify-end gap-2">
                <button type="submit"
                    class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700">Perbarui</button>
            </div>
        </form>
    </div>
</x-admin-layout>
