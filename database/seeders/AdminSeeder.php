<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin; // Pastikan model Admin di-import

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengecek agar tidak terjadi duplikasi saat seeder dijalankan ulang
        if (Admin::count() == 0) {
            Admin::create([
                'name' => 'Administrator SIPOSDIG', 
                'email' => 'admin@siposdig.go.id',
                'password' => Hash::make('password'), // Kata sandi untuk login
            ]);
            
            $this->command->info('Akun Admin berhasil dibuat!');
        } else {
            $this->command->info('Akun Admin sudah ada di database.');
        }
    }
}