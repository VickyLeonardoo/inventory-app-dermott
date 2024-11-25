<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'ident_code',
        'kode_lokasi',
        'jumlah',
        'petugas_id',
        'petugas',
        'pengaju',
        'divisi',
        'status',
        'kondisi_keluar',
        'kondisi_masuk',
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
