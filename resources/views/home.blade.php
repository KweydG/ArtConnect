@extends('layouts.app')

@section('title', 'Home')

@section('head')
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Caveat:wght@700&family=Bangers&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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
        background: var(--paper-bg);
        position: relative;
        overflow-x: hidden;
    }

    /* Graffiti Typography */
    .graffiti-title {
        font-family: 'Bangers', cursive;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .doodle-text {
        font-family: 'Permanent Marker', cursive;
    }

    .handwritten {
        font-family: 'Caveat', cursive;
        font-weight: 700;
    }

    /* Hero Section with Street Art Vibe */
    .hero-graffiti {
        background: linear-gradient(135deg, var(--dark-bg) 0%, #16213e 100%);
        position: relative;
        overflow: hidden;
    }

    .hero-graffiti::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background-image: 
            repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.03) 10px, rgba(255,255,255,.03) 20px),
            repeating-linear-gradient(-45deg, transparent, transparent 10px, rgba(255,255,255,.03) 10px, rgba(255,255,255,.03) 20px);
        animation: drift 30s linear infinite;
    }

    @keyframes drift {
        0% { transform: translate(0, 0); }
        100% { transform: translate(-50%, -50%); }
    }

    /* BIGGER HERO TITLE */
    .hero-main-title {
        font-family: 'Bangers', cursive;
        font-size: 96px;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: var(--graffiti-yellow);
        text-shadow: 6px 6px 0px rgba(0,0,0,0.4);
        line-height: 1;
        margin-bottom: 32px;
    }

    /* Spray Paint Effects */
    .spray-circle {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.3;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-20px) scale(1.05); }
    }

    .spray-pink {
        background: var(--graffiti-pink);
        width: 300px;
        height: 300px;
        top: -50px;
        left: -50px;
    }

    .spray-cyan {
        background: var(--graffiti-cyan);
        width: 400px;
        height: 400px;
        top: 50%;
        right: -100px;
        animation-delay: -2s;
    }

    .spray-yellow {
        background: var(--graffiti-yellow);
        width: 250px;
        height: 250px;
        bottom: 0;
        left: 30%;
        animation-delay: -4s;
    }

    /* Doodle Decorations */
    .doodle-star {
        position: absolute;
        animation: rotate-doodle 20s linear infinite;
    }

    @keyframes rotate-doodle {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .doodle-line {
        stroke-dasharray: 1000;
        stroke-dashoffset: 1000;
        animation: draw-line 2s ease-out forwards;
    }

    @keyframes draw-line {
        to { stroke-dashoffset: 0; }
    }

    /* Card with Sketch Effect */
    .sketch-card {
        background: white;
        border: 3px solid #000;
        border-radius: 8px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        position: relative;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .sketch-card::before {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        background: linear-gradient(45deg, var(--graffiti-pink), var(--graffiti-cyan), var(--graffiti-yellow), var(--graffiti-purple));
        border-radius: 8px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .sketch-card:hover {
        transform: translateY(-8px);
        box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.2);
    }

    .sketch-card:hover::before {
        opacity: 0.7;
    }

    /* Graffiti Button */
    .btn-graffiti {
        font-family: 'Permanent Marker', cursive;
        padding: 12px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
    }

    .btn-graffiti::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .btn-graffiti:hover::before {
        left: 100%;
    }

    .btn-graffiti:hover {
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.3);
    }

    .btn-graffiti:active {
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }

    .btn-primary-graffiti {
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
    }

    .btn-secondary-graffiti {
        background: white;
        color: var(--dark-bg);
    }

    /* Category Card */
    .category-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        padding: 24px;
        position: relative;
        transition: all 0.3s;
        cursor: pointer;
    }

    .category-card::after {
        content: '';
        position: absolute;
        top: 8px;
        left: 8px;
        right: -8px;
        bottom: -8px;
        background: var(--graffiti-cyan);
        border-radius: 12px;
        z-index: -1;
        transition: all 0.3s;
    }

    .category-card:hover {
        transform: translate(-4px, -4px);
    }

    .category-card:hover::after {
        top: 12px;
        left: 12px;
    }

    /* Badge Graffiti Style */
    .badge-graffiti {
        font-family: 'Permanent Marker', cursive;
        font-size: 12px;
        padding: 4px 12px;
        border: 2px solid #000;
        border-radius: 20px;
        display: inline-block;
        transform: rotate(-2deg);
    }

    /* Artwork Grid */
    .artwork-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    /* Doodle Background Elements */
    .doodle-bg {
        position: absolute;
        pointer-events: none;
        opacity: 0.1;
    }

    /* Section Title with Underline Doodle */
    .section-title {
        font-family: 'Bangers', cursive;
        font-size: 48px;
        letter-spacing: 2px;
        position: relative;
        display: inline-block;
        text-transform: uppercase;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 100%;
        height: 8px;
        background: var(--graffiti-yellow);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Sticker Effect */
    .sticker {
        position: absolute;
        background: white;
        border: 3px solid #000;
        border-radius: 50%;
        padding: 16px;
        font-family: 'Permanent Marker', cursive;
        transform: rotate(12deg);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
        animation: bob 3s ease-in-out infinite;
    }

    @keyframes bob {
        0%, 100% { transform: rotate(12deg) translateY(0); }
        50% { transform: rotate(8deg) translateY(-10px); }
    }

    /* Tutorial Card */
    .tutorial-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s;
        position: relative;
    }

    .tutorial-card::before {
        content: '★';
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 24px;
        color: var(--graffiti-yellow);
        text-shadow: 2px 2px 0px #000;
        opacity: 0;
        transform: scale(0) rotate(-180deg);
        transition: all 0.3s;
        z-index: 10;
    }

    .tutorial-card:hover::before {
        opacity: 1;
        transform: scale(1) rotate(0deg);
    }

    .tutorial-card:hover {
        transform: rotate(-2deg) scale(1.05);
    }

    /* Artist Card */
    .artist-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        padding: 16px;
        text-align: center;
        transition: all 0.3s;
        position: relative;
    }

    .artist-card::before {
        content: '';
        position: absolute;
        inset: -6px;
        background: linear-gradient(45deg, var(--graffiti-pink), var(--graffiti-purple));
        border-radius: 12px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .artist-card:hover::before {
        opacity: 1;
    }

    .artist-card:hover {
        transform: translateY(-4px);
    }

    /* Tag Cloud Effect */
    .tag-pill {
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
        padding: 8px 16px;
        border: 2px solid #000;
        border-radius: 20px;
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        display: inline-block;
        margin: 4px;
        transform: rotate(-1deg);
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.2);
    }

    /* Arrow Link */
    .arrow-link {
        font-family: 'Permanent Marker', cursive;
        color: var(--dark-bg);
        text-decoration: none;
        position: relative;
        display: inline-block;
        padding-right: 24px;
    }

    .arrow-link::after {
        content: '→';
        position: absolute;
        right: 0;
        transition: right 0.3s;
    }

    .arrow-link:hover::after {
        right: -8px;
    }

    /* Noise Texture Overlay */
    .noise-texture {
        position: relative;
    }

    .noise-texture::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        opacity: 0.03;
        pointer-events: none;
    }

    /* Responsive Grid */
    @media (max-width: 768px) {
        .hero-main-title {
            font-size: 48px;
            letter-spacing: 2px;
        }

        .section-title {
            font-size: 36px;
        }
        
        .artwork-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        .hero-main-title {
            font-size: 72px;
        }
    }

    /* Animation Delays for Staggered Entrance */
    .fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-graffiti text-white py-20 relative noise-texture">
    <!-- Spray Paint Blobs -->
    <div class="spray-circle spray-pink"></div>
    <div class="spray-circle spray-cyan"></div>
    <div class="spray-circle spray-yellow"></div>
    
    <!-- SVG Doodles -->
    <svg class="doodle-star absolute top-20 right-20 w-16 h-16" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
        <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" class="doodle-line" style="stroke: var(--graffiti-yellow)"/>
    </svg>

    <svg class="doodle-star absolute bottom-32 left-10 w-20 h-20" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
        <circle cx="50" cy="50" r="30" class="doodle-line" style="stroke: var(--graffiti-pink); animation-delay: 0.5s"/>
        <circle cx="50" cy="50" r="15" class="doodle-line" style="stroke: var(--graffiti-cyan); animation-delay: 0.8s"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="hero-main-title fade-in-up">
                Welcome to ArtConnect
            </h1>
            <p class="text-xl md:text-2xl mb-8 handwritten fade-in-up delay-1" style="font-size: 32px;">
                A Creative Community for Artists to Share, Learn, and Grow Together
            </p>
            <div class="flex flex-wrap justify-center gap-4 mb-8 fade-in-up delay-2">
                <a href="{{ route('explore') }}" class="btn-graffiti btn-primary-graffiti">
                    Explore Art
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn-graffiti btn-secondary-graffiti">
                        Join Community
                    </a>
                @endguest
            </div>
            <div class="flex flex-wrap justify-center gap-4 text-sm fade-in-up delay-3">
                <span class="tag-pill" style="background: var(--graffiti-green);">SDG 4: Quality Education</span>
                <span class="tag-pill" style="background: var(--graffiti-pink);">SDG 11: Sustainable Cities</span>
            </div>
        </div>
    </div>
</section>

<!-- Featured Artworks -->
<section class="py-16 relative">
    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-0 right-0 w-64 h-64" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
        <path d="M40 120 Q 80 40, 120 120 T 200 120" stroke="var(--graffiti-pink)" stroke-width="4" opacity="0.2"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="section-title" style="color: var(--dark-bg);">Featured Artworks</h2>
            <a href="{{ route('artworks.index') }}" class="arrow-link">View All</a>
        </div>

        <div class="artwork-grid">
            @forelse($featuredArtworks as $artwork)
                <div class="sketch-card overflow-hidden">
                    <a href="{{ route('artworks.show', $artwork) }}">
                        <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h3 class="doodle-text text-lg text-gray-900 mb-2">
                            <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-pink-600">{{ $artwork->title }}</a>
                        </h3>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('artists.show', $artwork->user) }}" class="flex items-center text-sm hover:opacity-70">
                                <img src="{{ $artwork->user->avatar_url }}" alt="" class="w-8 h-8 rounded-full mr-2 border-2 border-black">
                                <span class="handwritten text-base">{{ $artwork->user->name }}</span>
                            </a>
                            <span class="badge-graffiti" style="background: var(--graffiti-yellow);">{{ $artwork->category->name }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="handwritten text-3xl text-gray-600">No artworks yet. Be the first to upload!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-16 relative" style="background: linear-gradient(180deg, var(--paper-bg) 0%, #ffeaa7 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="section-title" style="color: var(--dark-bg);">Browse Categories</h2>
            <a href="{{ route('categories.index') }}" class="arrow-link">View All</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="category-card">
                    <div class="w-16 h-16 mx-auto mb-3 rounded-full flex items-center justify-center" style="background: var(--graffiti-pink); border: 3px solid #000;">
                        <svg class="w-8 h-8" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="doodle-text text-base text-gray-900 mb-1">{{ $category->name }}</h3>
                    <p class="handwritten text-sm text-gray-600">{{ $category->artworks_count }} artworks</p>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Sticker Badge -->
    <div class="sticker" style="top: 10%; right: 5%; background: var(--graffiti-green);">
        <span style="font-size: 20px;">🎨</span>
    </div>
</section>

<!-- Learn Section -->
<section class="py-16 relative noise-texture" style="background: var(--paper-bg);">
    <svg class="doodle-bg absolute bottom-0 left-0 w-96 h-96" viewBox="0 0 400 400" fill="none">
        <circle cx="200" cy="200" r="150" stroke="var(--graffiti-purple)" stroke-width="6" opacity="0.1"/>
        <circle cx="200" cy="200" r="100" stroke="var(--graffiti-orange)" stroke-width="6" opacity="0.1"/>
        <circle cx="200" cy="200" r="50" stroke="var(--graffiti-cyan)" stroke-width="6" opacity="0.1"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="section-title mb-4" style="color: var(--dark-bg);">Learn & Grow</h2>
                <p class="handwritten text-2xl text-gray-700">Explore tutorials from talented artists</p>
            </div>
            <a href="{{ route('tutorials.index') }}" class="arrow-link">View All</a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($featuredTutorials as $tutorial)
                <div class="tutorial-card">
                    @if($tutorial->image)
                        <img src="{{ $tutorial->image_url }}" alt="{{ $tutorial->title }}" class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 flex items-center justify-center" style="background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-pink));">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="badge-graffiti" style="background: var(--graffiti-{{ $tutorial->difficulty_color }});">{{ ucfirst($tutorial->difficulty) }}</span>
                            <span class="text-sm handwritten">⏱️ {{ $tutorial->duration }} min</span>
                        </div>
                        <h3 class="doodle-text text-base text-gray-900 mb-2">
                            <a href="{{ route('tutorials.show', $tutorial) }}" class="hover:text-pink-600">{{ $tutorial->title }}</a>
                        </h3>
                        <p class="handwritten text-sm text-gray-600">by {{ $tutorial->user->name }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="handwritten text-3xl text-gray-600">No tutorials yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Top Artists -->
<section class="py-16 relative" style="background: linear-gradient(180deg, var(--paper-bg) 0%, var(--graffiti-cyan) 100%);">
    <div class="sticker" style="top: 15%; left: 8%; background: var(--graffiti-yellow);">
        <span style="font-size: 20px;">⭐</span>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="section-title" style="color: var(--dark-bg);">Featured Artists</h2>
            <a href="{{ route('artists.index') }}" class="arrow-link">View All</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($topArtists as $artist)
                <a href="{{ route('artists.show', $artist) }}" class="artist-card">
                    <img src="{{ $artist->avatar_url }}" alt="{{ $artist->name }}" class="w-20 h-20 rounded-full mx-auto mb-3 object-cover border-4 border-black">
                    <h3 class="doodle-text text-sm text-gray-900 mb-1">{{ $artist->name }}</h3>
                    <p class="handwritten text-xs text-gray-600">{{ $artist->artworks_count }} artworks</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 relative overflow-hidden" style="background: var(--dark-bg);">
    <div class="spray-circle spray-pink" style="top: -100px; left: 10%;"></div>
    <div class="spray-circle spray-cyan" style="bottom: -100px; right: 10%;"></div>
    
    <div class="max-w-4xl mx-auto text-center px-4 relative z-10">
        <h2 class="graffiti-title text-5xl font-bold mb-6" style="color: var(--graffiti-yellow); text-shadow: 4px 4px 0px rgba(0,0,0,0.5);">
            Ready to Share Your Art?
        </h2>
        <p class="text-2xl handwritten mb-8 text-white">
            Join our creative community and start sharing your artwork with the world.
        </p>
        @guest
            <a href="{{ route('register') }}" class="btn-graffiti btn-primary-graffiti">
                Get Started Free
            </a>
        @else
            <a href="{{ route('artworks.create') }}" class="btn-graffiti btn-primary-graffiti">
                Upload Your Art
            </a>
        @endguest
    </div>

    <!-- Bottom Doodles -->
    <svg class="absolute bottom-0 left-0 w-full h-24" viewBox="0 0 1200 100" fill="none" preserveAspectRatio="none">
        <path d="M0 50 Q 300 0, 600 50 T 1200 50 L 1200 100 L 0 100 Z" fill="var(--graffiti-yellow)" opacity="0.3"/>
        <path d="M0 60 Q 300 20, 600 60 T 1200 60 L 1200 100 L 0 100 Z" fill="var(--graffiti-pink)" opacity="0.2"/>
    </svg>
</section>
@endsection