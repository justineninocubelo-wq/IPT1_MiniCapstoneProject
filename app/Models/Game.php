<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre',
        'developer',
        'publisher',
        'platform',
        'max_players',
        'status',
        'description',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'max_players' => 'integer',
        ];
    }

    public function tournaments(): HasMany
    {
        return $this->hasMany(Tournament::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(MatchModel::class);
    }
}