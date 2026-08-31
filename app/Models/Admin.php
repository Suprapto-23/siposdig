<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // 1. Mendefinisikan nama tabel secara eksplisit agar tidak mencari 'admins'
    protected $table = 'admin';

    // 2. Mengizinkan mass-assignment saat menjalankan Seeder
    protected $guarded = ['id'];

    // 3. Keamanan: Sembunyikan field sensitif saat data diambil
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // (Opsional) Jika kolom password Anda di database bernama lain, beri tahu Laravel di sini.
    // Tapi secara default Laravel mencari kolom 'password'.
}