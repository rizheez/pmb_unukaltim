<x-guest-layout>
    <div class="w-full sm:max-w-2xl">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <div class="bg-white rounded-lg px-8 pt-6 pb-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login PMB</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" placeholder="email@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Forgot Password Link -->
                @if (Route::has('password.request'))
                    <div class='pt-3 text-right'>
                        <a class="text-sm text-teal-600 hover:text-teal-800 underline"
                            href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex items-center justify-between mt-6 gap-3">
                    <a href="{{ route('register') }}"
                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-white border-2 border-teal-600 rounded-md font-semibold text-xs text-teal-600 uppercase tracking-widest hover:bg-teal-100 focus:bg-teal-100 active:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Daftar Baru
                    </a>

                    <x-primary-button class="flex-1 justify-center bg-teal-600 hover:bg-teal-700">
                        Masuk
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Help Section & Quick Guide in Grid -->
        <div class="mt-6 mb-3 grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Help Section -->
            <div class="bg-gradient-to-r from-teal-50 to-blue-50 rounded-lg px-6 py-4 border border-teal-100">
                <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Butuh Bantuan?
                </h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-start">
                        <svg class="w-4 h-4 mr-2 mt-0.5 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        <span>WhatsApp: <strong>0811-4200-9990</strong></span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-4 h-4 mr-2 mt-0.5 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <span>Email: <strong>pmb@unukaltim.ac.id</strong></span>
                    </div>
                </div>
            </div>

            <!-- Quick Guide -->
            <div class="bg-gradient-to-r from-teal-50 to-blue-50 rounded-lg px-6 py-4 border border-teal-100">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">📋 Alur Pendaftaran:</h3>
                <ol class="text-xs text-gray-600 space-y-1 list-decimal list-inside">
                    <li>Daftar akun baru (jika belum punya)</li>
                    <li>Login dan lengkapi biodata</li>
                    <li>Upload dokumen yang diperlukan</li>
                    <li>Pilih program studi</li>
                    <li>Tunggu verifikasi dari admin</li>
                </ol>
            </div>
        </div>
    </div>
</x-guest-layout>
