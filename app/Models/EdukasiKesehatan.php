<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdukasiKesehatan extends Model 
{
    use HasFactory;

    // Mendefinisikan nama tabel secara eksplisit sesuai migration
    protected $table = 'edukasi_kesehatan';

    // Menyesuaikan kolom dengan migration terbaru
    protected $fillable = [
        'judul',
        'konten',
        'gambar',
        'target_kategori',
    ];
}