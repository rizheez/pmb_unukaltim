<x-guest-layout>
    <div class="mt-6 mb-4 text-md text-gray-600">
        {{ __('Lupa password Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan link reset password untuk membuat yang baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button id="resetBtn" type="submit">
                <span id="resetBtnText">{{ __('Kirim Link Reset Password') }}</span>
                <span id="resetBtnLoading" class="hidden">{{ __('Mengirim...') }}</span>
            </x-primary-button>
        </div>
    </form>
    
    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('resetBtn');
            const btnText = document.getElementById('resetBtnText');
            const btnLoading = document.getElementById('resetBtnLoading');
            
            // Disable button
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            
            // Show loading text
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
        });
    </script>
</x-guest-layout>
