<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'jadwal_posyandu_id',
        'warga_id',
        'status_hadir', // hadir, izin, sakit, alpa
        'keterangan',
    ];

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalPosyandu::class, 'jadwal_posyandu_id');
    }

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}