<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan status validasi laporan.
     */
    public function up(): void
    {
        Schema::table('laporan_janitor', function (Blueprint $table) {

            $table->enum('status', [
                'menunggu',
                'terverifikasi',
            ])
            ->default('menunggu')
            ->after('id');

        });
    }


    /**
     * Membalikkan perubahan.
     */
    public function down(): void
    {
        Schema::table('laporan_janitor', function (Blueprint $table) {

            $table->dropColumn('status');

        });
    }
};
