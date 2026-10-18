<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'gamer_tag',
        'full_name',
        'email',
        'birth_date',
        'country',
        'skill_rating',
        'status',
        'bio',
        'profile_image',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'skill_rating' => 'integer',
        ];
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->withPivot([
                'role',
                'jersey_number',
                'joined_at',
            ])
            ->withTimestamps();
    }
}
