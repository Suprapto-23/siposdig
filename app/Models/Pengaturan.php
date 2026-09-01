<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';
    
    // Matikan timestamps jika tabel ini hanya key-value sederhana
    public $timestamps = false; 

    protected $fillable = [
        'key',
        'value',
        'tipe_data', // string, boolean, integer, json
        'keterangan',
    ];

    /**
     * Accessor untuk otomatis mengubah tipe data string di DB 
     * menjadi tipe asli PHP saat dipanggil (misal: "true" -> true)
     */
    public function getParsedValueAttribute()
    {
        return match ($this->tipe_data) {
            'boolean' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value,
        };
    }
}