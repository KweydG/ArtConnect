<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'ArtConnect') }}</title>

    <!-- Graffiti Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Caveat:wght@700&family=Bangers&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --graffiti-pink: #FF006E;
            --graffiti-yellow: #FFBE0B;
            --graffiti-cyan: #00F5FF;
            --graffiti-orange: #FF6B35;
            --graffiti-purple: #8338EC;
            --graffiti-green: #06FFA5;
            --dark-bg: #1a1a2e;
            --paper-bg: #f5f3ee;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background: var(--paper-bg);
            background-image: 
                radial-gradient(circle at 80% 20%, rgba(255, 190, 11, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(0, 245, 255, 0.08) 0%, transparent 50%);
        }

        /* Sidebar */
        .sidebar { 
            width: 280px; 
            background: var(--dark-bg);
            min-height: 100vh;
            border-right: 6px solid #000;
            box-shadow: 8px 0 16px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            right: -6px;
            width: 6px;
            height: 100%;
            background: linear-gradient(180deg, 
                var(--graffiti-pink) 0%, 
                var(--graffiti-orange) 20%,
                var(--graffiti-yellow) 40%, 
                var(--graffiti-green) 60%,
                var(--graffiti-cyan) 80%, 
                var(--graffiti-purple) 100%
            );
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 3px dashed rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .admin-logo {
            font-family: 'Bangers', cursive;
            font-size: 28px;
            letter-spacing: 2px;
            background: linear-gradient(135deg, var(--graffiti-cyan), var(--graffiti-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            filter: drop-shadow(2px 2px 0px rgba(0, 0, 0, 0.3));
        }

        .admin-badge {
            font-family: 'Permanent Marker', cursive;
            font-size: 10px;
            background: var(--graffiti-yellow);
            color: var(--dark-bg);
            padding: 4px 8px;
            border-radius: 12px;
            border: 2px solid #000;
            margin-left: 8px;
            display: inline-block;
            transform: rotate(-3deg);
        }

        .sidebar-link { 
            display: flex; 
            align-items: center; 
            padding: 14px 20px; 
            color: #94a3b8;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            position: relative;
            text-decoration: none;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 70%;
            background: var(--graffiti-cyan);
            transition: width 0.3s;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--graffiti-cyan);
            transform: translateX(4px);
        }

        .sidebar-link:hover::before {
            width: 5px;
        }

        .sidebar-link.active { 
            background: rgba(0, 245, 255, 0.15);
            color: var(--graffiti-cyan);
            border-left: 5px solid var(--graffiti-cyan);
        }

        .sidebar-link.active::after {
            content: '●';
            position: absolute;
            right: 20px;
            color: var(--graffiti-cyan);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .sidebar-link svg { 
            width: 22px; 
            height: 22px; 
            margin-right: 12px;
            flex-shrink: 0;
        }

        .sidebar-divider {
            margin: 16px 20px;
            border-top: 2px dashed rgba(255, 255, 255, 0.1);
        }

        /* Top Bar */
        .top-bar {
            background: white;
            border-bottom: 4px solid #000;
            padding: 20px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .top-bar::before {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, 
                var(--graffiti-pink) 0%, 
                var(--graffiti-yellow) 25%, 
                var(--graffiti-cyan) 50%, 
                var(--graffiti-purple) 75%, 
                var(--graffiti-green) 100%
            );
        }

        .page-title {
            font-family: 'Bangers', cursive;
            font-size: 32px;
            letter-spacing: 2px;
            color: var(--dark-bg);
            text-transform: uppercase;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-name {
            font-family: 'Permanent Marker', cursive;
            color: var(--dark-bg);
            font-size: 16px;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 3px solid #000;
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
        }

        /* Stat Cards */
        .stat-card { 
            background: white;
            border: 4px solid #000;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.15);
        }

        /* Tables */
        .table { 
            width: 100%; 
            border-collapse: collapse;
            background: white;
            border: 4px solid #000;
            border-radius: 16px;
            overflow: hidden;
        }

        .table th, .table td { 
            padding: 16px 20px;
            text-align: left;
            border-bottom: 2px solid #e5e5e5;
        }

        .table th { 
            background: var(--paper-bg);
            font-family: 'Permanent Marker', cursive;
            font-size: 14px;
            color: var(--dark-bg);
            border-bottom: 3px solid #000;
        }

        .table tr:hover { 
            background: var(--paper-bg);
            transform: translateX(2px);
        }

        .table tr {
            transition: all 0.2s;
        }

        /* Buttons */
        .btn { 
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            border: 3px solid #000;
            font-family: 'Permanent Marker', cursive;
            text-transform: uppercase;
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
            display: inline-block;
            text-decoration: none;
        }

        .btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.3);
        }

        .btn:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
        }

        .btn-primary { background: var(--graffiti-cyan); color: var(--dark-bg); }
        .btn-danger { background: var(--graffiti-pink); color: white; }
        .btn-success { background: var(--graffiti-green); color: var(--dark-bg); }
        .btn-secondary { background: white; color: var(--dark-bg); }
        .btn-sm {
            padding: 6px 14px;
            font-size: 12px;
        }

        /* Forms */
        .form-group { 
            margin-bottom: 20px;
        }

        .form-label { 
            display: block;
            font-family: 'Permanent Marker', cursive;
            color: var(--dark-bg);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input { 
            width: 100%;
            padding: 12px 16px;
            border: 3px solid #000;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .form-input:focus { 
            outline: none;
            border-color: var(--graffiti-purple);
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        }

        /* Badges */
        .badge { 
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            font-family: 'Permanent Marker', cursive;
            border: 2px solid #000;
            display: inline-block;
            transform: rotate(-2deg);
        }

        .badge-admin { background: var(--graffiti-yellow); color: var(--dark-bg); }
        .badge-user { background: var(--graffiti-cyan); color: var(--dark-bg); }

        /* Alerts */
        .alert { 
            padding: 16px 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 3px solid #000;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success { 
            background: var(--graffiti-green);
            color: var(--dark-bg);
        }

        .alert-success::before {
            content: '✓';
            font-size: 24px;
            font-weight: bold;
        }

        .alert-error { 
            background: var(--graffiti-pink);
            color: white;
        }

        .alert-error::before {
            content: '⚠';
            font-size: 24px;
        }

        /* Decorative Elements */
        .spray-dot {
            position: fixed;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #000;
            opacity: 0.3;
            pointer-events: none;
            z-index: 0;
        }

        .dot-1 {
            top: 15%;
            right: 10%;
            background: var(--graffiti-pink);
            animation: float1 8s ease-in-out infinite;
        }

        .dot-2 {
            top: 60%;
            right: 5%;
            background: var(--graffiti-yellow);
            animation: float2 10s ease-in-out infinite;
        }

        .dot-3 {
            top: 40%;
            right: 20%;
            background: var(--graffiti-cyan);
            animation: float3 7s ease-in-out infinite;
        }

        @keyframes float1 {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        @keyframes float2 {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(15px) translateX(-10px); }
        }

        @keyframes float3 {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(180deg); }
        }

        @yield('head')
    </style>
</head>
<body class="flex">
    <!-- Decorative Dots -->
    <div class="spray-dot dot-1"></div>
    <div class="spray-dot dot-2"></div>
    <div class="spray-dot dot-3"></div>

    <!-- Sidebar -->
    <aside class="sidebar fixed left-0 top-0 h-full z-50">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                ArtConnect
                <span class="admin-badge">ADMIN</span>
            </a>
        </div>

        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Users
            </a>

            <a href="{{ route('admin.artworks.index') }}" class="sidebar-link {{ request()->routeIs('admin.artworks.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Artworks
            </a>

            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Categories
            </a>

            <a href="{{ route('admin.tutorials.index') }}" class="sidebar-link {{ request()->routeIs('admin.tutorials.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Tutorials
            </a>

            <hr class="sidebar-divider">

            <a href="{{ route('home') }}" class="sidebar-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                View Site
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left border-0 bg-transparent">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-[280px] flex-1 min-h-screen" style="position: relative; z-index: 1;">
        <!-- Top Bar -->
        <header class="top-bar">
            <h1 class="page-title">@yield('title', 'Dashboard')</h1>
            <div class="user-info">
                <span class="user-name">{{ auth()->user()->name }}</span>
                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="user-avatar">
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>