<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name', 150);
            $table->string('season', 50);
            $table->string('venue', 150);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('format', ['single_elimination', 'double_elimination', 'round_robin', 'swiss']);
            $table->decimal('prize_pool', 12, 2)->default(0);
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index(['game_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
