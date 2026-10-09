<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('gamer_tag', 50)->unique();
            $table->string('full_name', 120);
            $table->string('email', 120)->unique();
            $table->date('birth_date')->nullable();
            $table->string('country', 80);
            $table->unsignedInteger('skill_rating')->default(1000);
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active');
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
