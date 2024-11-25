<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-3xl font-bold text-blue-800 mb-6">Tambah Lokasi</h2>
                    <form id="locationForm" action="{{ route('locations.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                            <div>
                                <label for="kode_lokasi" class="block text-sm font-medium text-gray-700">Kode Lokasi</label>
                                <input type="text" name="kode_lokasi" id="kode_lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ old('kode_lokasi') }}" required>
                                @error('kode_lokasi')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="detail_lokasi" class="block text-sm font-medium text-gray-700">Detail Lokasi</label>
                            <textarea name="detail_lokasi" id="detail_lokasi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('detail_lokasi') }}</textarea>
                            @error('detail_lokasi')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Lokasi</label>
                            <div id="map" class="w-full h-96 rounded-md shadow-md"></div>
                            <button type="button" id="getCurrentLocation" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Gunakan Lokasi Saat Ini
                            </button>
                        </div>
                        <input type="hidden" name="koordinat_x" id="koordinat_x" value="{{ old('koordinat_x') }}">
                        <input type="hidden" name="koordinat_y" id="koordinat_y" value="{{ old('koordinat_y') }}">
                        @if ($errors->has('koordinat_x') || $errors->has('koordinat_y'))
                            <p class="text-red-600 text-sm mt-2">Koordinat harus diisi.</p>
                        @endif
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                                Simpan Lokasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var marker;

        function onMapClick(e) {
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
            document.getElementById('koordinat_x').value = e.latlng.lat;
            document.getElementById('koordinat_y').value = e.latlng.lng;
        }

        map.on('click', onMapClick);

        document.getElementById('getCurrentLocation').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latlng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setView(latlng, 16);
                    if (marker) {
                        marker.setLatLng(latlng);
                    } else {
                        marker = L.marker(latlng).addTo(map);
                    }
                    document.getElementById('koordinat_x').value = latlng.lat;
                    document.getElementById('koordinat_y').value = latlng.lng;
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });
    </script>
</x-app-layout>