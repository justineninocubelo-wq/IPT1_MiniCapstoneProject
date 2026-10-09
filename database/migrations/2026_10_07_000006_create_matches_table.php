<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('tournaments')->cascadeOnDelete();
            $table->foreignId('game_id')->constrained('games')->restrictOnDelete();
            $table->foreignId('team_a_id')->constrained('teams')->restrictOnDelete();
            $table->foreignId('team_b_id')->constrained('teams')->restrictOnDelete();
            $table->foreignId('winner_team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->string('round', 50);
            $table->dateTime('scheduled_at');
            $table->unsignedInteger('team_a_score')->default(0);
            $table->unsignedInteger('team_b_score')->default(0);
            $table->enum('status', ['scheduled', 'live', 'completed', 'postponed', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['tournament_id', 'scheduled_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
