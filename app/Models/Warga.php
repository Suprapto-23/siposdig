<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Warga extends Authenticatable
{
    use Notifiable;

    protected $table = 'warga';

    protected $fillable = [
        'unit_posyandu_id', 'id_wali', 'nama_lengkap', 'nik', 'tanggal_lahir',
        'jenis_kelamin', 'alamat', 'no_hp', 'password', 'status',
        'catatan_admin', 'wajib_ganti_password',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function unitPosyandu()
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id');
    }
}