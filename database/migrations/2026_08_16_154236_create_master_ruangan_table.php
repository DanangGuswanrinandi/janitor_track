<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        Schema::create('master_ruangan', function (Blueprint $table) {

            $table->id();

            $table->string(
                'kode_ruangan',
                20
            )->unique();

            $table->string(
                'nama_ruangan',
                150
            );

            $table->string(
                'lokasi',
                150
            );

            $table->decimal(
                'latitude',
                10,
                7
            );

            $table->decimal(
                'longitude',
                10,
                7
            );

            $table->timestamps();

        });
    }


    /**
     * Membalikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'master_ruangan'
        );
    }
};