<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PT McDermott Asset Management') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-blue-50">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full z-10 bg-gradient-to-r from-blue-800 to-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <!-- Logo -->
                    <div class="flex items-center py-5 px-2 text-white">
                        <x-application-logo class="w-10 h-10 fill-current"/>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('public-assets') }}" class="py-2 px-6 bg-blue-500 text-white font-semibold rounded-full hover:bg-blue-600 transition duration-300">Daftar Asset</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="py-2 px-4 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition duration-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="py-2 px-6 bg-white text-blue-700 font-semibold rounded-full hover:bg-blue-100 transition duration-300">LOGIN</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="relative flex flex-col items-center justify-center min-h-screen bg-cover bg-center bg-fixed" style="background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-700 opacity-80"></div>
        <div class="relative w-full max-w-6xl px-6 py-16 md:px-12 md:py-24 flex flex-col md:flex-row items-center justify-between">
            <!-- Text Content -->
            <div class="md:w-1/2 text-white mb-12 md:mb-0 animate__animated animate__fadeInLeft">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Efisiensi Pengelolaan Aset Internal</h1>
                <p class="text-xl mb-8">
                    Optimalkan penggunaan aset perusahaan dengan sistem manajemen yang terintegrasi. Lacak, pinjam, dan kembalikan aset dengan mudah menggunakan teknologi QR code.
                </p>
                <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-blue-700 font-bold rounded-full hover:bg-blue-100 transition duration-300 inline-block">AKSES SISTEM</a>
            </div>
            
            <!-- Image/Illustration -->
            <div class="md:w-1/2 flex justify-center animate__animated animate__fadeInRight">
                <img src="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" alt="Asset Management Illustration" class="w-3/4 float-animation">
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Fitur Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-blue-50 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-blue-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pelacakan QR Code</h3>
                    <p class="text-gray-600">Deteksi lokasi aset dengan cepat menggunakan teknologi QR code yang terintegrasi.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-blue-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Peminjaman & Pengembalian Mudah</h3>
                    <p class="text-gray-600">Proses peminjaman dan pengembalian aset yang efisien dengan pelacakan otomatis.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-blue-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Laporan Penggunaan Aset</h3>
                    <p class="text-gray-600">Analisis penggunaan aset untuk optimalisasi dan perencanaan yang lebih baik.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <p>&copy; 2024 PT McDermott. All rights reserved.</p>
                </div>
                <div>
                    <a href="#" class="text-blue-300 hover:text-white transition duration-300">Privacy Policy</a>
                    <span class="mx-2">|</span>
                    <a href="#" class="text-blue-300 hover:text-white transition duration-300">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>