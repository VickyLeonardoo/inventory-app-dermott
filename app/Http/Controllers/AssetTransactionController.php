<?php

namespace App\Http\Controllers;

use App\Models\AssetTransaction;
use App\Models\Asset;
use App\Models\Location;
use App\Models\LocationAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = AssetTransaction::with('asset', 'location');

        // Handle search
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('ident_code', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('petugas', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('pengaju', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('divisi', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('status', 'LIKE', "%{$searchTerm}%");
            });
        }

        $transactions = $query->get();

        return view('asset-transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = AssetTransaction::find($id);
        
        if (!$transaction) {
            return redirect()->route('asset-transactions.index')->with('error', 'Transaction not found.');
        }

        return view('asset-transactions.show', compact('transaction'));
    }

    public function create()
    {
        $assets = Asset::all();
        return view('asset-transactions.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ident_code' => 'required|exists:assets,ident_code',
            'kode_lokasi' => 'required|exists:locations,kode_lokasi',
            'jumlah' => 'required|integer|min:1',
            'pengaju' => 'required|string',
            'divisi' => 'required|string',
            'kondisi_keluar' => 'nullable|string',
        ]);

        $locationAsset = LocationAsset::where('ident_code', $request->ident_code)
            ->where('kode_lokasi', $request->kode_lokasi)
            ->firstOrFail();

        $usedStock = AssetTransaction::where('ident_code', $request->ident_code)
            ->where('kode_lokasi', $request->kode_lokasi)
            ->where('status', '!=', 'Sudah Dikembalikan')
            ->sum('jumlah');

        $availableStock = $locationAsset->stok - $usedStock;

        if ($request->jumlah > $availableStock) {
            return back()->withErrors(['jumlah' => 'Jumlah yang diminta melebihi stok yang tersedia.'])->withInput();
        }

        AssetTransaction::create([
            'ident_code' => $request->ident_code,
            'kode_lokasi' => $request->kode_lokasi,
            'jumlah' => $request->jumlah,
            'petugas_id' => Auth::id(),
            'petugas' => Auth::user()->name,
            'pengaju' => $request->pengaju,
            'divisi' => $request->divisi,
            'status' => 'Belum Dikembalikan',
            'kondisi_keluar' => $request->kondisi_keluar,
        ]);

        return redirect()->route('asset-transactions.index')
                         ->with('success', 'Transaksi Aset berhasil ditambahkan.');
    }

    public function getLocations($ident_code)
    {
        $locations = LocationAsset::where('ident_code', $ident_code)
            ->with('location')
            ->get()
            ->map(function ($locationAsset) {
                return [
                    'kode_lokasi' => $locationAsset->kode_lokasi,
                    'name' => $locationAsset->location->name,
                ];
            });

        return response()->json($locations);
    }

    public function edit($id)
    {
        $transaction = AssetTransaction::findOrFail($id);
        $assets = Asset::all();
        $locations = Location::all();
        return view('asset-transactions.edit', compact('transaction', 'assets', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ident_code' => 'required|exists:assets,ident_code',
            'kode_lokasi' => 'required|exists:locations,kode_lokasi',
            'jumlah' => 'required|integer',
            'pengaju' => 'required|string',
            'divisi' => 'required|string',
            'status' => 'required|string',
            'kondisi_keluar' => 'nullable|string',
            'kondisi_masuk' => 'nullable|string',
        ]);

        $transaction = AssetTransaction::findOrFail($id);
        $transaction->update([
            'ident_code' => $request->ident_code,
            'kode_lokasi' => $request->kode_lokasi,
            'jumlah' => $request->jumlah,
            'petugas_id' => Auth::id(),
            'petugas' => Auth::user()->name,
            'pengaju' => $request->pengaju,
            'divisi' => $request->divisi,
            'status' => $request->status,
            'kondisi_keluar' => $request->kondisi_keluar,
            'kondisi_masuk' => $request->kondisi_masuk,
        ]);

        return redirect()->route('asset-transactions.index')
                         ->with('success', 'Transaksi Aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaction = AssetTransaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('asset-transactions.index')
                         ->with('success', 'Transaksi Aset berhasil dihapus.');
    }
}
