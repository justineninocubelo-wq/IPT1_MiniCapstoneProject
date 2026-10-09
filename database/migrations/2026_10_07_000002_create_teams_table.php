<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('tag', 10)->unique();
            $table->string('captain_name', 120);
            $table->string('coach_name', 120)->nullable();
            $table->string('country', 80);
            $table->unsignedSmallInteger('founded_year')->nullable();
            $table->enum('status', ['active', 'inactive', 'disbanded'])->default('active');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
