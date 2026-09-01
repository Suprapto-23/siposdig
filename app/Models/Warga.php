<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Warga extends Authenticatable
{
    use Notifiable;

    protected $table = 'warga';

    protected $fillable = [
        'unit_posyandu_id',
        'nik',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'kategori',
        'status', // pending, aktif, ditolak, nonaktif
        'password',
        'wajib_ganti_password',
        'catatan_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'password' => 'hashed',
        'wajib_ganti_password' => 'boolean',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id');
    }

    public function pengukuran(): HasMany
    {
        return $this->hasMany(PengukuranFisik::class, 'warga_id');
    }

    // Accessor otomatis untuk menghitung usia detail
    public function getUsiaDetailAttribute(): string
    {
        if (!$this->tanggal_lahir) return '-';
        $diff = $this->tanggal_lahir->diff(Carbon::now());
        return "{$diff->y} thn, {$diff->m} bln";
    }
}