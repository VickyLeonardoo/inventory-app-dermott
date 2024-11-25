<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-bold text-blue-800">Daftar Lokasi</h3>
                        <a href="{{ route('locations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Tambah Lokasi
                        </a>
                    </div>

                    <form action="{{ route('locations.index') }}" method="GET" class="mb-4 flex">
                        <input type="text" name="search" placeholder="Cari lokasi..." value="{{ request('search') }}" class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">Cari</button>
                    </form>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Kode Lokasi</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Nama</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Detail Lokasi</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Koordinat</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($locations as $location)
                                    <tr>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $location->kode_lokasi }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $location->name }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ Str::limit($location->detail_lokasi, 50) }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $location->koordinat_x }}, {{ $location->koordinat_y }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            <a href="{{ route('locations.edit', $location->kode_lokasi) }}" class="text-blue-500 hover:text-blue-600 mr-3">Edit</a>
                                            <form action="{{ route('locations.destroy', $location->kode_lokasi) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">Hapus</button>
                                            </form>
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
</x-app-layout>