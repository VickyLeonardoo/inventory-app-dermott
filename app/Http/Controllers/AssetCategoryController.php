<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = AssetCategory::orderBy('name', 'asc');

        // Handle search
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%");
            });
        }

        $categories = $query->get();

        return view('asset-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('asset-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:asset_categories',
        ]);

        AssetCategory::create($request->all());

        return redirect()->route('asset-categories.index')
                         ->with('success', 'Kategori aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = AssetCategory::find($id);
        return view('asset-categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:asset_categories,name,'.$id,
        ]);

        $category = AssetCategory::find($id);
        $category->update($request->all());

        return redirect()->route('asset-categories.index')
                         ->with('success', 'Kategori aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = AssetCategory::find($id);
        $category->delete();

        return redirect()->route('asset-categories.index')
                         ->with('success', 'Kategori aset berhasil dihapus.');
    }
}
