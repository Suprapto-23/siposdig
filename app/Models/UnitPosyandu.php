<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitPosyandu extends Model
{
    protected $table = 'unit_posyandu';

    protected $fillable = [
        'nama',
        'wilayah',
        'alamat',
        'penanggung_jawab',
    ];

    // Relasi: Satu Unit Posyandu memiliki banyak Kader
    public function kaders()
    {
        return $this->hasMany(Kader::class, 'unit_posyandu_id');
    }
}