<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saran_kader', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->foreignId('kader_id')->constrained('kader')->cascadeOnDelete();
            $table->foreignId('pengukuran_fisik_id')->nullable()->constrained('pengukuran_fisik')->nullOnDelete();
            $table->text('catatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saran_kader');
    }
};