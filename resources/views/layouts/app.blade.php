<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'GTMS') | Gaming Tournament Management System
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700;800&family=Rajdhani:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>

        :root {
            --bg-dark: #080b16;
            --bg-card: #10162a;
            --bg-card-light: #151d35;

            --primary: #5865f2;
            --primary-dark: #404bd4;

            --secondary: #8b5cf6;
            --accent: #00d9ff;

            --text-main: #f5f7ff;
            --text-muted: #8f9bb8;

            --border: rgba(255,255,255,0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background:
                radial-gradient(
                    circle at 20% 20%,
                    rgba(88,101,242,0.12),
                    transparent 35%
                ),
                radial-gradient(
                    circle at 80% 10%,
                    rgba(139,92,246,0.10),
                    transparent 35%
                ),
                var(--bg-dark);

            color: var(--text-main);

            font-family: 'Rajdhani', sans-serif;

            min-height: 100vh;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .navbar-brand {
            font-family: 'Orbitron', sans-serif;
        }

        /* ================================
           NAVBAR
        ================================= */

        .gaming-navbar {
            background: rgba(8, 11, 22, 0.92);
            backdrop-filter: blur(15px);

            border-bottom: 1px solid var(--border);

            min-height: 70px;

            box-shadow:
                0 10px 40px rgba(0,0,0,0.25);
        }

        .navbar-brand {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: 1px;

            color: white !important;
        }

        .brand-icon {
            display: inline-flex;

            width: 38px;
            height: 38px;

            align-items: center;
            justify-content: center;

            margin-right: 8px;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--secondary)
                );

            box-shadow:
                0 0 20px rgba(88,101,242,0.35);
        }

        .gaming-navbar .nav-link {
            color: var(--text-muted);

            font-weight: 600;

            padding: 10px 14px !important;

            transition: 0.25s ease;
        }

        .gaming-navbar .nav-link:hover {
            color: white;

            background: rgba(255,255,255,0.05);

            border-radius: 8px;
        }

        /* ================================
           PAGE
        ================================= */

        .page-wrapper {
            padding: 35px;
        }

        /* ================================
           GAMING CARDS
        ================================= */

        .gaming-card {
            background:
                linear-gradient(
                    145deg,
                    var(--bg-card),
                    var(--bg-card-light)
                );

            border: 1px solid var(--border);

            border-radius: 18px;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.25);

            overflow: hidden;

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease;
        }

        .gaming-card:hover {
            transform: translateY(-4px);

            border-color:
                rgba(88,101,242,0.45);

            box-shadow:
                0 20px 50px rgba(0,0,0,0.35),
                0 0 25px rgba(88,101,242,0.08);
        }

        /* ================================
           HERO
        ================================= */

        .gaming-hero {

            position: relative;

            overflow: hidden;

            min-height: 280px;

            border-radius: 22px;

            padding: 45px;

            display: flex;

            align-items: center;

            background:
                linear-gradient(
                    120deg,
                    rgba(88,101,242,0.95),
                    rgba(109,40,217,0.9)
                );

            box-shadow:
                0 20px 60px rgba(0,0,0,0.35);

            margin-bottom: 35px;
        }

        .gaming-hero::before {

            content: "";

            position: absolute;

            width: 500px;
            height: 500px;

            right: -180px;
            top: -220px;

            border-radius: 50%;

            background:
                rgba(0,217,255,0.16);

            filter: blur(2px);
        }

        .gaming-hero::after {

            content: "🎮";

            position: absolute;

            right: 60px;
            bottom: 20px;

            font-size: 150px;

            opacity: 0.12;

            transform: rotate(-10deg);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-label {

            text-transform: uppercase;

            letter-spacing: 4px;

            font-size: 0.75rem;

            font-weight: 700;

            opacity: 0.75;

            margin-bottom: 10px;
        }

        .hero-title {

            font-size: clamp(
                2rem,
                4vw,
                3.5rem
            );

            font-weight: 800;

            margin-bottom: 10px;
        }

        .hero-subtitle {

            max-width: 650px;

            font-size: 1.15rem;

            color: rgba(255,255,255,0.78);
        }

        /* ================================
           STAT CARDS
        ================================= */

        .stat-card {

            position: relative;

            padding: 24px;

            border-radius: 16px;

            background:
                linear-gradient(
                    145deg,
                    #11172b,
                    #171f39
                );

            border: 1px solid var(--border);

            overflow: hidden;

            transition: 0.25s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-icon {

            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--secondary)
                );

            font-size: 1.3rem;

            margin-bottom: 18px;

            box-shadow:
                0 0 25px rgba(88,101,242,0.2);
        }

        .stat-label {

            color: var(--text-muted);

            font-size: 0.9rem;

            text-transform: uppercase;

            letter-spacing: 1px;

            font-weight: 700;
        }

        .stat-value {

            font-family: 'Orbitron', sans-serif;

            font-size: 2rem;

            font-weight: 800;

            margin-top: 4px;
        }

        /* ================================
           BUTTONS
        ================================= */

        .btn-gaming {

            border: none;

            color: white;

            font-weight: 700;

            padding: 11px 20px;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--secondary)
                );

            box-shadow:
                0 8px 20px rgba(88,101,242,0.25);

            transition: 0.25s;
        }

        .btn-gaming:hover {

            color: white;

            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(88,101,242,0.4);
        }

        /* ================================
           MATCH CARDS
        ================================= */

        .match-card {

            background:
                linear-gradient(
                    145deg,
                    #11172b,
                    #151d35
                );

            border: 1px solid var(--border);

            border-radius: 18px;

            overflow: hidden;

            transition: 0.25s;
        }

        .match-card:hover {

            transform: translateY(-5px);

            border-color:
                rgba(88,101,242,0.5);

            box-shadow:
                0 15px 40px rgba(0,0,0,0.3);
        }

        .match-header {

            padding: 14px 18px;

            background:
                linear-gradient(
                    90deg,
                    var(--primary),
                    var(--secondary)
                );

            display: flex;

            justify-content: space-between;

            align-items: center;
        }

        .match-body {
            padding: 25px;
        }

        .team-name {

            font-family: 'Orbitron', sans-serif;

            font-size: 1.1rem;

            font-weight: 700;
        }

        .vs {

            color: var(--text-muted);

            font-family: 'Orbitron', sans-serif;

            font-weight: 800;
        }

        .match-info {

            color: var(--text-muted);

            font-size: 0.9rem;
        }

        /* ================================
           BADGES
        ================================= */

        .gaming-badge {

            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 0.7rem;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 1px;

            background: rgba(0,217,255,0.12);

            color: var(--accent);

            border: 1px solid rgba(0,217,255,0.2);
        }

        /* ================================
           USER AREA
        ================================= */

        .user-name {

            color: #ffffff;

            font-weight: 700;

            margin-right: 12px;
        }

        /* ================================
           MOBILE
        ================================= */

        @media (max-width: 768px) {

            .page-wrapper {
                padding: 20px;
            }

            .gaming-hero {
                padding: 30px;
                min-height: 240px;
            }

            .gaming-hero::after {
                font-size: 100px;
            }

            .user-name {
                display: none;
            }
        }

    </style>

    @yield('styles')

</head>

<body>

<nav class="navbar navbar-expand-lg gaming-navbar">

    <div class="container-fluid px-4">

        <a
            class="navbar-brand"
            href="{{ auth()->check() && auth()->user()->isAdmin()
                ? route('dashboard')
                : route('upcoming-matches') }}"
        >

            <span class="brand-icon">🎮</span>

            GTMS

        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#gamingNavigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="gamingNavigation"
        >

            @auth

                @if(auth()->user()->isAdmin())

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('dashboard') }}"
                            >
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('players.index') }}"
                            >
                                Players
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('teams.index') }}"
                            >
                                Teams
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('games.index') }}"
                            >
                                Games
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('tournaments.index') }}"
                            >
                                Tournaments
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('matches.index') }}"
                            >
                                Matches
                            </a>
                        </li>

                    </ul>

                @else

                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="{{ route('upcoming-matches') }}"
                            >
                                Upcoming Matches
                            </a>

                        </li>

                    </ul>

                @endif

                <div class="d-flex align-items-center">

                    <span class="user-name">
                        {{ auth()->user()->name }}
                    </span>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-light btn-sm"
                        >
                            Logout
                        </button>

                    </form>

                </div>

            @endauth

        </div>

    </div>

</nav>


<main class="page-wrapper">

    @yield('content')

</main>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

@yield('scripts')

</body>

</html>