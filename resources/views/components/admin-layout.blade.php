@props(['title' => 'Admin Dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
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
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('admin.dashboard') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.students.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('admin.students.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Students
                </a>

                <a href="{{ route('admin.periods.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('admin.periods.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Periods
                </a>

                <a href="{{ route('admin.announcements.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('admin.announcements.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                    Announcements
                </a>

                <a href="{{ route('admin.registration-types.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('admin.registration-types.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Registration Types
                </a>

                <a href="{{ route('admin.fakultas.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('admin.fakultas.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    Fakultas
                </a>

                <a href="{{ route('admin.program-studi.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('admin.program-studi.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Program Studi
                </a>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-4 py-3 rounded-lg transition-colors
                        {{ request()->routeIs('admin.users.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        User Management
                    </a>
                @endif

                <a href="{{ route('admin.landing-page.edit') }}"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors
                    {{ request()->routeIs('admin.landing-page.*') ? 'bg-teal-900 text-white' : 'text-teal-100 hover:bg-teal-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    Landing Page
                </a>
            </nav>

            <div class="p-4 border-t border-teal-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-3 rounded-lg text-teal-100 hover:bg-teal-700 transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN WRAPPER -->
        <div class="flex-1 flex flex-col md:pl-64 transition-all duration-300 min-h-screen">

            <!-- Topbar -->
            <header class="bg-white shadow h-16 flex items-center justify-between px-6 sticky top-0 z-40">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <nav class="hidden md:flex text-sm text-gray-500">
                        <span class="hover:text-teal-600 cursor-pointer">Home</span>
                        <span class="mx-2">/</span>
                        <span class="hover:text-teal-600 cursor-pointer">Admin</span>
                        <span class="mx-2">/</span>
                        <span class="font-medium text-gray-900">
                            @if (request()->routeIs('admin.dashboard'))
                                Dashboard
                            @elseif(request()->routeIs('admin.students.*'))
                                Students
                            @elseif(request()->routeIs('admin.periods.*'))
                                Periods
                            @elseif(request()->routeIs('admin.announcements.*'))
                                Announcements
                            @elseif(request()->routeIs('admin.registration-types.*'))
                                Registration Types
                            @elseif(request()->routeIs('admin.fakultas.*'))
                                Fakultas
                            @elseif(request()->routeIs('admin.program-studi.*'))
                                Program Studi
                            @elseif(request()->routeIs('admin.users.*'))
                                User Management
                            @elseif(request()->routeIs('admin.landing-page.*'))
                                Landing Page
                            @endif
                        </span>
                    </nav>
                </div>

                <div class="flex items-center space-x-4">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 focus:outline-none hover:bg-gray-50 rounded-lg px-2 py-1 transition-colors">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=0d9488&color=fff&size=32"
                                alt="Avatar" class="w-8 h-8 rounded-full ring-2 ring-purple-100 object-cover">
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'User' }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" x-cloak x-transition @click.away="open = false"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto bg-gray-200">
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="text-gray-600 py-4 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="text-sm">Copyright © 2025 Universitas Nahdlatul Ulama Kalimantan Timur</p>
                </div>
            </footer>

        </div>

    </div>

</body>

</html>
