<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-bold text-blue-800">Detail Aset</h3>
                        <a href="@auth {{ route('assets.index') }} @else {{ route('public-assets') }} @endauth" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                    </div>

                    <div class="bg-blue-50 rounded-lg p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-xl font-semibold text-blue-800 mb-2">Informasi Aset</h4>
                                <p><span class="font-semibold">Ident Code:</span> {{ $locationAsset->ident_code }}</p>
                                <p><span class="font-semibold">Nama:</span> {{ $locationAsset->asset->name }}</p>
                                <p><span class="font-semibold">Kategori:</span> {{ $locationAsset->asset->category->name }}</p>
                                <p><span class="font-semibold">Lokasi:</span> {{ $locationAsset->location->name }}</p>
                                <p><span class="font-semibold">Detail Lokasi:</span> {{ $locationAsset->location->detail_lokasi }}</p>
                                <p><span class="font-semibold">Stok:</span>
                                    @php
                                        $usedStock = \App\Models\AssetTransaction::where('ident_code', $locationAsset->ident_code)
                                                    ->where('kode_lokasi', $locationAsset->kode_lokasi)
                                                    ->where('status', '!=', 'Sudah Dikembalikan')
                                                    ->sum('jumlah');
                                        $availableStock = $locationAsset->stok - $usedStock;
                                    @endphp
                                    {{ $availableStock }}
                                </p>
                                @if($locationAsset->location->koordinat_x && $locationAsset->location->koordinat_y)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $locationAsset->location->koordinat_x }},{{ $locationAsset->location->koordinat_y }}" 
                                        target="_blank" 
                                        class="mt-4 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out shadow-md">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Navigasi ke Lokasi
                                    </a>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-blue-800 mb-2">Deskripsi</h4>
                                <p>{{ $locationAsset->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                <h4 class="text-xl font-semibold text-blue-800 mt-4 mb-2">Petugas Terakhir</h4>
                                <p>{{ $locationAsset->petugas ?? 'Belum ada update' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <h4 class="text-xl font-semibold text-blue-800 mb-4">QR Code</h4>
                        <div class="mx-auto w-48 h-48">
                            {!! QrCode::size(200)->generate(route('assets.show', $locationAsset->id)) !!}
                        </div>
                        <p class="mt-2 text-blue-800 font-semibold">{{ $locationAsset->ident_code }}</p>
                        @auth
                            <a href="{{ route('assets.print-qr', $locationAsset->id) }}" target="_blank" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out shadow-md">
                                Print QR Code
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>