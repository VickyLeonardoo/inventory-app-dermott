<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $query = Location::query();

        // Handle search
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%");
            });
        }

        $locations = $query->get();

        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_lokasi' => 'required|unique:locations',
            'name' => 'required',
            'detail_lokasi' => 'required',
            'koordinat_x' => 'required|numeric',
            'koordinat_y' => 'required|numeric',
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')
                         ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit($kode_lokasi)
    {
        $location = Location::findOrFail($kode_lokasi);
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, $kode_lokasi)
    {
        $request->validate([
            'kode_lokasi' => 'required|unique:locations,kode_lokasi,'.$kode_lokasi.',kode_lokasi',
            'name' => 'required',
            'detail_lokasi' => 'required',
            'koordinat_x' => 'required|numeric',
            'koordinat_y' => 'required|numeric',
        ]);

        $location = Location::where('kode_lokasi', $kode_lokasi)->firstOrFail();

        $location->update($request->all());

        return redirect()->route('locations.index')
                         ->with('success', 'Lokasi berhasil diupdate.');
    }

    public function destroy($kode_lokasi)
    {
        $location = Location::findOrFail($kode_lokasi);
        $location->delete();

        return redirect()->route('locations.index')
                         ->with('success', 'Lokasi berhasil dihapus.');
    }
}
