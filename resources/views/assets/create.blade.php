<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-3xl font-bold text-blue-800 mb-6">Tambah Aset</h2>
                    <form id="assetForm" action="{{ route('assets.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div id="step1">
                            <div class="mb-4">
                                <label for="ident_code" class="block text-sm font-medium text-gray-700">Ident Code</label>
                                <select name="ident_code" id="ident_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                    <option value="">Pilih atau tambah ident code baru</option>
                                    @foreach($existingAssets->sortBy('ident_code') as $asset)
                                        <option value="{{ $asset->ident_code }}">{{ $asset->ident_code }}</option>
                                    @endforeach
                                    <option value="new">+ Tambah ident code baru</option>
                                </select>
                                <input type="text" id="new_ident_code" name="new_ident_code" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 hidden" placeholder="Masukkan ident code baru">
                                <p id="ident_code_error" class="mt-2 text-sm text-red-600 hidden"></p>
                            </div>
                            <div id="assetDetails" class="hidden">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Aset</label>
                                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                </div>
                                <div class="mb-4">
                                    <label for="asset_category_id" class="block text-sm font-medium text-gray-700">Kategori Aset</label>
                                    <select name="asset_category_id" id="asset_category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                        <option value="">Pilih kategori</option>
                                        @foreach($categories->sortBy('name') as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                    @foreach($locations->sortBy('name') as $location)
                                        <option value="{{ $location->kode_lokasi }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                                <p id="kode_lokasi_error" class="mt-2 text-sm text-red-600 hidden">Harap pilih lokasi.</p>
                            </div>

                            <div id="locationDetails" class="mb-4 p-4 bg-gray-100 rounded-md hidden">
                                <!-- Detail lokasi akan ditampilkan di sini -->
                            </div>

                            <div class="mb-4">
                                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                                <input type="number" name="stok" id="stok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>
                            </div>

                            <div class="flex justify-between">
                                <button type="button" id="prevBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
                                    Kembali
                                </button>
                                <button type="submit" id="submitBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Simpan Aset
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
            const submitBtn = document.getElementById('submitBtn');
            const identCodeSelect = document.getElementById('ident_code');
            const newIdentCodeInput = document.getElementById('new_ident_code');
            const assetDetails = document.getElementById('assetDetails');
            const nameInput = document.getElementById('name');
            const categorySelect = document.getElementById('asset_category_id');
            const kodeLokasiSelect = document.getElementById('kode_lokasi');
            const identCodeError = document.getElementById('ident_code_error');
            const kodeLokasiError = document.getElementById('kode_lokasi_error');

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

            const identCodeTomSelect = new TomSelect('#ident_code', dropdownConfig);
            const kodeLokasiTomSelect = new TomSelect('#kode_lokasi', dropdownConfig);

            identCodeSelect.addEventListener('change', function() {
                if (this.value === 'new') {
                    newIdentCodeInput.classList.remove('hidden');
                    newIdentCodeInput.required = true;
                    assetDetails.classList.remove('hidden');
                    nameInput.value = '';
                    nameInput.readOnly = false;
                    categorySelect.value = '';
                    categorySelect.disabled = false;
                    identCodeError.classList.add('hidden');
                    resetLocationOptions();
                } else if (this.value) {
                    newIdentCodeInput.classList.add('hidden');
                    newIdentCodeInput.required = false;
                    assetDetails.classList.remove('hidden');
                    fetch(`/get-asset-details/${this.value}`)
                        .then(response => response.json())
                        .then(data => {
                            nameInput.value = data.name;
                            nameInput.readOnly = true;
                            categorySelect.value = data.asset_category_id;
                            categorySelect.disabled = true;
                            updateLocationOptions(this.value);
                        });
                } else {
                    newIdentCodeInput.classList.add('hidden');
                    newIdentCodeInput.required = false;
                    assetDetails.classList.add('hidden');
                    resetLocationOptions();
                }
            });

            newIdentCodeInput.addEventListener('blur', function() {
                if (this.value) {
                    fetch(`/check-ident-code/${this.value}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.exists) {
                                identCodeError.textContent = 'Ident Code ini sudah ada.';
                                identCodeError.classList.remove('hidden');
                            } else {
                                identCodeError.classList.add('hidden');
                            }
                        });
                }
            });

            function updateLocationOptions(identCode) {
                fetch(`/get-available-locations/${identCode}`)
                    .then(response => response.json())
                    .then(data => {
                        kodeLokasiTomSelect.clear();
                        kodeLokasiTomSelect.clearOptions();
                        kodeLokasiTomSelect.addOption({value: '', text: 'Pilih lokasi'});
                        data.forEach(location => {
                            kodeLokasiTomSelect.addOption({value: location.kode_lokasi, text: location.name});
                        });
                        kodeLokasiTomSelect.refreshOptions(false);
                    });
            }

            function resetLocationOptions() {
                kodeLokasiTomSelect.clear();
                kodeLokasiTomSelect.clearOptions();
                kodeLokasiTomSelect.addOption({value: '', text: 'Pilih lokasi'});
                @foreach($locations->sortBy('name') as $location)
                    kodeLokasiTomSelect.addOption({value: '{{ $location->kode_lokasi }}', text: '{{ $location->name }}'});
                @endforeach
                kodeLokasiTomSelect.refreshOptions(false);
            }

            nextBtn.addEventListener('click', function() {
                if ((identCodeSelect.value && identCodeSelect.value !== 'new') || 
                    (identCodeSelect.value === 'new' && newIdentCodeInput.value && identCodeError.classList.contains('hidden'))) {
                    if (nameInput.value && categorySelect.value) {
                        step1.classList.add('hidden');
                        step2.classList.remove('hidden');
                    } else {
                        alert('Harap isi semua field pada Step 1.');
                    }
                } else {
                    alert('Harap pilih atau masukkan ident code yang valid.');
                }
            });

            prevBtn.addEventListener('click', function() {
                step2.classList.add('hidden');
                step1.classList.remove('hidden');
            });

            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (validateForm()) {
                    document.getElementById('assetForm').submit();
                }
            });

            function validateForm() {
                let isValid = true;

                if (!kodeLokasiSelect.value) {
                    kodeLokasiError.classList.remove('hidden');
                    isValid = false;
                } else {
                    kodeLokasiError.classList.add('hidden');
                }

                // Add more validations for other fields if needed

                return isValid;
            }

            kodeLokasiSelect.addEventListener('change', function() {
                let kode_lokasi = this.value;
                if (kode_lokasi) {
                    kodeLokasiError.classList.add('hidden');
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
            });
        });
    </script>
</x-app-layout>