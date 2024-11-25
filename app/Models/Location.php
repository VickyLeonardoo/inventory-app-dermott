<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_lokasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_lokasi',
        'name',
        'detail_lokasi',
        'koordinat_x',
        'koordinat_y',
    ];
}
