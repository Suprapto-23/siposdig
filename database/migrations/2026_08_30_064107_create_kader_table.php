<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kader', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_posyandu_id')->constrained('unit_posyandu')->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('wajib_ganti_password')->default(true);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kader');
    }
};