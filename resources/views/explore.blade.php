@extends('layouts.app')

@section('title', 'Explore')

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

    /* Page Header with Street Art Vibe */
    .explore-header {
        background: linear-gradient(135deg, var(--dark-bg) 0%, #16213e 100%);
        position: relative;
        overflow: hidden;
        padding: 60px 0 80px 0;
    }

    .explore-header::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background-image: 
            repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.03) 10px, rgba(255,255,255,.03) 20px);
        animation: drift 30s linear infinite;
    }

    @keyframes drift {
        0% { transform: translate(0, 0); }
        100% { transform: translate(-50%, -50%); }
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

    /* Sketch Card */
    .sketch-card {
        background: white;
        border: 3px solid #000;
        border-radius: 8px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        position: relative;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        overflow: hidden;
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

    /* Form Input Graffiti Style */
    .graffiti-input {
        padding: 12px 20px;
        border: 3px solid #000;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        background: white;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .graffiti-input:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-cyan);
    }

    .graffiti-input::placeholder {
        color: #999;
        font-weight: 500;
    }

    /* Select Dropdown */
    .graffiti-select {
        padding: 12px 20px;
        border: 3px solid #000;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23000'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 20px;
        padding-right: 40px;
    }

    .graffiti-select:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-purple);
    }

    /* Graffiti Button */
    .btn-graffiti {
        font-family: 'Permanent Marker', cursive;
        padding: 12px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        cursor: pointer;
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

    .btn-search {
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
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

    /* Section Title */
    .section-title {
        font-family: 'Bangers', cursive;
        font-size: 48px;
        letter-spacing: 2px;
        position: relative;
        display: inline-block;
        text-transform: uppercase;
        color: var(--graffiti-yellow);
        text-shadow: 4px 4px 0px rgba(0,0,0,0.3);
    }

    /* Artwork Grid */
    .artwork-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    /* Stats Icons */
    .stat-icon {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        background: var(--paper-bg);
        border: 2px solid #000;
        border-radius: 12px;
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
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

    .empty-state::after {
        content: '🎨';
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 40px;
        opacity: 0.3;
        transform: rotate(15deg);
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border: 3px solid #000;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        margin-bottom: 32px;
    }

    /* Doodles */
    .doodle-bg {
        position: absolute;
        pointer-events: none;
        opacity: 0.1;
    }

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

    /* View Details Overlay */
    .view-overlay {
        font-family: 'Permanent Marker', cursive;
        font-size: 18px;
        text-transform: uppercase;
        letter-spacing: 1px;
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
        .section-title {
            font-size: 36px;
        }
        
        .artwork-grid {
            grid-template-columns: 1fr;
        }

        .filter-section {
            padding: 16px;
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
</style>
@endsection

@section('content')
<!-- Header Section -->
<div class="explore-header relative">
    <!-- Spray Paint Blobs -->
    <div class="spray-circle" style="background: var(--graffiti-pink); width: 300px; height: 300px; top: -50px; left: -50px;"></div>
    <div class="spray-circle" style="background: var(--graffiti-cyan); width: 400px; height: 400px; top: 50%; right: -100px; animation-delay: -2s;"></div>
    <div class="spray-circle" style="background: var(--graffiti-yellow); width: 250px; height: 250px; bottom: 0; left: 30%; animation-delay: -4s;"></div>

    <!-- SVG Doodles -->
    <svg class="doodle-star absolute top-10 right-10 w-16 h-16" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
        <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" class="doodle-line" style="stroke: var(--graffiti-yellow)"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="section-title text-center mb-4">Explore Artworks</h1>
        <p class="text-center handwritten text-white text-2xl">Discover amazing art from talented creators</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-20 left-0 w-64 h-64" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
        <circle cx="100" cy="100" r="50" stroke="var(--graffiti-pink)" stroke-width="4" opacity="0.2"/>
    </svg>

    <!-- Search & Filters -->
    <div class="filter-section fade-in">
        <form method="GET" action="{{ route('explore') }}" class="flex flex-col md:flex-row gap-4">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="🔍 Search artworks..."
                   class="graffiti-input flex-1">

            <select name="category" class="graffiti-select md:w-48">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="sort" class="graffiti-select md:w-48">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>⏰ Latest</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>👁️ Most Viewed</option>
                <option value="most_liked" {{ request('sort') == 'most_liked' ? 'selected' : '' }}>❤️ Most Liked</option>
            </select>

            <button type="submit" class="btn-graffiti btn-search">Search</button>
        </form>
    </div>

    <!-- Results -->
    <div class="artwork-grid fade-in">
        @forelse($artworks as $artwork)
            <div class="sketch-card">
                <a href="{{ route('artworks.show', $artwork) }}" class="block relative group">
                    <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-70 transition-all flex items-center justify-center">
                        <span class="text-white opacity-0 group-hover:opacity-100 transition-all view-overlay">View Details</span>
                    </div>
                </a>
                <div class="p-4">
                    <h3 class="doodle-text text-lg text-gray-900 mb-2">
                        <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-pink-600">{{ $artwork->title }}</a>
                    </h3>
                    <div class="flex items-center justify-between mb-3">
                        <a href="{{ route('artists.show', $artwork->user) }}" class="flex items-center text-sm hover:opacity-70">
                            <img src="{{ $artwork->user->avatar_url }}" alt="" class="w-8 h-8 rounded-full mr-2 border-2 border-black">
                            <span class="handwritten text-base">{{ $artwork->user->name }}</span>
                        </a>
                        <span class="badge-graffiti" style="background: var(--graffiti-yellow);">{{ $artwork->category->name }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="stat-icon">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path>
                            </svg>
                            {{ $artwork->likes_count }}
                        </span>
                        <span class="stat-icon">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $artwork->views }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="empty-state">
                    <svg class="w-24 h-24 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="graffiti-title text-3xl mb-3" style="color: var(--dark-bg);">No Artworks Found</h3>
                    <p class="handwritten text-xl text-gray-600 mb-2">Try adjusting your search or filters</p>
                    <p class="handwritten text-lg text-gray-500">Or be the first to share your art!</p>
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
@endsection