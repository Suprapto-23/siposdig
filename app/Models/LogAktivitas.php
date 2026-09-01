<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as SpatieActivity;

class LogAktivitas extends SpatieActivity
{
    // Override nama tabel jika berbeda dari bawaan spatie
    protected $table = 'log_aktivitas';

    // Model ini secara otomatis diurus oleh Spatie.
    // Jika Anda ingin menambahkan accessor/mutator spesifik, bisa di sini.
}