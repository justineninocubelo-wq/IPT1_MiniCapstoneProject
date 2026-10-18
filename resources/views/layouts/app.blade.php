<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'GTMS') | Gaming Tournament Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700;800&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/gtms-cards.css') }}">
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
            min-height: 100vh;
            color: var(--text-main);
            font-family: 'Rajdhani', sans-serif;
            background:
                radial-gradient(circle at 20% 20%, rgba(88,101,242,0.12), transparent 35%),
                radial-gradient(circle at 80% 10%, rgba(139,92,246,0.10), transparent 35%),
                var(--bg-dark);
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Orbitron', sans-serif;
        }

        /* GENERAL PAGE */
        .page-wrapper {
            padding: 35px;
        }

        /* NAVBAR FOR NORMAL USERS */
        .gaming-navbar {
            background: rgba(8,11,22,0.92);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--border);
            min-height: 70px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.25);
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
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 0 20px rgba(88,101,242,0.35);
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

        .user-name {
            color: white;
            font-weight: 700;
            margin-right: 12px;
        }

        /* GAMING CARDS */
        .gaming-card {
            background: linear-gradient(145deg, var(--bg-card), var(--bg-card-light));
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
        }

        .gaming-card:hover {
            transform: translateY(-4px);
            border-color: rgba(88,101,242,0.45);
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
        }

        /* HERO */
        .gaming-hero {
            position: relative;
            overflow: hidden;
            min-height: 280px;
            border-radius: 22px;
            padding: 45px;
            display: flex;
            align-items: center;
            background: linear-gradient(120deg, rgba(88,101,242,0.95), rgba(109,40,217,0.9));
            box-shadow: 0 20px 60px rgba(0,0,0,0.35);
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
            background: rgba(0,217,255,0.16);
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
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 10px;
        }

        .hero-subtitle {
            max-width: 650px;
            font-size: 1.15rem;
            color: rgba(255,255,255,0.78);
        }

        /* STAT CARDS */
        .stat-card {
            position: relative;
            padding: 24px;
            border-radius: 16px;
            background: linear-gradient(145deg, #11172b, #171f39);
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
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            font-size: 1.3rem;
            margin-bottom: 18px;
            box-shadow: 0 0 25px rgba(88,101,242,0.2);
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

        /* BUTTONS */
        .btn-gaming {
            border: none;
            color: white;
            font-weight: 700;
            padding: 11px 20px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 8px 20px rgba(88,101,242,0.25);
            transition: 0.25s;
        }

        .btn-gaming:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(88,101,242,0.4);
        }

        /* MATCH CARDS */
        .match-card {
            background: linear-gradient(145deg, #11172b, #151d35);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            transition: 0.25s;
        }

        .match-card:hover {
            transform: translateY(-5px);
            border-color: rgba(88,101,242,0.5);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .match-header {
            padding: 14px 18px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
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

        /* ADMIN SIDEBAR */
        .admin-shell {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 250px;
            flex: 0 0 250px;
            background: #0c1122;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 1030;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            padding: 25px 20px;
            text-decoration: none;
            color: white;
            font-family: 'Orbitron', sans-serif;
            font-weight: 800;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand:hover {
            color: white;
        }

        .sidebar-menu {
            padding: 22px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-caption {
            color: #8190b1;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            padding: 0 13px 12px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            color: #9ba9c7;
            font-weight: 700;
            text-decoration: none;
            border-radius: 11px;
            margin-bottom: 6px;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar-link:hover {
            background: rgba(88,101,242,0.13);
            color: white;
        }

        .sidebar-link.active {
            color: white;
            background: linear-gradient(110deg, #5865f2, #7c3aed);
            box-shadow: 0 5px 18px rgba(88,101,242,0.2);
        }

        .sidebar-icon {
            width: 24px;
            text-align: center;
            font-size: 1.2rem;
        }

        .sidebar-footer {
            padding: 18px;
            border-top: 1px solid var(--border);
        }

        .sidebar-user {
            color: white;
            font-weight: 700;
            overflow-wrap: anywhere;
            margin-bottom: 12px;
        }

        .admin-main {
            flex: 1;
            min-width: 0;
        }

        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 72px;
            padding: 14px 35px;
            border-bottom: 1px solid var(--border);
            background: rgba(8,11,22,0.6);
        }

        .admin-topbar-title {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 1rem;
        }

        .admin-mobile-header {
            display: none;
        }

        .sidebar-backdrop {
            display: none;
        }

        /* LOGOUT CONFIRMATION MODAL */
        .logout-modal .modal-content {
            background: #121a31;
            color: #f5f7ff;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 18px;
            box-shadow: 0 25px 75px rgba(0,0,0,0.55);
        }

        .logout-modal .modal-header,
        .logout-modal .modal-footer {
            border-color: rgba(255,255,255,0.09);
        }

        .logout-modal .btn-cancel {
            background: #5c667a;
            color: white;
            border: none;
        }

        .logout-modal .btn-cancel:hover {
            background: #707b91;
            color: white;
        }

        .logout-modal .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
        }

        .logout-modal .btn-logout:hover {
            background: #bd2332;
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width: 991.98px) {
            .admin-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                transform: translateX(-100%);
                transition: transform 0.25s;
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-mobile-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 15px 20px;
                background: #0c1122;
                border-bottom: 1px solid var(--border);
            }

            .sidebar-backdrop.open {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.65);
                z-index: 1025;
            }

            .admin-topbar {
                padding: 15px 20px;
            }
        }

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

@auth
    @if(auth()->user()->isAdmin())

        <!-- ADMIN LAYOUT -->
        <div class="admin-shell">

            <div
                id="sidebarBackdrop"
                class="sidebar-backdrop"
                onclick="toggleAdminSidebar(false)">
            </div>

            <aside
                id="adminSidebar"
                class="admin-sidebar"
                aria-label="Admin navigation">

                <a class="sidebar-brand" href="{{ route('dashboard') }}">
                    <span class="brand-icon">🎮</span>
                    GTMS
                </a>

                <nav class="sidebar-menu">

                    <div class="sidebar-caption">
                        MANAGEMENT
                    </div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="sidebar-icon">▦</span>
                        Dashboard
                    </a>

                    <a
                        href="{{ route('players.index') }}"
                        class="sidebar-link {{ request()->routeIs('players.*') ? 'active' : '' }}">
                        <span class="sidebar-icon">♟</span>
                        Players
                    </a>

                    <a
                        href="{{ route('teams.index') }}"
                        class="sidebar-link {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                        <span class="sidebar-icon">♜</span>
                        Teams
                    </a>

                    <a
                        href="{{ route('games.index') }}"
                        class="sidebar-link {{ request()->routeIs('games.*') ? 'active' : '' }}">
                        <span class="sidebar-icon">🎮</span>
                        Games
                    </a>

                    <a
                        href="{{ route('tournaments.index') }}"
                        class="sidebar-link {{ request()->routeIs('tournaments.*') ? 'active' : '' }}">
                        <span class="sidebar-icon">🏆</span>
                        Tournaments
                    </a>

                    <a
                        href="{{ route('matches.index') }}"
                        class="sidebar-link {{ request()->routeIs('matches.*') ? 'active' : '' }}">
                        <span class="sidebar-icon">⚔</span>
                        Matches
                    </a>

                </nav>

                <div class="sidebar-footer">

                    <div class="sidebar-user">
                        {{ auth()->user()->name }}
                    </div>

                    <button
                        type="button"
                        class="btn btn-outline-light w-100"
                        data-bs-toggle="modal"
                        data-bs-target="#logoutConfirmModal">
                        Log Out
                    </button>

                </div>

            </aside>

            <div class="admin-main">

                <div class="admin-mobile-header">
                    <button
                        type="button"
                        class="btn btn-outline-light btn-sm"
                        onclick="toggleAdminSidebar(true)">
                        ☰ Menu
                    </button>

                    <strong>GTMS</strong>
                </div>

                <header class="admin-topbar">

                    <span class="admin-topbar-title">
                        Gaming Tournament Management System
                    </span>

                    <span class="text-white-50 d-none d-md-inline">
                        Admin Panel
                    </span>

                </header>

                <main class="page-wrapper">
                    @yield('content')
                </main>

            </div>
        </div>

    @else

        <!-- NORMAL USER LAYOUT -->
        <nav class="navbar navbar-expand-lg gaming-navbar">

            <div class="container-fluid px-4">

                <a
                    class="navbar-brand"
                    href="{{ route('upcoming-matches') }}">

                    <span class="brand-icon">🎮</span>
                    GAMING TOURNAMENT

                </a>

                <div class="ms-auto d-flex align-items-center gap-3">

                    <span class="user-name">
                        {{ auth()->user()->name }}
                    </span>

                    <button
                        type="button"
                        class="btn btn-outline-light btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#logoutConfirmModal">
                        Log Out
                    </button>

                </div>

            </div>
        </nav>

        <main class="page-wrapper">
            @yield('content')
        </main>

    @endif
@endauth

<!-- LOGOUT CONFIRMATION FOR BOTH ACCOUNTS -->
@auth
<div
    class="modal fade logout-modal"
    id="logoutConfirmModal"
    tabindex="-1"
    aria-labelledby="logoutConfirmTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="logoutConfirmTitle">
                    Confirm Logout
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">
                Are you sure you want to log out of your account?
            </div>

            <div class="modal-footer justify-content-end gap-2">

                <button
                    type="button"
                    class="btn btn-cancel"
                    data-bs-dismiss="modal">
                    Cancel
                </button>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="m-0">

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-logout">
                        Log Out
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>
@endauth

@stack('delete-modals')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleAdminSidebar(open) {
        document
            .getElementById('adminSidebar')
            ?.classList.toggle('open', open);

        document
            .getElementById('sidebarBackdrop')
            ?.classList.toggle('open', open);
    }
</script>

@yield('scripts')

</body>
</html>
