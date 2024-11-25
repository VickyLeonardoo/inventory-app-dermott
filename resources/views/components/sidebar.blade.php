<div class="w-64 h-full bg-white text-gray-800 shadow-lg flex flex-col">
    <div class="p-6 flex items-center space-x-4">
        <img src="https://media.licdn.com/dms/image/C4E0BAQErVvM57WXQxw/company-logo_200_200/0/1631378626695/mcdermott_international_inc__logo?e=2147483647&v=beta&t=lN6ahfOkEU0qv_RKaAm-L82NJRTwkjhjSZskpmDHGkQ" alt="PT McDermott Logo" class="h-10 w-10">
        <div class="text-lg font-semibold">
            PT McDermott
        </div>
    </div>
    <nav class="mt-6 flex-grow">
        @php
            $routeName = Route::currentRouteName();
        @endphp
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm {{ $routeName === 'dashboard' ? 'text-blue-600' : 'text-gray-800 hover:bg-gray-100 hover:text-blue-600' }} transition duration-200">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                </svg>
                <span>Dashboard</span>
            </div>
        </a>
        @role('admin')
            <a href="{{ route('user-management.index') }}" class="block px-4 py-2 text-sm {{ $routeName === 'user-management.index' ? 'text-blue-600' : 'text-gray-800 hover:bg-gray-100 hover:text-blue-600' }} transition duration-200">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    <span>Manajemen Pengguna</span>
                </div>
            </a>
        @endrole
        <a href="{{ route('assets.index') }}" class="block px-4 py-2 text-sm {{ request()->routeIs(['assets.index', 'assets.create', 'assets.edit', 'assets.show']) ? 'text-blue-600' : 'text-gray-800 hover:bg-gray-100 hover:text-blue-600' }} transition duration-200">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Aset</span>
            </div>
        </a>
        <a href="{{ route('asset-categories.index') }}" class="block px-4 py-2 text-sm {{ request()->routeIs(['asset-categories.index', 'asset-categories.create', 'asset-categories.edit']) ? 'text-blue-600' : 'text-gray-800 hover:bg-gray-100 hover:text-blue-600' }} transition duration-200">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                </svg>
                <span>Kategori Aset</span>
            </div>
        </a>
        <a href="{{ route('locations.index') }}" class="block px-4 py-2 text-sm {{ request()->routeIs(['locations.index', 'locations.create', 'locations.edit']) ? 'text-blue-600' : 'text-gray-800 hover:bg-gray-100 hover:text-blue-600' }} transition duration-200">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                <span>Lokasi</span>
            </div>
        </a>
        <a href="{{ route('asset-transactions.index') }}" class="block px-4 py-2 text-sm {{ request()->routeIs(['asset-transactions.index', 'asset-transactions.create', 'asset-transactions.edit', 'asset-transactions.show']) ? 'text-blue-600' : 'text-gray-800 hover:bg-gray-100 hover:text-blue-600' }} transition duration-200">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                </svg>
                <span>Transaksi Aset</span>
            </div>
        </a>
    </nav>
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center space-x-3">
            <img class="w-10 h-10 object-cover rounded-full" src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : asset('images/default-photo.png') }}" alt="User Avatar">
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mt-3 block w-full px-4 py-2 text-sm text-center text-white bg-red-600 rounded-md hover:bg-red-700 transition duration-200">
                Logout
            </button>
        </form>
    </div>
</div>