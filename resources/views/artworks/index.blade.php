@extends('layouts.app')

@section('title', 'Artworks')

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
        background: var(--graffiti-pink);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Filter Section */
    .filter-bar {
        background: white;
        border: 3px solid #000;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    /* Select Dropdown */
    .graffiti-select {
        padding: 14px 20px;
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
        min-width: 200px;
    }

    .graffiti-select:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-cyan);
    }

    /* Artwork Grid */
    .artwork-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
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

    /* Badge Graffiti Style */
    .badge-graffiti {
        font-family: 'Permanent Marker', cursive;
        font-size: 12px;
        padding: 4px 12px;
        border: 2px solid #000;
        border-radius: 20px;
        display: inline-block;
        transform: rotate(-2deg);
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
    }

    /* Empty State */
    .empty-state {
        background: white;
        border: 4px dashed #000;
        border-radius: 20px;
        padding: 80px 40px;
        text-align: center;
        position: relative;
    }

    .empty-state::before {
        content: '🎨';
        position: absolute;
        top: 30px;
        right: 40px;
        font-size: 60px;
        opacity: 0.15;
        transform: rotate(15deg);
    }

    .empty-state::after {
        content: '✨';
        position: absolute;
        bottom: 30px;
        left: 40px;
        font-size: 60px;
        opacity: 0.15;
        transform: rotate(-15deg);
    }

    .empty-title {
        font-family: 'Bangers', cursive;
        font-size: 40px;
        color: var(--dark-bg);
        text-transform: uppercase;
        margin-bottom: 16px;
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
        .page-title {
            font-size: 40px;
        }

        .artwork-grid {
            grid-template-columns: 1fr;
        }

        .graffiti-select {
            width: 100%;
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
</style>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 30px; right: 5%; animation-delay: -1s;">
        🖼️
    </div>

    <div class="sticker" style="bottom: 100px; left: 3%; animation-delay: -3s;">
        🎨
    </div>

    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-40 left-10 w-64 h-64" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-pink)" stroke-width="4" opacity="0.2"/>
        <circle cx="100" cy="50" r="30" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
    </svg>

    <svg class="doodle-bg absolute bottom-40 right-10 w-56 h-56" viewBox="0 0 200 200" fill="none">
        <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" stroke="var(--graffiti-yellow)" stroke-width="4" opacity="0.2"/>
    </svg>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-12 fade-in">
        <div>
            <h1 class="page-title">Artworks</h1>
            <p class="handwritten text-2xl text-gray-700 mt-6">Discover amazing art from our community!</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar fade-in">
        <form method="GET" action="{{ route('artworks.index') }}" class="flex flex-wrap items-center gap-4">
            <label class="doodle-text text-lg">Filter by:</label>
            <select name="category" class="graffiti-select" onchange="this.form.submit()">
                <option value="">📂 All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @if(request('category'))
                <a href="{{ route('artworks.index') }}" class="handwritten text-lg text-gray-600 hover:text-pink-600 underline">
                    ✕ Clear filter
                </a>
            @endif
        </form>
    </div>

    <!-- Artworks Grid -->
    <div class="artwork-grid fade-in delay-1">
        @forelse($artworks as $artwork)
            <div class="artwork-card">
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
                        <span class="badge-graffiti">{{ $artwork->category->name }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="empty-state">
                    <svg class="w-28 h-28 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="empty-title">No Artworks Found</h3>
                    <p class="handwritten text-2xl text-gray-600 mb-2">
                        @if(request('category'))
                            Try a different category or clear your filter!
                        @else
                            Be the first to share your art with the community!
                        @endif
                    </p>
                    @auth
                        <a href="{{ route('artworks.create') }}" class="inline-block mt-4 px-8 py-3 bg-pink-500 text-white rounded-full font-bold hover:bg-pink-600 transition" style="font-family: 'Permanent Marker', cursive; border: 3px solid #000; box-shadow: 4px 4px 0px rgba(0,0,0,0.2);">
                            🚀 Upload Your Art
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($artworks->hasPages())
        <div class="pagination fade-in delay-1">
            {{ $artworks->links() }}
        </div>
    @endif
</div>
@endsection