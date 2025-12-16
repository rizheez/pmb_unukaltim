<x-guest-layout>
    <div class="mt-4">

        <div class="mb-4 text-md text-gray-600">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan ulang.') }}
        </div>
        
        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-md text-green-600">
            {{ __('Link verifikasi baru telah dikirim ke alamat email yang Anda gunakan saat pendaftaran.') }}
        </div>
        @endif
        
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}" id="resendVerificationForm">
                @csrf
                
                <div>
                    <x-primary-button id="resendBtn" type="submit">
                        <span id="btnText">{{ __('Kirim Ulang Email Verifikasi') }}</span>
                        <span id="btnLoading" class="hidden">{{ __('Mengirim...') }}</span>
                    </x-primary-button>
                </div>
            </form>
            
            <script>
                document.getElementById('resendVerificationForm').addEventListener('submit', function(e) {
                    const btn = document.getElementById('resendBtn');
                    const btnText = document.getElementById('btnText');
                    const btnLoading = document.getElementById('btnLoading');
                    
                    // Disable button
                    btn.disabled = true;
                    btn.classList.add('opacity-50', 'cursor-not-allowed');
                    
                    // Show loading text
                    btnText.classList.add('hidden');
                    btnLoading.classList.remove('hidden');
                });
            </script>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                
                <button type="submit" class="underline text-md text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Keluar') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
