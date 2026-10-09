<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Upcoming Matches | Gaming Tournament</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #0b1020;
            color: #fff;
            min-height: 100vh;
        }

        .navbar {
            background: #11172a;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .brand {
            font-weight: 800;
            letter-spacing: 1px;
        }

        .match-card {
            background: #151c32;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            transition: 0.25s;
            overflow: hidden;
        }

        .match-card:hover {
            transform: translateY(-5px);
            border-color: #6f42c1;
            box-shadow: 0 15px 35px rgba(0,0,0,0.35);
        }

        .match-header {
            background: linear-gradient(135deg, #6f42c1, #0d6efd);
            padding: 14px 18px;
        }

        .team-name {
            font-size: 1.25rem;
            font-weight: 800;
        }

        .vs {
            font-size: 0.9rem;
            font-weight: 700;
            color: #aaa;
        }

        .info-label {
            font-size: 0.75rem;
            color: #8f98ad;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .info-value {
            font-weight: 600;
        }

        .view-btn {
            background: linear-gradient(135deg, #6f42c1, #0d6efd);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
        }

        .view-btn:hover {
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <span class="navbar-brand brand">
            🎮 GAMING TOURNAMENT
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="btn btn-outline-light btn-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="container py-5">

    <div class="mb-5">
        <h1 class="fw-bold">Upcoming Matches</h1>

        <p class="text-secondary">
            View upcoming tournament matches and their details.
        </p>
    </div>

    @if ($matches->count())

        <div class="row g-4">

            @foreach ($matches as $match)

                <div class="col-lg-6">

                    <div class="match-card h-100">

                        <div class="match-header">
                            <div class="d-flex justify-content-between align-items-center">

                                <strong>
                                    {{ $match->tournament->name ?? 'Tournament' }}
                                </strong>

                                <span class="badge bg-light text-dark">
                                    UPCOMING
                                </span>

                            </div>
                        </div>

                        <div class="p-4">

                            <div class="text-center mb-4">

                                <div class="team-name">
                                    {{ $match->teamA->name ?? 'Team A' }}
                                </div>

                                <div class="vs my-2">
                                    VS
                                </div>

                                <div class="team-name">
                                    {{ $match->teamB->name ?? 'Team B' }}
                                </div>

                            </div>

                            <div class="row g-3">

                                <div class="col-6">
                                    <div class="info-label">
                                        Game
                                    </div>

                                    <div class="info-value">
                                        {{ $match->game->name ?? 'N/A' }}
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="info-label">
                                        Round
                                    </div>

                                    <div class="info-value">
                                        {{ $match->round ?? 'N/A' }}
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="info-label">
                                        Date
                                    </div>

                                    <div class="info-value">
                                        {{ $match->scheduled_at ? $match->scheduled_at->format('M d, Y') : 'TBA' }}
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="info-label">
                                        Time
                                    </div>

                                    <div class="info-value">
                                        {{ $match->scheduled_at ? $match->scheduled_at->format('h:i A') : 'TBA' }}
                                    </div>
                                </div>

                            </div>

                            <div class="mt-4">

                                <a
                                    href="{{ route('matches.show', $match) }}"
                                    class="btn view-btn w-100 py-2"
                                >
                                    View Match Details
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="text-center py-5">

            <div class="display-1 mb-3">
                🎮
            </div>

            <h3>No Upcoming Matches</h3>

            <p class="text-secondary">
                There are currently no scheduled upcoming matches.
            </p>

        </div>

    @endif

</div>

</body>
</html>