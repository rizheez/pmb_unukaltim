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

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-md transition-all duration-300 ease-in-out">
            <div class="p-4 border-b flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-800">PMB Admin</h1>
                <button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.students.index') }}"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.students.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Students
                </a>
                <a href="{{ route('admin.periods.index') }}"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.periods.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Periods
                </a>
                <a href="{{ route('admin.announcements.index') }}"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.announcements.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Announcements
                </a>
                <a href="{{ route('admin.registration-types.index') }}"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.registration-types.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Registration Types
                </a>
                <a href="{{ route('admin.fakultas.index') }}"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.fakultas.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Fakultas
                </a>
                <a href="{{ route('admin.program-studi.index') }}"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.program-studi.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Program Studi
                </a>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}"
                        class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 font-semibold' : '' }}">
                        User Management
                    </a>
                @endif

                <a href="{{ route('admin.landing-page.edit') }}"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('admin.landing-page.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Landing Page
                </a>
            </nav>
            <div class="p-4 border-t mt-auto absolute bottom-0 w-64">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 relative flex flex-col">
            <!-- Mobile Toggle Button -->
            <button id="mobileToggle"
                class="md:hidden fixed top-4 left-4 z-50 bg-teal-600 text-white p-3 rounded-md shadow-lg hover:bg-teal-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            <!-- Content with padding for mobile button -->
            <div class="md:mt-0 mt-12 flex-1">
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
            </div>

            <!-- Footer -->
            <footer class="bg-teal-600 text-white py-4 mt-auto w-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="text-sm">Copyright © 2025 Universitas Nahdlatul Ulama Kalimantan Timur</p>
                </div>
            </footer>
        </main>
    </div>

    <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileToggle = document.getElementById('mobileToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('lg:translate-x-0');
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }

        if (mobileToggle) {
            mobileToggle.addEventListener('click', toggleSidebar);
        }

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = mobileToggle.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 1024) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });

        // Initialize sidebar state on mobile
        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full', 'absolute', 'z-40', 'h-full');
        }
    </script>
</body>

</html>
