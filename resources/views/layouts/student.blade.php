<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">

    <!-- Wrapper utama sticky footer -->
    <div class="min-h-screen" x-data='@json(['sidebarOpen' => false])'>

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-600 bg-opacity-75 z-40 md:hidden" style="display: none;">
        </div>

        <!-- Sidebar -->
        <aside
            class="bg-teal-600 text-white w-64 transition-transform duration-300 ease-in-out fixed inset-y-0 left-0 z-50 flex flex-col"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'md:translate-x-0': true }">

            <div class="h-16 flex items-center justify-between px-4 border-b border-teal-700">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo unukaltim" class="w-48">

                <button @click="sidebarOpen = false" class="md:hidden text-white hover:text-teal-200">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 sidebar-scroll">
                <a href="{{ route('student.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('student.dashboard') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                    Dashboard
                </a>

                <a href="{{ route('student.biodata.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('student.biodata.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <i data-lucide="user" class="w-5 h-5 mr-3"></i>
                    Biodata
                </a>

                <a href="{{ route('student.pendaftaran.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('student.pendaftaran.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <i data-lucide="file-text" class="w-5 h-5 mr-3"></i>
                    Pendaftaran
                </a>
            </nav>

            {{-- <div class="p-4 border-t border-teal-700">
                <div class="flex items-center">
                    @php
                        $biodata = Auth::user()->biodata;
                        $sidebarPhotoUrl =
                            $biodata && $biodata->photo_path
                                ? Storage::url($biodata->photo_path)
                                : 'https://ui-avatars.com/api/?name=' .
                                    urlencode(Auth::user()->name ?? 'User') .
                                    '&background=0d9488&color=fff&size=32';
                    @endphp
                    <img src="{{ $sidebarPhotoUrl }}" alt="Avatar"
                        class="w-10 h-10 rounded-full ring-2 ring-teal-500 object-cover">
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Student Name' }}</p>
                        <p class="text-xs text-teal-300">Calon Mahasiswa</p>
                    </div>
                </div>
            </div> --}}
        </aside>

        <!-- MAIN WRAPPER (mendorong footer ke bawah) -->
        <div class="flex-1 flex flex-col md:pl-64 transition-all duration-300 min-h-screen">

            <!-- Topbar -->
            <header class="bg-white shadow h-16 flex items-center justify-between px-6 sticky top-0 z-40">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none mr-4">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>

                    <nav class="hidden md:flex text-sm text-gray-500">
                        <span class="hover:text-teal-600 cursor-pointer">Beranda</span>
                        <span class="mx-2">/</span>
                        <span class="hover:text-teal-600 cursor-pointer">Calon Mahasiswa</span>
                        <span class="mx-2">/</span>
                        <span class="font-medium text-gray-900">
                            @if (request()->routeIs('student.dashboard'))
                                Dashboard
                            @elseif(request()->routeIs('student.biodata.*'))
                                Biodata
                            @elseif(request()->routeIs('student.pendaftaran.*'))
                                Pendaftaran
                            @endif
                        </span>
                    </nav>
                </div>

                <div class="flex items-center space-x-4">
                    {{-- <button class="relative text-gray-400 hover:text-gray-600">
                        <i data-lucide="bell" class="w-6 h-6"></i>
                        <span
                            class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-400"></span>
                    </button>

                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                        Student
                    </span> --}}

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 focus:outline-none hover:bg-gray-50 rounded-lg px-2 py-1 transition-colors">
                            @php
                                $biodata = Auth::user()->biodata;
                                $photoUrl =
                                    $biodata && $biodata->photo_path
                                        ? Storage::url($biodata->photo_path)
                                        : 'https://ui-avatars.com/api/?name=' .
                                            urlencode(Auth::user()->name ?? 'User') .
                                            '&background=0d9488&color=fff&size=32';
                            @endphp
                            <img src="{{ $photoUrl }}" alt="Avatar"
                                class="w-8 h-8 rounded-full ring-2 ring-teal-100 object-cover">
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'User' }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                        </button>

                        <div x-show="open" x-cloak x-transition @click.away="open = false"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-60 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto bg-gray-200">
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}</div>
                @endif

                @if (session('message'))
                    <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
                        {{ session('message') }}</div>
                @endif

                @yield('content')

                <!-- FOOTER (sticky di bawah) -->

            </main>

            <footer class="text-gray-600 py-4 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="text-sm">Copyright © 2025 Universitas Nahdlatul Ulama Kalimantan Timur</p>
                </div>
            </footer>

        </div>



    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined' && lucide.createIcons) {
                lucide.createIcons();
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
