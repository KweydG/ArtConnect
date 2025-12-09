<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ArtConnect') }} - @yield('title', 'Creative Community')</title>

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
                radial-gradient(circle at 20% 80%, rgba(255, 190, 11, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 245, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 0, 110, 0.05) 0%, transparent 50%);
        }

        /* Navigation Bar */
        .navbar {
            background: white;
            border-bottom: 4px solid #000;
            box-shadow: 0 8px 0px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-text {
            font-family: 'Bangers', cursive;
            font-size: 28px;
            letter-spacing: 2px;
            color: var(--dark-bg);
            text-transform: uppercase;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--graffiti-pink), var(--graffiti-purple));
            border: 3px solid #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Custom spacing for navigation */
        .nav-spacer {
            margin-left: 6rem; /* 96px spacing between logo and nav */
        }

        .nav-link {
            font-family: 'Permanent Marker', cursive;
            color: #64748b;
            font-size: 15px;
            transition: all 0.3s;
            position: relative;
            padding: 8px 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--graffiti-pink);
            transition: width 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--graffiti-pink);
        }

        .nav-link.active::after {
            width: 100%;
        }

        /* Buttons */
        .btn-primary {
            font-family: 'Permanent Marker', cursive;
            background: var(--graffiti-pink);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s;
            border: 3px solid #000;
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            font-family: 'Permanent Marker', cursive;
            background: white;
            color: var(--dark-bg);
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s;
            border: 3px solid #000;
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .btn-secondary:hover {
            background: var(--graffiti-cyan);
            transform: translateY(-2px);
            box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
        }

        /* User Dropdown */
        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #000;
            box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .avatar:hover {
            transform: rotate(-5deg) scale(1.05);
        }

        .dropdown-menu {
            background: white;
            border: 3px solid #000;
            border-radius: 12px;
            box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .dropdown-item {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 12px 16px;
            transition: all 0.2s;
            display: block;
            color: #334155;
        }

        .dropdown-item:hover {
            background: var(--graffiti-yellow);
            transform: translateX(4px);
        }

        .dropdown-item.admin {
            color: var(--graffiti-purple);
            font-family: 'Permanent Marker', cursive;
        }

        .dropdown-item.logout {
            color: var(--graffiti-pink);
        }

        /* Cards */
        .card {
            background: white;
            border: 3px solid #000;
            border-radius: 8px;
            box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.15);
        }

        /* Flash Messages */
        .alert {
            padding: 16px 24px;
            border-radius: 12px;
            margin-bottom: 16px;
            border: 3px solid #000;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: var(--graffiti-green);
            color: var(--dark-bg);
        }

        .alert-error {
            background: var(--graffiti-pink);
            color: white;
        }

        .alert::before {
            content: '✓';
            font-size: 24px;
            margin-right: 12px;
            font-weight: bold;
        }

        .alert-error::before {
            content: '⚠';
        }

        /* Badges */
        .badge {
            font-family: 'Permanent Marker', cursive;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            border: 2px solid #000;
            display: inline-block;
            transform: rotate(-1deg);
        }

        .badge-primary { background: var(--graffiti-cyan); color: var(--dark-bg); }
        .badge-green { background: var(--graffiti-green); color: var(--dark-bg); }
        .badge-yellow { background: var(--graffiti-yellow); color: var(--dark-bg); }
        .badge-red { background: var(--graffiti-pink); color: white; }

        /* Form Inputs */
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

        /* Footer */
        footer {
            background: var(--dark-bg);
            border-top: 4px solid #000;
            margin-top: 80px;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: -4px;
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

        .footer-title {
            font-family: 'Bangers', cursive;
            font-size: 24px;
            letter-spacing: 2px;
            color: white;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .footer-heading {
            font-family: 'Permanent Marker', cursive;
            color: var(--graffiti-yellow);
            font-size: 16px;
            margin-bottom: 16px;
        }

        .footer-link {
            color: #94a3b8;
            transition: all 0.2s;
            display: block;
            padding: 4px 0;
        }

        .footer-link:hover {
            color: var(--graffiti-cyan);
            transform: translateX(4px);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-btn {
            display: none;
            background: var(--graffiti-yellow);
            border: 3px solid #000;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .desktop-nav {
                display: none;
            }

            .logo-text {
                font-size: 24px;
            }

            .nav-spacer {
                margin-left: 2rem; /* Reduced spacing on mobile */
            }
        }

        /* Artwork Grid */
        .artwork-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        /* Decorative Elements */
        .spray-blob {
            position: fixed;
            pointer-events: none;
            opacity: 0.03;
            z-index: 0;
        }

        .spray-blob-1 {
            top: 10%;
            left: 5%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--graffiti-pink) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        .spray-blob-2 {
            bottom: 10%;
            right: 5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, var(--graffiti-cyan) 0%, transparent 70%);
            animation: float 25s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }
    </style>

    @yield('head')
    @stack('styles')
</head>
<body>
    <!-- Decorative Spray Blobs -->
    <div class="spray-blob spray-blob-1"></div>
    <div class="spray-blob spray-blob-2"></div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="logo-icon">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <span class="logo-text">ArtConnect</span>
                    </a>

                    <!-- Desktop Navigation - MAXIMUM SPACING VERSION -->
                    <div class="hidden md:flex gap-8 desktop-nav nav-spacer">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('explore') }}" class="nav-link {{ request()->routeIs('explore') ? 'active' : '' }}">Explore</a>
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a>
                        <a href="{{ route('tutorials.index') }}" class="nav-link {{ request()->routeIs('tutorials.*') ? 'active' : '' }}">Learn</a>
                        <a href="{{ route('artists.index') }}" class="nav-link {{ request()->routeIs('artists.*') ? 'active' : '' }}">Artists</a>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('artworks.create') }}" class="btn-primary text-sm hidden sm:inline-block">
                            + Upload
                        </a>

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2">
                                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="avatar">
                                <span class="hidden md:inline font-semibold" style="font-family: 'Permanent Marker', cursive; color: var(--dark-bg);">{{ Str::limit(auth()->user()->name, 12) }}</span>
                            </button>

                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 class="absolute right-0 mt-3 w-56 dropdown-menu"
                                 style="display: none;">
                                <a href="{{ route('artists.show', auth()->user()) }}" class="dropdown-item">👤 My Profile</a>
                                <a href="{{ route('collections.index') }}" class="dropdown-item">📁 My Collections</a>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">⚙️ Settings</a>
                                @if(auth()->user()->isAdmin())
                                    <hr style="border-color: #000; margin: 8px 0;">
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item admin">⭐ Admin Panel</a>
                                @endif
                                <hr style="border-color: #000; margin: 8px 0;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout w-full text-left">🚪 Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary text-sm">Join Free</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main style="position: relative; z-index: 1;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- About -->
                <div>
                    <h3 class="footer-title">ArtConnect</h3>
                    <p class="text-gray-400 leading-relaxed mb-4">
                        A creative community platform for artists to share, learn, and grow together. 🎨
                    </p>
                    <div class="flex gap-2">
                        <span class="badge badge-green" style="transform: rotate(-3deg);">SDG 4</span>
                        <span class="badge badge-yellow" style="transform: rotate(2deg);">SDG 11</span>
                    </div>
                </div>

                <!-- Explore -->
                <div>
                    <h4 class="footer-heading">Explore</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('artworks.index') }}" class="footer-link">→ Artworks</a></li>
                        <li><a href="{{ route('categories.index') }}" class="footer-link">→ Categories</a></li>
                        <li><a href="{{ route('artists.index') }}" class="footer-link">→ Artists</a></li>
                        <li><a href="{{ route('explore') }}" class="footer-link">→ Discover</a></li>
                    </ul>
                </div>

                <!-- Learn -->
                <div>
                    <h4 class="footer-heading">Learn</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('tutorials.index') }}" class="footer-link">→ All Tutorials</a></li>
                        <li><a href="{{ route('tutorials.index', ['difficulty' => 'beginner']) }}" class="footer-link">→ Beginner</a></li>
                        <li><a href="{{ route('tutorials.index', ['difficulty' => 'intermediate']) }}" class="footer-link">→ Intermediate</a></li>
                        <li><a href="{{ route('tutorials.index', ['difficulty' => 'advanced']) }}" class="footer-link">→ Advanced</a></li>
                    </ul>
                </div>

                <!-- Community -->
                <div>
                    <h4 class="footer-heading">Community</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="footer-link">→ About Us</a></li>
                        <li><a href="#" class="footer-link">→ Contact</a></li>
                        <li><a href="#" class="footer-link">→ Guidelines</a></li>
                        <li><a href="#" class="footer-link">→ Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-500" style="font-family: 'Caveat', cursive; font-size: 18px; font-weight: 700;">
                    © {{ date('Y') }} ArtConnect - Group 10 Finals Project. Made with ❤️ & 🎨
                </p>
            </div>
        </div>
    </footer>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('scripts')
</body>
</html>