<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPosyandu extends Model
{
    protected $table = 'jadwal_posyandu';

    protected $fillable = [
        'unit_posyandu_id',
        'judul',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'keterangan',
        'status', // dijadwalkan, berlangsung, selesai, batal
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id');
    }

    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class, 'jadwal_posyandu_id');
    }
}