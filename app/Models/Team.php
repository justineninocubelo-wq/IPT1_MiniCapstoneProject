<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'tag', 'captain_name', 'coach_name', 'country', 'founded_year', 'status', 'description',
    ];

    protected function casts(): array
    {
        return ['founded_year' => 'integer'];
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)->withPivot(['role', 'jersey_number', 'joined_at'])->withTimestamps();
    }

    public function matchesAsTeamA(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'team_a_id');
    }

    public function matchesAsTeamB(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'team_b_id');
    }

    public function wonMatches(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'winner_team_id');
    }
}
