<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBatchUuidColumnToActivityLogTable extends Migration
{
    public function up()
    {
        // Diperbarui dari config('activitylog.table_name') menjadi 'log_aktivitas'
        Schema::table('log_aktivitas', function (Blueprint $table) {
            $table->uuid('batch_uuid')->nullable()->after('updated_at');
        });
    }

    public function down()
    {
        Schema::table('log_aktivitas', function (Blueprint $table) {
            $table->dropColumn('batch_uuid');
        });
    }
}