<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('player_team', function (Blueprint $table) {
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->string('role', 50)->default('player');
            $table->unsignedTinyInteger('jersey_number')->nullable();
            $table->date('joined_at')->nullable();
            $table->timestamps();
            $table->primary(['team_id', 'player_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_player');
    }
};
