@extends('layouts.app')

@section('title', 'Artists')

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
        background: var(--graffiti-purple);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Search Bar */
    .search-bar {
        background: white;
        border: 3px solid #000;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    /* Form Inputs */
    .graffiti-input {
        padding: 14px 20px;
        border: 3px solid #000;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 16px;
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
    }

    .graffiti-select:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-purple);
    }

    /* Search Button */
    .btn-search {
        font-family: 'Permanent Marker', cursive;
        padding: 14px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
        transition: all 0.3s;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    .btn-search:hover {
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.3);
    }

    /* Artist Card */
    .artist-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        position: relative;
    }

    .artist-card::before {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-pink), var(--graffiti-cyan));
        border-radius: 12px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .artist-card:hover {
        transform: translateY(-8px) rotate(-1deg);
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.15);
    }

    .artist-card:hover::before {
        opacity: 0.5;
    }

    /* Avatar */
    .artist-avatar {
        width: 80px;
        height: 80px;
        border: 4px solid #000;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.15);
        flex-shrink: 0;
    }

    /* Artist Name */
    .artist-name {
        font-family: 'Permanent Marker', cursive;
        font-size: 20px;
        color: var(--dark-bg);
        margin-bottom: 4px;
    }

    .artist-name:hover {
        color: var(--graffiti-pink);
    }

    /* Stats Badge */
    .stat-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 13px;
        padding: 4px 12px;
        background: var(--paper-bg);
        border: 2px solid #000;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Follow Button */
    .btn-follow {
        font-family: 'Permanent Marker', cursive;
        padding: 8px 20px;
        border: 2px solid #000;
        border-radius: 20px;
        font-size: 14px;
        background: var(--graffiti-green);
        color: var(--dark-bg);
        transition: all 0.3s;
        cursor: pointer;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
    }

    .btn-follow:hover {
        transform: translateY(-2px);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
    }

    .btn-unfollow {
        background: white;
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
        content: '👥';
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

    /* Grid */
    .artists-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 24px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 40px;
        }

        .artists-grid {
            grid-template-columns: 1fr;
        }

        .search-bar form {
            flex-direction: column;
        }

        .graffiti-input,
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
        👨‍🎨
    </div>

    <div class="sticker" style="bottom: 100px; left: 3%; animation-delay: -3s;">
        ✨
    </div>

    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-40 left-10 w-64 h-64" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-purple)" stroke-width="4" opacity="0.2"/>
        <circle cx="100" cy="50" r="30" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
    </svg>

    <svg class="doodle-bg absolute bottom-40 right-10 w-56 h-56" viewBox="0 0 200 200" fill="none">
        <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" stroke="var(--graffiti-yellow)" stroke-width="4" opacity="0.2"/>
    </svg>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-12 fade-in">
        <div>
            <h1 class="page-title">Discover Artists</h1>
            <p class="handwritten text-2xl text-gray-700 mt-6">Connect with creative minds! 🎨</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-bar fade-in">
        <form method="GET" action="{{ route('artists.index') }}" class="flex flex-wrap gap-4">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="🔍 Search artists..."
                   class="graffiti-input flex-1 min-w-[200px]">

            <select name="sort" class="graffiti-select min-w-[180px]">
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>⭐ Most Followed</option>
                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>🆕 Recently Joined</option>
                <option value="artworks" {{ request('sort') == 'artworks' ? 'selected' : '' }}>🎨 Most Artworks</option>
            </select>

            <button type="submit" class="btn-search">
                Search
            </button>
        </form>
    </div>

    <!-- Artists Grid -->
    <div class="artists-grid fade-in delay-1">
        @forelse($artists as $artist)
            <div class="artist-card">
                <div class="flex gap-4 mb-4">
                    <img src="{{ $artist->avatar_url }}" alt="{{ $artist->name }}" class="artist-avatar">
                    <div class="flex-1">
                        <h3 class="artist-name">
                            <a href="{{ route('artists.show', $artist) }}">{{ $artist->name }}</a>
                        </h3>
                        @if($artist->location)
                            <p class="handwritten text-base text-gray-600 mb-2">📍 {{ $artist->location }}</p>
                        @endif
                        @if($artist->bio)
                            <p class="handwritten text-lg text-gray-700 leading-snug">{{ Str::limit($artist->bio, 100) }}</p>
                        @else
                            <p class="handwritten text-lg text-gray-500 italic">Creative artist</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t-3 border-dashed border-gray-200">
                    <div class="flex gap-3">
                        <span class="stat-badge">
                            🎨 <strong>{{ $artist->artworks_count }}</strong>
                        </span>
                        <span class="stat-badge">
                            👥 <strong>{{ $artist->followers_count }}</strong>
                        </span>
                    </div>

                    @auth
                        @if(auth()->id() !== $artist->id)
                            @if(auth()->user()->isFollowing($artist))
                                <form method="POST" action="{{ route('artists.unfollow', $artist) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-follow btn-unfollow">Unfollow</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('artists.follow', $artist) }}">
                                    @csrf
                                    <button type="submit" class="btn-follow">✨ Follow</button>
                                </form>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="empty-state">
                    <svg class="w-28 h-28 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="empty-title">No Artists Found</h3>
                    <p class="handwritten text-2xl text-gray-600 mb-2">
                        @if(request('search'))
                            Try a different search term!
                        @else
                            Be the first creative mind here!
                        @endif
                    </p>
                    @if(request('search'))
                        <a href="{{ route('artists.index') }}" class="inline-block mt-4 px-8 py-3 bg-purple-500 text-white rounded-full font-bold hover:bg-purple-600 transition" style="font-family: 'Permanent Marker', cursive; border: 3px solid #000; box-shadow: 4px 4px 0px rgba(0,0,0,0.2);">
                            ✕ Clear Search
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($artists->hasPages())
        <div class="pagination fade-in delay-1">
            {{ $artists->links() }}
        </div>
    @endif
</div>
@endsection