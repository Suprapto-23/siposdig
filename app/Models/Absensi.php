<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    
    protected $fillable = [
        'warga_id', 
        'kader_id', 
        'unit_posyandu_id', 
        'jadwal_posyandu_id', 
        'tanggal', 
        'status_hadir', 
        'keterangan'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    // TAMBAHKAN RELASI INI
    public function kader()
    {
        return $this->belongsTo(Kader::class, 'kader_id');
    }
}