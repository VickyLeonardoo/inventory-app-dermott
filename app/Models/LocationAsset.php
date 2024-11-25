<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_lokasi',
        'ident_code',
        'stok',
        'deskripsi',
        'petugas_id',
        'petugas',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'ident_code', 'ident_code');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'kode_lokasi', 'kode_lokasi');
    }

}
