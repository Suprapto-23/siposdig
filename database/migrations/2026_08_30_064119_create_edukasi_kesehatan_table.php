<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('edukasi_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('konten');
            $table->string('gambar')->nullable();
            $table->enum('target_kategori', ['Semua', 'Balita', 'Remaja', 'Lansia'])->default('Semua');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edukasi_kesehatan');
    }
};