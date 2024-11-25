<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-bold text-blue-800">Detail Transaksi Aset</h3>
                        <a href="{{ route('asset-transactions.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                    </div>

                    <div class="bg-blue-50 rounded-lg p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-xl font-semibold text-blue-800 mb-2">Informasi Transaksi</h4>
                                <p><span class="font-semibold">Ident Code:</span> {{ $transaction->ident_code }}</p>
                                <p><span class="font-semibold">Lokasi:</span> {{ $transaction->location->name }}</p>
                                <p><span class="font-semibold">Jumlah:</span> {{ $transaction->jumlah }}</p>
                                <p><span class="font-semibold">Petugas:</span> {{ $transaction->petugas }}</p>
                                <p><span class="font-semibold">Pengaju:</span> {{ $transaction->pengaju }}</p>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-blue-800 mb-2">Detail Tambahan</h4>
                                <p><span class="font-semibold">Divisi:</span> {{ $transaction->divisi }}</p>
                                <p><span class="font-semibold">Status:</span> 
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $transaction->status === 'Belum Dikembalikan' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $transaction->status }}
                                    </span>
                                </p>
                                <p><span class="font-semibold">Kondisi Keluar:</span> {{ $transaction->kondisi_keluar }}</p>
                                <p><span class="font-semibold">Kondisi Masuk:</span> {{ $transaction->kondisi_masuk }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>