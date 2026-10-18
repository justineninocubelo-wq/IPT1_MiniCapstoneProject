<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('image')->nullable();
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->string('banner_image')->nullable();
        });

        Schema::table('players', function (Blueprint $table) {
            $table->string('profile_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('profile_image');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('banner_image');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
