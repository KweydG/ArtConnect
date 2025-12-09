@extends('layouts.app')

@section('title', $category->name)

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

    /* Category Header Card */
    .header-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-bottom: 48px;
        position: relative;
    }

    .header-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-orange), var(--graffiti-yellow), var(--graffiti-pink));
        border-radius: 16px;
        z-index: -1;
        opacity: 0.4;
    }

    /* Category Icon */
    .category-icon {
        width: 120px;
        height: 120px;
        border: 4px solid #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--graffiti-orange);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        flex-shrink: 0;
    }

    .category-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .category-icon svg {
        width: 60px;
        height: 60px;
        stroke: white;
        stroke-width: 2.5;
    }

    /* Category Title */
    .category-main-title {
        font-family: 'Bangers', cursive;
        font-size: 48px;
        line-height: 1.2;
        color: var(--dark-bg);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
        position: relative;
        display: inline-block;
    }

    .category-main-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 0;
        width: 100%;
        height: 6px;
        background: var(--graffiti-orange);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Stats Badges */
    .stat-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        padding: 8px 16px;
        background: var(--paper-bg);
        border: 2px solid #000;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transform: rotate(-1deg);
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
    }

    /* Section Title */
    .section-title {
        font-family: 'Bangers', cursive;
        font-size: 40px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--dark-bg);
        margin-bottom: 32px;
        position: relative;
        display: inline-block;
    }

    .section-title::before {
        content: '★';
        position: absolute;
        left: -36px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 28px;
        color: var(--graffiti-yellow);
    }

    /* Tutorial Card */
    .tutorial-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
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
        transform: translateY(-8px) rotate(-1deg);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.15);
    }

    /* Badge Graffiti Style */
    .badge-graffiti {
        font-family: 'Permanent Marker', cursive;
        font-size: 12px;
        padding: 6px 14px;
        border: 2px solid #000;
        border-radius: 20px;
        display: inline-block;
        transform: rotate(-2deg);
        font-weight: bold;
    }

    .badge-beginner {
        background: var(--graffiti-green);
        color: var(--dark-bg);
    }

    .badge-intermediate {
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
    }

    .badge-advanced {
        background: var(--graffiti-orange);
        color: white;
    }

    /* Artwork Card */
    .artwork-card {
        background: white;
        border: 3px solid #000;
        border-radius: 8px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        position: relative;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        overflow: hidden;
    }

    .artwork-card::before {
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

    .artwork-card:hover {
        transform: translateY(-8px);
        box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.2);
    }

    .artwork-card:hover::before {
        opacity: 0.7;
    }

    /* Grid Layouts */
    .artwork-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
    }

    /* Empty State */
    .empty-state {
        background: white;
        border: 4px dashed #000;
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        position: relative;
    }

    .empty-state::before {
        content: '🎨';
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 50px;
        opacity: 0.15;
        transform: rotate(15deg);
    }

    .empty-title {
        font-family: 'Bangers', cursive;
        font-size: 36px;
        color: var(--dark-bg);
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    /* Stickers */
    .sticker {
        position: absolute;
        background: white;
        border: 3px solid #000;
        border-radius: 50%;
        padding: 12px;
        font-size: 28px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
        animation: bob 3s ease-in-out infinite;
    }

    @keyframes bob {
        0%, 100% { transform: rotate(12deg) translateY(0); }
        50% { transform: rotate(8deg) translateY(-10px); }
    }

    /* Doodles */
    .doodle-bg {
        position: absolute;
        pointer-events: none;
        opacity: 0.1;
    }

    /* Pagination */
    .pagination {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin-top: 40px;
    }

    .pagination a,
    .pagination span {
        padding: 8px 16px;
        border: 3px solid #000;
        border-radius: 8px;
        font-family: 'Permanent Marker', cursive;
        background: white;
        color: var(--dark-bg);
        text-decoration: none;
        transition: all 0.3s;
    }

    .pagination a:hover {
        background: var(--graffiti-cyan);
        transform: translateY(-2px);
    }

    .pagination .active {
        background: var(--graffiti-yellow);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .category-main-title {
            font-size: 36px;
        }

        .section-title {
            font-size: 32px;
        }

        .header-card {
            padding: 24px;
        }

        .artwork-grid,
        .tutorial-grid {
            grid-template-columns: 1fr;
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

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
</style>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 20px; right: 5%; animation-delay: -1s;">
        🎨
    </div>

    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-32 left-10 w-56 h-56" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-orange)" stroke-width="4" opacity="0.2"/>
        <circle cx="100" cy="50" r="25" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
    </svg>

    <!-- Category Header -->
    <div class="header-card fade-in">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            <div class="category-icon">
                @if($category->image)
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                @else
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                @endif
            </div>
            
            <div class="flex-1 text-center md:text-left">
                <h1 class="category-main-title mb-6">{{ $category->name }}</h1>
                
                @if($category->description)
                    <p class="handwritten text-2xl text-gray-700 mb-6 leading-relaxed">{{ $category->description }}</p>
                @else
                    <p class="handwritten text-2xl text-gray-600 italic mb-6">Explore amazing {{ strtolower($category->name) }} artworks and tutorials!</p>
                @endif
                
                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                    <span class="stat-badge">
                        🎨 <strong>{{ $artworks->total() }}</strong> artworks
                    </span>
                    <span class="stat-badge">
                        📚 <strong>{{ $tutorials->count() }}</strong> tutorials
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tutorials Section -->
    @if($tutorials->count() > 0)
        <div class="mb-16 fade-in delay-1">
            <h2 class="section-title">Learn {{ $category->name }}</h2>
            
            <div class="tutorial-grid">
                @foreach($tutorials as $tutorial)
                    <div class="tutorial-card">
                        <div class="w-full h-40 flex items-center justify-center" style="background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-pink));">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="p-4">
                            <span class="badge-graffiti badge-{{ $tutorial->difficulty }} mb-3">{{ ucfirst($tutorial->difficulty) }}</span>
                            <h3 class="doodle-text text-base text-gray-900 mb-2">
                                <a href="{{ route('tutorials.show', $tutorial) }}" class="hover:text-pink-600">{{ $tutorial->title }}</a>
                            </h3>
                            <p class="handwritten text-base text-gray-600">by {{ $tutorial->user->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Artworks Section -->
    <div class="fade-in delay-2">
        <h2 class="section-title">Artworks in {{ $category->name }}</h2>
        
        <div class="artwork-grid">
            @forelse($artworks as $artwork)
                <div class="artwork-card">
                    <a href="{{ route('artworks.show', $artwork) }}">
                        <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h3 class="doodle-text text-lg text-gray-900 mb-1">
                            <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-pink-600">{{ $artwork->title }}</a>
                        </h3>
                        <a href="{{ route('artists.show', $artwork->user) }}" class="handwritten text-base text-gray-600 hover:text-pink-600">
                            by {{ $artwork->user->name }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="empty-state">
                        <svg class="w-24 h-24 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="empty-title">No Artworks Yet</h3>
                        <p class="handwritten text-2xl text-gray-600 mb-2">Be the first to share {{ strtolower($category->name) }} art!</p>
                        <p class="handwritten text-xl text-gray-500">Upload your masterpiece today!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($artworks->hasPages())
            <div class="pagination">
                {{ $artworks->links() }}
            </div>
        @endif
    </div>
</div>
@endsection