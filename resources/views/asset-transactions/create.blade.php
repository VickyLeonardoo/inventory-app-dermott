<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-3xl font-bold text-blue-800 mb-6">Tambah Transaksi Aset Baru</h2>
                    <form action="{{ route('asset-transactions.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                            <div>
                                <label for="ident_code" class="block text-sm font-medium text-gray-700">Aset</label>
                                <select name="ident_code" id="ident_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                    <option value="">Pilih Aset</option>
                                    @foreach($assets as $asset)
                                        <option value="{{ $asset->ident_code }}">{{ $asset->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="kode_lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                                <select name="kode_lokasi" id="kode_lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                    <option value="">Pilih Lokasi</option>
                                </select>
                            </div>
                            <div>
                                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                                @error('jumlah')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="pengaju" class="block text-sm font-medium text-gray-700">Nama Pengaju</label>
                                <input type="text" name="pengaju" id="pengaju" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            </div>
                            <div>
                                <label for="divisi" class="block text-sm font-medium text-gray-700">Divisi</label>
                                <input type="text" name="divisi" id="divisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            </div>
                            <div>
                                <label for="kondisi_keluar" class="block text-sm font-medium text-gray-700">Kondisi Keluar</label>
                                <textarea name="kondisi_keluar" id="kondisi_keluar" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const assetSelect = document.getElementById('ident_code');
            const locationSelect = document.getElementById('kode_lokasi');

            assetSelect.addEventListener('change', function() {
                const ident_code = this.value;
                locationSelect.innerHTML = '<option value="">Pilih Lokasi</option>';

                if (ident_code) {
                    fetch(`/asset-transactions/locations/${ident_code}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(location => {
                                const option = document.createElement('option');
                                option.value = location.kode_lokasi;
                                option.textContent = location.name;
                                locationSelect.appendChild(option);
                            });
                        });
                }
            });
        });
    </script>
</x-app-layout>