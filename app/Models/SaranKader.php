<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaranKader extends Model
{
    protected $table = 'saran_kader';

    protected $fillable = [
        'kader_id',
        'warga_id',
        'pengukuran_fisik_id', // nullable
        'pesan_saran',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kader(): BelongsTo
    {
        return $this->belongsTo(Kader::class, 'kader_id');
    }

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function pengukuran(): BelongsTo
    {
        return $this->belongsTo(PengukuranFisik::class, 'pengukuran_fisik_id');
    }
}