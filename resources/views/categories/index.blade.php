@extends('layouts.app')

@section('title', 'Categories')

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

    /* Page Title */
    .page-title {
        font-family: 'Bangers', cursive;
        font-size: 56px;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--dark-bg);
        margin-bottom: 48px;
        position: relative;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 100%;
        height: 8px;
        background: var(--graffiti-orange);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Category Grid */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 32px;
    }

    /* Category Card */
    .category-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        padding: 32px 24px;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        position: relative;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }

    .category-card::after {
        content: '';
        position: absolute;
        top: 8px;
        left: 8px;
        right: -8px;
        bottom: -8px;
        border-radius: 16px;
        z-index: -1;
        transition: all 0.3s;
    }

    /* Different colors for each card */
    .category-card:nth-child(6n+1)::after {
        background: var(--graffiti-pink);
    }
    .category-card:nth-child(6n+2)::after {
        background: var(--graffiti-cyan);
    }
    .category-card:nth-child(6n+3)::after {
        background: var(--graffiti-yellow);
    }
    .category-card:nth-child(6n+4)::after {
        background: var(--graffiti-green);
    }
    .category-card:nth-child(6n+5)::after {
        background: var(--graffiti-purple);
    }
    .category-card:nth-child(6n+6)::after {
        background: var(--graffiti-orange);
    }

    .category-card:hover {
        transform: translate(-6px, -6px) rotate(-2deg);
    }

    .category-card:hover::after {
        top: 12px;
        left: 12px;
    }

    /* Category Icon/Image */
    .category-icon-wrapper {
        width: 100px;
        height: 100px;
        margin: 0 auto 24px;
        position: relative;
    }

    .category-icon {
        width: 100%;
        height: 100%;
        border: 4px solid #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        box-shadow: 5px 5px 0px rgba(0, 0, 0, 0.15);
        transition: all 0.3s;
    }

    .category-card:hover .category-icon {
        transform: rotate(15deg) scale(1.1);
        box-shadow: 7px 7px 0px rgba(0, 0, 0, 0.25);
    }

    /* Icon backgrounds - different colors */
    .category-card:nth-child(6n+1) .category-icon {
        background: var(--graffiti-pink);
    }
    .category-card:nth-child(6n+2) .category-icon {
        background: var(--graffiti-cyan);
    }
    .category-card:nth-child(6n+3) .category-icon {
        background: var(--graffiti-yellow);
    }
    .category-card:nth-child(6n+4) .category-icon {
        background: var(--graffiti-green);
    }
    .category-card:nth-child(6n+5) .category-icon {
        background: var(--graffiti-purple);
    }
    .category-card:nth-child(6n+6) .category-icon {
        background: var(--graffiti-orange);
    }

    .category-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .category-icon svg {
        width: 50px;
        height: 50px;
        stroke: white;
        stroke-width: 2.5;
    }

    /* Category Name */
    .category-name {
        font-family: 'Permanent Marker', cursive;
        font-size: 24px;
        color: var(--dark-bg);
        margin-bottom: 12px;
        transition: color 0.3s;
    }

    .category-card:hover .category-name {
        color: var(--graffiti-pink);
    }

    /* Category Description */
    .category-desc {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 18px;
        color: #666;
        margin-bottom: 20px;
        line-height: 1.4;
        min-height: 50px;
    }

    /* Stats Badge */
    .stats-container {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .stat-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 13px;
        padding: 6px 14px;
        background: var(--paper-bg);
        border: 2px solid #000;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transform: rotate(-1deg);
        box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.1);
    }

    /* Stickers */
    .sticker {
        position: absolute;
        background: white;
        border: 3px solid #000;
        border-radius: 50%;
        padding: 16px;
        font-size: 32px;
        box-shadow: 5px 5px 0px rgba(0, 0, 0, 0.2);
        animation: bob 4s ease-in-out infinite;
    }

    @keyframes bob {
        0%, 100% { transform: rotate(12deg) translateY(0); }
        50% { transform: rotate(-8deg) translateY(-15px); }
    }

    /* Doodles */
    .doodle-bg {
        position: absolute;
        pointer-events: none;
        opacity: 0.1;
    }

    /* Sparkle Effect */
    .category-card::before {
        content: '✨';
        position: absolute;
        top: 16px;
        right: 16px;
        font-size: 24px;
        opacity: 0;
        transform: scale(0) rotate(-180deg);
        transition: all 0.3s;
    }

    .category-card:hover::before {
        opacity: 1;
        transform: scale(1) rotate(0deg);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 40px;
        }

        .categories-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }
    }

    /* Animation */
    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stagger-1 { animation-delay: 0.1s; }
    .stagger-2 { animation-delay: 0.2s; }
    .stagger-3 { animation-delay: 0.3s; }
    .stagger-4 { animation-delay: 0.4s; }
    .stagger-5 { animation-delay: 0.5s; }
    .stagger-6 { animation-delay: 0.6s; }
</style>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 30px; right: 8%; animation-delay: -1s;">
        🎨
    </div>

    <div class="sticker" style="bottom: 100px; left: 5%; animation-delay: -3s;">
        🖌️
    </div>

    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-40 right-10 w-64 h-64" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
        <circle cx="100" cy="50" r="30" stroke="var(--graffiti-pink)" stroke-width="4" opacity="0.2"/>
    </svg>

    <svg class="doodle-bg absolute bottom-32 left-10 w-56 h-56" viewBox="0 0 200 200" fill="none">
        <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" stroke="var(--graffiti-yellow)" stroke-width="4" opacity="0.2"/>
    </svg>

    <!-- Page Title -->
    <div class="text-center mb-12 fade-in">
        <h1 class="page-title">Browse Categories</h1>
        <p class="handwritten text-3xl text-gray-700 mt-4">Explore art by style and medium!</p>
    </div>

    <!-- Categories Grid -->
    <div class="categories-grid">
        @foreach($categories as $index => $category)
            <a href="{{ route('categories.show', $category) }}" class="category-card fade-in stagger-{{ ($index % 6) + 1 }}">
                <div class="category-icon-wrapper">
                    <div class="category-icon">
                        @if($category->image)
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                        @else
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>
                </div>

                <h3 class="category-name">{{ $category->name }}</h3>

                @if($category->description)
                    <p class="category-desc">{{ Str::limit($category->description, 80) }}</p>
                @else
                    <p class="category-desc">Discover amazing {{ strtolower($category->name) }} artworks</p>
                @endif

                <div class="stats-container">
                    <span class="stat-badge">
                        🎨 <strong>{{ $category->artworks_count }}</strong> artworks
                    </span>
                    <span class="stat-badge">
                        📚 <strong>{{ $category->tutorials_count }}</strong> tutorials
                    </span>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Fun Footer Note -->
    <div class="mt-20 text-center fade-in stagger-6">
        <div style="background: white; border: 3px dashed #000; border-radius: 16px; padding: 32px; max-width: 600px; margin: 0 auto;">
            <p class="handwritten text-2xl text-gray-700 mb-2">
                Can't find what you're looking for? 🤔
            </p>
            <p class="handwritten text-xl text-gray-600">
                Check back soon! We're always adding new categories!
            </p>
        </div>
    </div>
</div>
@endsection