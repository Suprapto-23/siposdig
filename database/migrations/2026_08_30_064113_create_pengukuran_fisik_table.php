<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengukuran_fisik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->foreignId('kader_id')->constrained('kader')->cascadeOnDelete();
            $table->date('tanggal_ukur');
            
            // Pengukuran Umum
            $table->float('berat_badan')->nullable();
            $table->float('tinggi_badan')->nullable();
            
            // Spesifik Balita
            $table->float('lingkar_kepala')->nullable();
            $table->float('lila')->nullable(); 
            $table->string('status_gizi')->nullable();
            
            // Spesifik Remaja & Lansia
            $table->float('imt')->nullable(); 
            $table->integer('sistol')->nullable();
            $table->integer('diastol')->nullable();
            $table->integer('gula_darah')->nullable();
            $table->integer('kolesterol')->nullable();
            $table->boolean('skrining_ptm')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengukuran_fisik');
    }
};