<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kader extends Authenticatable
{
    use Notifiable;

    protected $table = 'kader';

    protected $fillable = [
        'unit_posyandu_id',
        'nama',
        'email',
        'password',
        'status',
        'wajib_ganti_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'wajib_ganti_password' => 'boolean',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitPosyandu::class, 'unit_posyandu_id');
    }

    public function pengukuranFisik(): HasMany
    {
        return $this->hasMany(PengukuranFisik::class, 'kader_id');
    }
}