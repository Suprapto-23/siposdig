<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_posyandu_id')->constrained('unit_posyandu')->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('no_hp')->nullable();
            $table->string('password')->nullable();
            $table->enum('status', ['pending', 'aktif', 'ditolak', 'nonaktif'])->default('pending');
            $table->string('catatan_admin')->nullable();
            $table->boolean('wajib_ganti_password')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};