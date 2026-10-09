# Gaming Tournament Management System (GTMS)

A Laravel-based CRUD system for managing **Players, Teams, Games, Tournaments, and Matches**.

The project uses Laravel 13 conventions, Eloquent relationships, migrations, factories, seeders, Blade views, Bootstrap 5, validation, resource routes, and a dashboard.

## 1. Main Tables

### Players
- `id` — BIGINT UNSIGNED, Primary Key
- `gamer_tag` — VARCHAR(50), unique
- `full_name` — VARCHAR(120)
- `email` — VARCHAR(120), unique
- `birth_date` — DATE, nullable
- `country` — VARCHAR(80)
- `skill_rating` — UNSIGNED INT
- `status` — ENUM
- `bio` — TEXT, nullable
- `created_at`, `updated_at` — TIMESTAMP

### Teams
- `id` — BIGINT UNSIGNED, Primary Key
- `name` — VARCHAR(100), unique
- `tag` — VARCHAR(10), unique
- `captain_name` — VARCHAR(120)
- `coach_name` — VARCHAR(120), nullable
- `country` — VARCHAR(80)
- `founded_year` — UNSIGNED SMALLINT, nullable
- `status` — ENUM
- `description` — TEXT, nullable
- `created_at`, `updated_at` — TIMESTAMP

### Games
- `id` — BIGINT UNSIGNED, Primary Key
- `name` — VARCHAR(100), unique
- `genre` — VARCHAR(60)
- `developer` — VARCHAR(100)
- `publisher` — VARCHAR(100), nullable
- `platform` — VARCHAR(100)
- `max_players` — UNSIGNED INT
- `status` — ENUM
- `description` — TEXT, nullable
- `created_at`, `updated_at` — TIMESTAMP

### Tournaments
- `id` — BIGINT UNSIGNED, Primary Key
- `game_id` — BIGINT UNSIGNED, Foreign Key → `games.id`
- `name` — VARCHAR(150)
- `season` — VARCHAR(50)
- `venue` — VARCHAR(150)
- `start_date` — DATE
- `end_date` — DATE
- `format` — ENUM
- `prize_pool` — DECIMAL(12,2)
- `status` — ENUM
- `description` — TEXT, nullable
- `created_at`, `updated_at` — TIMESTAMP

### Matches
- `id` — BIGINT UNSIGNED, Primary Key
- `tournament_id` — BIGINT UNSIGNED, Foreign Key → `tournaments.id`
- `game_id` — BIGINT UNSIGNED, Foreign Key → `games.id`
- `team_a_id` — BIGINT UNSIGNED, Foreign Key → `teams.id`
- `team_b_id` — BIGINT UNSIGNED, Foreign Key → `teams.id`
- `winner_team_id` — BIGINT UNSIGNED, nullable Foreign Key → `teams.id`
- `round` — VARCHAR(50)
- `scheduled_at` — DATETIME
- `team_a_score` — UNSIGNED INT
- `team_b_score` — UNSIGNED INT
- `status` — ENUM
- `notes` — TEXT, nullable
- `created_at`, `updated_at` — TIMESTAMP

### Pivot: `team_player`
Used for the many-to-many relationship between Players and Teams.

- `team_id` — Foreign Key → `teams.id`
- `player_id` — Foreign Key → `players.id`
- `role` — VARCHAR(50)
- `jersey_number` — UNSIGNED TINYINT, nullable
- `joined_at` — DATE, nullable
- `created_at`, `updated_at` — TIMESTAMP
- Composite Primary Key: `team_id + player_id`

## 2. Relationships / Parent and Child

| Relationship | Parent | Child | Type | Foreign Key |
|---|---|---|---|---|
| Game → Tournament | Game | Tournament | 1:M | `tournaments.game_id` |
| Tournament → Match | Tournament | Match | 1:M | `matches.tournament_id` |
| Game → Match | Game | Match | 1:M | `matches.game_id` |
| Team ↔ Player | Team / Player | Pivot | M:N | `team_player.team_id`, `team_player.player_id` |
| Team → Match as Team A | Team | Match | 1:M | `matches.team_a_id` |
| Team → Match as Team B | Team | Match | 1:M | `matches.team_b_id` |
| Team → Match as Winner | Team | Match | 1:M | `matches.winner_team_id` |

### Simplified ERD

```text
GAMES
  PK id
   │
   ├──────────────< TOURNAMENTS
   │                 PK id
   │                 FK game_id
   │                    │
   │                    └────────< MATCHES >──────── TEAMS
   │                                  │                PK id
   │                                  ├─ FK team_a_id
   │                                  ├─ FK team_b_id
   │                                  └─ FK winner_team_id
   │
   └──────────────< MATCHES

PLAYERS >────────< TEAM_PLAYER >────────< TEAMS
                   PK/FK team_id
                   PK/FK player_id
```

## 3. Laravel Features Included

- Blade UI with Bootstrap 5.3 CDN
- Dashboard with system counts and upcoming matches
- CRUD for Players
- CRUD for Teams
- CRUD for Games
- CRUD for Tournaments
- CRUD for Matches
- Eloquent model relationships
- Many-to-many pivot table for Players ↔ Teams
- Request validation in controllers
- Resource routes
- Route model binding
- Model factories
- Database seeders with realistic sample data
- Pagination
- Flash success/error messages
- Foreign key constraints
- Status fields and score tracking
