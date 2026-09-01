<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Warga extends Authenticatable
{
    use HasFactory;

    // 1. Kunci nama tabel agar tidak dibaca 'wargas'
    protected $table = 'warga';

    // 2. Izinkan kolom-kolom ini diisi melalui form (Mass Assignment)
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'unit_posyandu_id',
        'tanggal_lahir',
        'jenis_kelamin',
        'kategori',
        'alamat',
        'no_hp',
        'password',
        'wajib_ganti_password',
        'status',
    ];

    /**
     * 3. RELASI ELOQUENT (Penyebab error saat ini)
     * Pastikan penamaan method menggunakan camelCase (unitPosyandu)
     */
    public function unitPosyandu()
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id', 'id');
    }

    /**
     * Relasi ke Pengukuran Fisik (Mencegah error di kemudian hari)
     */
    public function pengukuranFisik()
    {
        return $this->hasMany(PengukuranFisik::class, 'warga_id', 'id');
    }
}