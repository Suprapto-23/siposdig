<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder spesifik yang kita butuhkan
        $this->call([
            AdminSeeder::class,
            // UnitPosyanduSeeder::class, // Hilangkan tanda komentar (//) ini jika Anda juga ingin membuat data Posyandu awal[cite: 22]
        ]);
    }
}