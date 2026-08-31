<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    protected $table = 'jadwal_posyandu';

    protected $fillable = [
        'unit_posyandu_id', 'judul_kegiatan', 'jenis_kegiatan',
        'tanggal', 'waktu_mulai', 'waktu_selesai', 'keterangan', 'dibuat_oleh',
    ];

    public function unitPosyandu()
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id');
    }
}