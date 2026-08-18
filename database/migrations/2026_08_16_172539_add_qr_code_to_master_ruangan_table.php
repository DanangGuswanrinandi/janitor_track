<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('master_ruangan', function (Blueprint $table) {

            $table->string('qr_code', 100)
                ->nullable()
                ->after('kode_ruangan');

        });
    }


    public function down(): void
    {
        Schema::table('master_ruangan', function (Blueprint $table) {

            $table->dropColumn('qr_code');

        });
    }
};