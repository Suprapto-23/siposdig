<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('pelaku'); // Nama user/kader/admin yang melakukan
            $table->string('role'); // Peran (Admin, Kader, Warga)
            $table->string('aksi'); // Contoh: Login, Tambah Data, Hapus Data
            $table->text('deskripsi'); // Detail aktivitas
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('log_aktivitas');
    }
};