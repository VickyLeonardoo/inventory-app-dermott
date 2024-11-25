<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aset</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-bold text-blue-800">Daftar Aset</h3>
                        <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('public-assets') }}" method="GET" class="mb-4 flex">
                        <input type="text" name="search" placeholder="Cari aset..." value="{{ request('search') }}" class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">Cari</button>
                    </form>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Ident Code</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Nama</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Lokasi</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Stok</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($locationAssets as $locationAsset)
                                    <tr>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $locationAsset->ident_code }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $locationAsset->asset->name }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $locationAsset->location->name }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            @php
                                                $usedStock = \App\Models\AssetTransaction::where('ident_code', $locationAsset->ident_code)
                                                              ->where('kode_lokasi', $locationAsset->kode_lokasi)
                                                              ->where('status', '!=', 'Sudah Dikembalikan')
                                                              ->sum('jumlah');
                                                $availableStock = $locationAsset->stok - $usedStock;
                                            @endphp
                                            {{ $availableStock }}
                                        </td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            <a href="{{ route('assets.show', $locationAsset->id) }}" class="text-blue-500 hover:text-blue-600">Lihat Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>