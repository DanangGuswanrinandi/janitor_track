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
        Schema::create('laporan_janitor', function (Blueprint $table) {

            $table->id();

            $table->foreignId('ruangan_id')
                ->constrained(
                    'master_ruangan'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->constrained(
                    'users'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string(
                'foto_kondisi',
                255
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

            $table->text(
                'keterangan'
            )->nullable();

            $table->timestamps();

        });
    }


    /**
     * Membalikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'laporan_janitor'
        );
    }
};
