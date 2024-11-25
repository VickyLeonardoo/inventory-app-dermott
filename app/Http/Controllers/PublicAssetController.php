<?php

namespace App\Http\Controllers;

use App\Models\LocationAsset;
use Illuminate\Http\Request;

class PublicAssetController extends Controller
{
    public function index(Request $request)
    {
        $query = LocationAsset::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('asset', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('ident_code', 'like', "%{$search}%");
        }

        $locationAssets = $query->with(['asset', 'location'])->paginate(15);

        return view('public-assets', compact('locationAssets'));
    }

}