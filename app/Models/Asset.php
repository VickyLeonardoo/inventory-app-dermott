<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $primaryKey = 'ident_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ident_code',
        'name',
        'asset_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function locationAssets()
    {
        return $this->hasMany(LocationAsset::class, 'ident_code', 'ident_code');
    }
}
