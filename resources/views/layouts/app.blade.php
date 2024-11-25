<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex">
        @auth
            <div id="sidebar-container" class="fixed inset-y-0 left-0 z-30 transition-transform duration-300 ease-in-out transform -translate-x-full lg:translate-x-0">
                <!-- Sidebar -->
                <x-sidebar />
                
                <!-- Hamburger button -->
                <button id="sidebar-toggle" class="absolute top-4 -right-10 bg-white rounded-r-md p-2 lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        @endauth

        <!-- Main content -->
        <div id="main-content" class="flex-1 transition-all duration-300 ease-in-out lg:ml-64">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="bg-blue-100 min-h-screen">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts

    <script>
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarContainer = document.getElementById('sidebar-container');
        const mainContent = document.getElementById('main-content');

        sidebarToggle.addEventListener('click', () => {
            sidebarContainer.classList.toggle('-translate-x-full');
            mainContent.classList.toggle('lg:ml-64');
            mainContent.classList.toggle('ml-0');
        });

        // Inisialisasi posisi awal
        if (window.innerWidth >= 1024) { // lg breakpoint
            mainContent.classList.add('lg:ml-64');
            mainContent.classList.remove('ml-0');
        } else {
            mainContent.classList.remove('lg:ml-64');
            mainContent.classList.add('ml-0');
        }

        // Responsif terhadap perubahan ukuran layar
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebarContainer.classList.remove('-translate-x-full');
                mainContent.classList.add('lg:ml-64');
                mainContent.classList.remove('ml-0');
            } else {
                sidebarContainer.classList.add('-translate-x-full');
                mainContent.classList.remove('lg:ml-64');
                mainContent.classList.add('ml-0');
            }
        });
    </script>
</body>
</html>
