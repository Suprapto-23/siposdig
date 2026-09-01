<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengukuran_fisik', function (Blueprint $table) {
            $table->double('hemoglobin')->nullable()->after('asam_urat');
            $table->enum('status_kemandirian', ['mandiri', 'bantuan_ringan', 'bantuan_penuh'])->nullable()->after('hemoglobin');
        });
    }

    public function down(): void
    {
        Schema::table('pengukuran_fisik', function (Blueprint $table) {
            $table->dropColumn(['hemoglobin', 'status_kemandirian']);
        });
    }
};