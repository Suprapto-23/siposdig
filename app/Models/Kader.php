<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kader extends Authenticatable
{
    use Notifiable;

    protected $table = 'kader';

    protected $fillable = [
        'unit_posyandu_id', 'nama_lengkap', 'email', 'password',
        'wajib_ganti_password', 'status',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function unitPosyandu()
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id');
    }
}