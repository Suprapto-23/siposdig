<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengukuranFisik extends Model
{
    protected $table = 'pengukuran_fisik';

    protected $fillable = [
        'warga_id', 
        'kader_id', 
        'kategori_saat_ukur', 
        'tanggal_ukur',
        'berat_badan', 
        'tinggi_badan', 
        'lingkar_kepala', 
        'lila', 
        'lingkar_perut',
        'status_gizi', 
        'status_stunting', 
        'imt', 
        'sistol', 
        'diastol',
        'gula_darah', 
        'kolesterol', 
        'asam_urat', 
        'hemoglobin',         
        'status_kemandirian',
        'skrining_ptm', 
        'catatan'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function kader()
    {
        return $this->belongsTo(Kader::class, 'kader_id');
    }
}