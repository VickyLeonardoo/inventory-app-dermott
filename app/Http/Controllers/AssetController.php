<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\LocationAsset;
use App\Models\AssetCategory;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $query = Asset::with('locationAssets.location', 'category');

        // Handle search
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('ident_code', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('category', function($q) use ($searchTerm) {
                      $q->where('name', 'LIKE', "%{$searchTerm}%");
                  })
                  ->orWhereHas('locationAssets.location', function($q) use ($searchTerm) {
                      $q->where('name', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $assets = $query->get();

        return view('assets.index', compact('assets'));
    }

    public function show($id)
    {
        $locationAsset = LocationAsset::find($id);
        
        if (!$locationAsset) {
            return redirect()->route('assets.index')->with('error', 'Asset not found.');
        }

        return view('assets.show', compact('locationAsset'));
    }

    public function printQR(LocationAsset $locationAsset)
    {
        return view('assets.print-qr', compact('locationAsset'));
    }

    public function create()
    {
        $categories = AssetCategory::all();
        $locations = Location::all();
        $existingAssets = Asset::all();
        return view('assets.create', compact('categories', 'locations', 'existingAssets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ident_code' => 'required_without:new_ident_code',
            'new_ident_code' => 'required_if:ident_code,new|unique:assets,ident_code',
            'kode_lokasi' => 'required|exists:locations,kode_lokasi',
            'stok' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        $ident_code = $request->ident_code === 'new' ? $request->new_ident_code : $request->ident_code;

        if ($request->ident_code === 'new') {
            $this->storeAsset($request, $ident_code);
        }

        $this->storeLocationAsset($request, $ident_code);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan atau diperbarui.');
    }

    private function storeAsset(Request $request, $ident_code)
    {
        $request->validate([
            'name' => 'required',
            'asset_category_id' => 'required|exists:asset_categories,id',
        ]);

        Asset::create([
            'ident_code' => $ident_code,
            'name' => $request->name,
            'asset_category_id' => $request->asset_category_id,
        ]);
    }

    private function storeLocationAsset(Request $request, $ident_code)
    {
        LocationAsset::create([
            'ident_code' => $ident_code,
            'kode_lokasi' => $request->kode_lokasi,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'petugas_id' => Auth::id(),
            'petugas' => Auth::user()->name,
        ]);
    }

    public function getLocationDetails($kode_lokasi)
    {
        $location = Location::where('kode_lokasi', $kode_lokasi)->firstOrFail();
        return response()->json($location);
    }

    public function getAssetDetails($ident_code)
    {
        $asset = Asset::where('ident_code', $ident_code)->firstOrFail();
        return response()->json($asset);
    }
    
    public function checkIdentCode($ident_code)
    {
        $exists = Asset::where('ident_code', $ident_code)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function getAvailableLocations($ident_code)
    {
        $usedLocations = LocationAsset::where('ident_code', $ident_code)->pluck('kode_lokasi');
        $availableLocations = Location::whereNotIn('kode_lokasi', $usedLocations)->get();
        return response()->json($availableLocations);
    }

    public function edit($id)
    {
        $locationAsset = LocationAsset::findOrFail($id);
        $asset = Asset::where('ident_code', $locationAsset->ident_code)->firstOrFail();
        $categories = AssetCategory::all();
        
        $usedLocations = LocationAsset::where('ident_code', $asset->ident_code)
                                    ->where('kode_lokasi', '!=', $locationAsset->kode_lokasi)
                                    ->pluck('kode_lokasi');
        $availableLocations = Location::whereNotIn('kode_lokasi', $usedLocations)
                                    ->orWhere('kode_lokasi', $locationAsset->kode_lokasi)
                                    ->get();

        return view('assets.edit', compact('asset', 'locationAsset', 'categories', 'availableLocations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'kode_lokasi' => 'required',
            'stok' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        $locationAsset = LocationAsset::findOrFail($id);
        $locationAsset->update([
            'kode_lokasi' => $request->kode_lokasi,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'petugas_id' => Auth::id(),
            'petugas' => Auth::user()->name,
        ]);

        $asset = Asset::where('ident_code', $locationAsset->ident_code)->firstOrFail();
        $asset->update([
            'name' => $request->name,
            'asset_category_id' => $request->asset_category_id,
        ]);

        return redirect()->route('assets.index')
                         ->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Memulai transaksi database
        DB::beginTransaction();

        try {
            $locationAsset = LocationAsset::findOrFail($id);
            $ident_code = $locationAsset->ident_code;

            // Menghapus LocationAsset
            $locationAsset->delete();

            // Memeriksa apakah ini adalah LocationAsset terakhir untuk Asset ini
            $remainingLocationAssets = LocationAsset::where('ident_code', $ident_code)->count();

            if ($remainingLocationAssets === 0) {
                // Jika tidak ada LocationAsset yang tersisa, hapus Asset
                Asset::where('ident_code', $ident_code)->delete();
            }

            // Jika semua operasi berhasil, commit transaksi
            DB::commit();

            return redirect()->route('assets.index')
                             ->with('success', 'Aset berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, batalkan semua perubahan
            DB::rollBack();
            return redirect()->route('assets.index')
                             ->with('error', 'Terjadi kesalahan saat menghapus aset: ' . $e->getMessage());
        }
    }
}