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

## 4. Installation

This package is intended to be placed into a fresh Laravel 13 application so the normal Laravel framework/configuration files remain intact.

### Step 1 — Create the Laravel project

```bash
composer create-project laravel/laravel gaming-tournament-management-system
cd gaming-tournament-management-system
```

### Step 2 — Copy this package's application files

Copy these folders/files from this package into the fresh Laravel project and replace existing files when prompted:

```text
app/
bootstrap/app.php
database/
resources/views/
routes/
```

You can also use the included `composer.json` as a reference for the PHP/Laravel version.

### Step 3 — Create the MySQL database

In phpMyAdmin, create:

```text
gaming_tournament
```

### Step 4 — Configure `.env`

```env
APP_NAME="Gaming Tournament Management System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gaming_tournament
DB_USERNAME=root
DB_PASSWORD=
```

### Step 5 — Install dependencies and generate the application key

```bash
composer install
php artisan key:generate
```

### Step 6 — Run migrations and seed sample data

```bash
php artisan migrate:fresh --seed
```

### Step 7 — Start Laravel

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## 5. Useful Artisan Commands

```bash
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed
php artisan route:list
php artisan optimize:clear
php artisan serve
```

## 6. Important Notes

### Why is there a pivot table?

A player can belong to a team, and a team has multiple players. Using `team_player` makes the relationship many-to-many and also lets the system store membership information such as player role, jersey number, and joining date.

### Why does Match have Team A, Team B, and Winner?

A match is between two teams. `team_a_id` and `team_b_id` identify the participants, while `winner_team_id` records the winner after the match is completed.

### Why does Match also have `game_id`?

The tournament already identifies its game through `tournament_id → tournaments.game_id`. The direct `game_id` on Match is included because it is useful for reporting and filtering matches by game. The controller/seed data keeps the values aligned.

## 7. Folder Structure

```text
app/
├── Http/Controllers/
│   ├── DashboardController.php
│   ├── PlayerController.php
│   ├── TeamController.php
│   ├── GameController.php
│   ├── TournamentController.php
│   └── MatchController.php
└── Models/
    ├── Player.php
    ├── Team.php
    ├── Game.php
    ├── Tournament.php
    └── MatchModel.php

database/
├── factories/
├── migrations/
└── seeders/DatabaseSeeder.php

resources/views/
├── layouts/
├── dashboard/
├── players/
├── teams/
├── games/
├── tournaments/
└── matches/

routes/
├── web.php
└── console.php
```
