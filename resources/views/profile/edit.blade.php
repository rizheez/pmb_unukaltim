@if (auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
    <x-admin-layout>
        <div class="py-3">
            <div class="max-w-7xl space-y-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Profil
                </h2>
                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- <div class="p-4 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div> --}}
            </div>
        </div>
    </x-admin-layout>
@else
    <x-student-layout>
        <div class="py-3">
            <div class="max-w-7xl space-y-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Profil
                </h2>
                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- <div class="p-4 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div> --}}
            </div>
        </div>
    </x-student-layout>
@endif
