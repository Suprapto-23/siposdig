<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    // 1. Mencegah error "kaders table not found"
    protected $table = 'kader';

    // 2. Kolom yang boleh diisi (mass-assignable)
    protected $fillable = [
        'unit_posyandu_id',
        'nama_lengkap',
        'email',
        'password',
        'wajib_ganti_password',
        'status',
    ];

    // 3. Sembunyikan password saat data dipanggil
    protected $hidden = [
        'password',
    ];

    // 4. Relasi: Satu kader dimiliki oleh satu Unit Posyandu
    public function unitPosyandu()
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id');
    }
}