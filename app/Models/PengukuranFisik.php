<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengukuranFisik extends Model
{
    protected $table = 'pengukuran_fisik';

    protected $fillable = [
        'warga_id',
        'kader_id',
        'tanggal_ukur',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lila',
        'tekanan_darah_sistol',
        'tekanan_darah_diastol',
        'gula_darah',
        'kolesterol',
        'imt',
        'status_gizi'
    ];

    protected $casts = [
        'tanggal_ukur' => 'date',
        'berat_badan' => 'float',
        'tinggi_badan' => 'float',
        'lingkar_kepala' => 'float',
        'lila' => 'float',
        'tekanan_darah_sistol' => 'integer',
        'tekanan_darah_diastol' => 'integer',
        'gula_darah' => 'integer',
        'kolesterol' => 'integer',
        'imt' => 'float',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function kader(): BelongsTo
    {
        return $this->belongsTo(Kader::class, 'kader_id');
    }
}