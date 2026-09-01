<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $fillable = [
        'notifiable_type', // App\Models\Warga, App\Models\Kader, dll
        'notifiable_id',
        'judul',
        'pesan',
        'data', // metadata tambahan (URL redirect dll)
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array', // Otomatis simpan/baca sebagai JSON
    ];

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }
}