<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EdukasiKesehatan extends Model
{
    protected $table = 'edukasi_kesehatan';

    protected $fillable = [
        'admin_id',
        'judul',
        'slug',
        'konten',
        'gambar',
        'target_kategori', // Balita, Remaja, Lansia, Semua
        'status', // draft, publish
    ];

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}