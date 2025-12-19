<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Pengaturan Landing Page</h2>
        <a href="{{ route('landing-page') }}" target="_blank"
            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md flex items-center gap-2">
            <i data-lucide="external-link" class="w-4 h-4"></i>
            Preview Landing Page
        </a>
    </div>

    <form action="{{ route('admin.landing-page.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Hero Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3">Hero Section</h3>

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="hero_title"
                        value="{{ old('hero_title', $settings['hero']->where('key', 'hero_title')->first()->value ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                        required>
                    @error('hero_title')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                    <input type="text" name="hero_subtitle"
                        value="{{ old('hero_subtitle', $settings['hero']->where('key', 'hero_subtitle')->first()->value ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                        required>
                    @error('hero_subtitle')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="hero_description" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>{{ old('hero_description', $settings['hero']->where('key', 'hero_description')->first()->value ?? '') }}</textarea>
                    @error('hero_description')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                        <input type="text" name="hero_button_text"
                            value="{{ old('hero_button_text', $settings['hero']->where('key', 'hero_button_text')->first()->value ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Button URL</label>
                        <input type="text" name="hero_button_url"
                            value="{{ old('hero_button_url', $settings['hero']->where('key', 'hero_button_url')->first()->value ?? '') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                            required>
                    </div>
                </div>

                <!-- Background Image Desktop -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i data-lucide="monitor" class="w-4 h-4 inline mr-1"></i>
                        Background Image (Desktop)
                    </label>
                    @if ($settings['hero']->where('key', 'hero_background_image_desktop')->first()?->value)
                        <div class="mb-2">
                            <img src="{{ Storage::url($settings['hero']->where('key', 'hero_background_image_desktop')->first()->value) }}"
                                alt="Current Desktop Background" class="h-32 rounded border-2 border-gray-200">
                            <p class="text-xs text-gray-500 mt-1">Current desktop background</p>
                        </div>
                    @endif
                    <input type="file" name="hero_background_image_desktop" accept="image/*"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB. Recommended: 1920x1080px or larger. Leave empty to
                        keep current image.</p>
                </div>

                <!-- Background Image Mobile -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i data-lucide="smartphone" class="w-4 h-4 inline mr-1"></i>
                        Background Image (Mobile)
                    </label>
                    @if ($settings['hero']->where('key', 'hero_background_image_mobile')->first()?->value)
                        <div class="mb-2">
                            <img src="{{ Storage::url($settings['hero']->where('key', 'hero_background_image_mobile')->first()->value) }}"
                                alt="Current Mobile Background" class="h-32 rounded border-2 border-gray-200">
                            <p class="text-xs text-gray-500 mt-1">Current mobile background</p>
                        </div>
                    @endif
                    <input type="file" name="hero_background_image_mobile" accept="image/*"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB. Recommended: 768x1024px (portrait). Leave empty to
                        keep current image.</p>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3">Features Section</h3>

            @foreach (['feature_1', 'feature_2', 'feature_3'] as $index => $feature)
                <div class="mb-8 last:mb-0 pb-8 last:pb-0 border-b last:border-0">
                    <h4 class="font-semibold text-gray-700 mb-4">Feature {{ $index + 1 }}</h4>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" name="{{ $feature }}_title"
                                value="{{ old($feature . '_title', $settings['features']->where('key', $feature . '_title')->first()->value ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="{{ $feature }}_description" rows="2"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>{{ old($feature . '_description', $settings['features']->where('key', $feature . '_description')->first()->value ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Icon (Lucide icon name)</label>
                            <input type="text" name="{{ $feature }}_icon"
                                value="{{ old($feature . '_icon', $settings['features']->where('key', $feature . '_icon')->first()->value ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="e.g., clipboard-check, graduation-cap" required>
                            <p class="text-xs text-gray-500 mt-1">See <a href="https://lucide.dev/icons/"
                                    target="_blank" class="text-teal-600">lucide.dev</a> for icon names</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- About Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3">About Section</h3>

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="about_title"
                        value="{{ old('about_title', $settings['about']->where('key', 'about_title')->first()->value ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="about_description" rows="5"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" required>{{ old('about_description', $settings['about']->where('key', 'about_description')->first()->value ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">About Image</label>
                    @if ($settings['about']->where('key', 'about_image')->first()?->value)
                        <div class="mb-2">
                            <img src="{{ Storage::url($settings['about']->where('key', 'about_image')->first()->value) }}"
                                alt="Current About Image" class="h-48 rounded-lg object-cover">
                        </div>
                    @endif
                    <input type="file" name="about_image" accept="image/*"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB. Leave empty to keep current image. Jika tidak ada
                        gambar, akan tampil gradient teal-cyan.</p>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3">Contact Section</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" name="contact_address"
                        value="{{ old('contact_address', $settings['contact']->where('key', 'contact_address')->first()->value ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="contact_email"
                        value="{{ old('contact_email', $settings['contact']->where('key', 'contact_email')->first()->value ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                        required>
                </div>

            </div>

            <!-- Contact Numbers Section -->
            <div class="md:col-span-2">
                <h4 class="text-md font-semibold text-gray-800 mb-4 border-b pb-2">Nomor Kontak (Phone/WhatsApp)</h4>
                <p class="text-sm text-gray-600 mb-4">Masukkan nomor telepon atau WhatsApp beserta keterangan (misal:
                    Admin UNU Kaltim, Bapak Rudi, dll)</p>

                <div class="space-y-4">
                    <!-- Contact 1 -->
                    <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor 1 *</label>
                            <input type="text" name="contact_phone_1"
                                value="{{ old('contact_phone_1', $settings['contact']->where('key', 'contact_phone_1')->first()->value ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="0541-xxx atau 0812-xxx" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan 1 *</label>
                            <input type="text" name="contact_phone_1_label"
                                value="{{ old('contact_phone_1_label', $settings['contact']->where('key', 'contact_phone_1_label')->first()->value ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="Admin UNU Kaltim" required>
                        </div>
                    </div>

                    <!-- Contact 2 -->
                    <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor 2</label>
                            <input type="text" name="contact_phone_2"
                                value="{{ old('contact_phone_2', $settings['contact']->where('key', 'contact_phone_2')->first()->value ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="0541-xxx atau 0812-xxx">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan 2</label>
                            <input type="text" name="contact_phone_2_label"
                                value="{{ old('contact_phone_2_label', $settings['contact']->where('key', 'contact_phone_2_label')->first()->value ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="Bapak Rudi">
                        </div>
                    </div>

                    <!-- Contact 3 -->
                    <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor 3</label>
                            <input type="text" name="contact_phone_3"
                                value="{{ old('contact_phone_3', $settings['contact']->where('key', 'contact_phone_3')->first()->value ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="0541-xxx atau 0812-xxx">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan 3</label>
                            <input type="text" name="contact_phone_3_label"
                                value="{{ old('contact_phone_3_label', $settings['contact']->where('key', 'contact_phone_3_label')->first()->value ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                placeholder="Ibu Siti">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">University Logo</label>
                @if ($settings['contact']->where('key', 'university_logo')->first()?->value)
                    <div class="mb-2">
                        <img src="{{ Storage::url($settings['contact']->where('key', 'university_logo')->first()->value) }}"
                            alt="Current Logo" class="h-20 rounded">
                    </div>
                @endif
                <input type="file" name="university_logo" accept="image/*"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                <p class="text-xs text-gray-500 mt-1">Max 2MB. Leave empty to keep current logo.</p>
            </div>
        </div>
        <!-- Social Media Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-3">Social Media</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                    <input type="url" name="social_media_facebook"
                        value="{{ old('social_media_facebook', $settings['social_media']->where('key', 'social_media_facebook')->first()->value ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                        placeholder="https://facebook.com/username">
                    <p class="text-xs text-gray-500 mt-1">URL lengkap halaman Facebook universitas</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                    <input type="url" name="social_media_instagram"
                        value="{{ old('social_media_instagram', $settings['social_media']->where('key', 'social_media_instagram')->first()->value ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                        placeholder="https://instagram.com/username">
                    <p class="text-xs text-gray-500 mt-1">URL lengkap halaman Instagram universitas</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                    <input type="url" name="social_media_website"
                        value="{{ old('social_media_website', $settings['social_media']->where('key', 'social_media_website')->first()->value ?? '') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                        placeholder="https://unukaltim.ac.id">
                    <p class="text-xs text-gray-500 mt-1">URL website resmi universitas (akan ditampilkan dengan logo
                        UNU)</p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.dashboard') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-md">
                Cancel
            </a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-md">
                Save Changes
            </button>
        </div>
        </div>




    </form>

</x-admin-layout>
