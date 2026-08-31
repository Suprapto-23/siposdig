<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';

    protected $fillable = [
        'unit_posyandu_id',
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'status',
        'catatan_admin',
        'wajib_ganti_password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke Unit Posyandu
    public function unitPosyandu()
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id');
    }
}