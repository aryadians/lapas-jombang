<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->unsignedInteger('nomor_antrian_harian')->nullable()->after('tanggal_kunjungan');
            $table->string('sesi', 50)->nullable()->after('nomor_antrian_harian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn(['nomor_antrian_harian', 'sesi']);
        });
    }
};
