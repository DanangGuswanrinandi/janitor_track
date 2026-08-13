<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('username', 100)
                ->unique()
                ->after('id');

            $table->string('role', 50)
                ->default('janitor')
                ->after('password');

            $table->dropColumn([
                'name',
                'email',
                'email_verified_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->dropUnique(['username']);
            $table->dropColumn([
                'username',
                'role',
            ]);
        });
    }
};