<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitPosyandu extends Model
{
    protected $table = 'unit_posyandu';

    protected $fillable = [
        'nama',
        'alamat',
        'desa_kelurahan',
        'kecamatan',
        'penanggung_jawab',
    ];

    public function kader(): HasMany
    {
        return $this->hasMany(Kader::class, 'unit_posyandu_id');
    }

    public function warga(): HasMany
    {
        return $this->hasMany(Warga::class, 'unit_posyandu_id');
    }
}