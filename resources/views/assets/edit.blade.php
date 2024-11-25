<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-3xl font-bold text-blue-800 mb-6">Edit Aset</h2>
                    <form id="assetForm" action="{{ route('assets.update', $locationAsset->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div id="step1">
                            <div class="mb-4">
                                <label for="ident_code" class="block text-sm font-medium text-gray-700">Ident Code</label>
                                <input type="text" name="ident_code" id="ident_code" value="{{ $asset->ident_code }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required readonly>
                            </div>
                            <div id="assetDetails">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Aset</label>
                                    <input type="text" name="name" id="name" value="{{ $asset->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                </div>
                                <div class="mb-4">
                                    <label for="asset_category_id" class="block text-sm font-medium text-gray-700">Kategori Aset</label>
                                    <select name="asset_category_id" id="asset_category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                        <option value="">Pilih kategori</option>
                                        @foreach($categories->sortBy('name') as $category)
                                            <option value="{{ $category->id }}" {{ $asset->asset_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" id="nextBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                                    Lanjut
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </button>
                            </div>
                        </div>

                        <div id="step2" class="hidden">
                            <div class="mb-4">
                                <label for="kode_lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                                <select name="kode_lokasi" id="kode_lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                    <option value="">Pilih lokasi</option>
                                    @foreach($availableLocations as $location)
                                        <option value="{{ $location->kode_lokasi }}" {{ $locationAsset->kode_lokasi == $location->kode_lokasi ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="locationDetails" class="mb-4 p-4 bg-gray-100 rounded-md hidden">
                                <!-- Location details will be displayed here -->
                            </div>

                            <div class="mb-4">
                                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                                <input type="number" name="stok" id="stok" value="{{ $locationAsset->stok }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ $locationAsset->deskripsi }}</textarea>
                            </div>

                            <div class="flex justify-between">
                                <button type="button" id="prevBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
                                    Kembali
                                </button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Update Aset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const nameInput = document.getElementById('name');
            const categorySelect = document.getElementById('asset_category_id');
            const kodeLokasiSelect = document.getElementById('kode_lokasi');

            // Inisialisasi Tom Select untuk dropdown dengan scrollbar
            const dropdownConfig = {
                create: false,
                sortField: { field: "text", direction: "asc" },
                maxOptions: null,
                maxItems: 1,
                plugins: ['dropdown_input'],
                dropdownParent: 'body',
                render: {
                    dropdown: function() {
                        return '<div class="ts-dropdown" style="max-height: 200px; overflow-y: auto;"></div>';
                    }
                }
            };

            new TomSelect('#asset_category_id', dropdownConfig);
            const kodeLokasiTomSelect = new TomSelect('#kode_lokasi', dropdownConfig);

            nextBtn.addEventListener('click', function() {
                if (nameInput.value && categorySelect.value) {
                    step1.classList.add('hidden');
                    step2.classList.remove('hidden');
                } else {
                    alert('Harap isi semua field pada Step 1.');
                }
            });

            prevBtn.addEventListener('click', function() {
                step2.classList.add('hidden');
                step1.classList.remove('hidden');
            });

            kodeLokasiSelect.addEventListener('change', function() {
                updateLocationDetails(this.value);
            });

            // Initial display of location details
            updateLocationDetails(kodeLokasiSelect.value);

            function updateLocationDetails(kode_lokasi) {
                if (kode_lokasi) {
                    fetch(`/get-location-details/${kode_lokasi}`)
                        .then(response => response.json())
                        .then(data => {
                            let detailsDiv = document.getElementById('locationDetails');
                            detailsDiv.innerHTML = `
                                <p><strong>Nama:</strong> ${data.name}</p>
                                <p><strong>Detail:</strong> ${data.detail_lokasi}</p>
                                <p><strong>Koordinat:</strong> ${data.koordinat_x}, ${data.koordinat_y}</p>
                            `;
                            detailsDiv.classList.remove('hidden');
                        });
                } else {
                    document.getElementById('locationDetails').classList.add('hidden');
                }
            }
        });
    </script>
</x-app-layout>