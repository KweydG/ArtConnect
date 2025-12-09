@extends('layouts.app')

@section('title', $user->name)

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

    /* Profile Header Card */
    .profile-card {
        background: white;
        border: 4px solid #000;
        border-radius: 20px;
        padding: 48px;
        box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.1);
        margin-bottom: 48px;
        position: relative;
    }

    .profile-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-pink), var(--graffiti-cyan), var(--graffiti-yellow));
        border-radius: 20px;
        z-index: -1;
        opacity: 0.4;
    }

    /* Avatar */
    .profile-avatar {
        width: 160px;
        height: 160px;
        border: 6px solid #000;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.2);
        flex-shrink: 0;
    }

    /* Name */
    .profile-name {
        font-family: 'Bangers', cursive;
        font-size: 48px;
        line-height: 1.2;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--dark-bg);
        margin-bottom: 12px;
    }

    /* Stats Container */
    .stats-container {
        display: flex;
        gap: 32px;
        margin-top: 32px;
    }

    .stat-item {
        text-align: center;
        padding: 16px 24px;
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 12px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }

    .stat-item:hover {
        transform: translateY(-4px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
    }

    .stat-number {
        font-family: 'Bangers', cursive;
        font-size: 36px;
        color: var(--graffiti-purple);
        line-height: 1;
    }

    .stat-label {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: #666;
        margin-top: 4px;
    }

    /* Buttons */
    .btn-graffiti {
        font-family: 'Permanent Marker', cursive;
        padding: 14px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        transition: all 0.3s;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-graffiti:hover {
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.3);
    }

    .btn-edit {
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
    }

    .btn-follow {
        background: var(--graffiti-green);
        color: var(--dark-bg);
    }

    .btn-unfollow {
        background: white;
        color: var(--dark-bg);
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

    /* Artwork Card */
    .artwork-card {
        background: white;
        border: 3px solid #000;
        border-radius: 8px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        overflow: hidden;
        position: relative;
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

    /* Collection Card */
    .collection-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        text-decoration: none;
        display: block;
        position: relative;
    }

    .collection-card::before {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        background: linear-gradient(135deg, var(--graffiti-yellow), var(--graffiti-orange), var(--graffiti-pink));
        border-radius: 12px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .collection-card:hover {
        transform: translateY(-6px) rotate(-1deg);
        box-shadow: 9px 9px 0px rgba(0, 0, 0, 0.15);
    }

    .collection-card:hover::before {
        opacity: 0.4;
    }

    /* Badge */
    .category-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 12px;
        padding: 4px 12px;
        border: 2px solid #000;
        border-radius: 20px;
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
        display: inline-block;
        transform: rotate(-1deg);
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

    /* Grid */
    .artwork-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .collections-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
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

    /* Responsive */
    @media (max-width: 768px) {
        .profile-name {
            font-size: 36px;
        }

        .section-title {
            font-size: 32px;
        }

        .profile-card {
            padding: 24px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
        }

        .stats-container {
            gap: 16px;
        }

        .stat-number {
            font-size: 28px;
        }

        .artwork-grid,
        .collections-grid {
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
    <div class="sticker" style="top: 20px; right: 3%; animation-delay: -1s;">
        👨‍🎨
    </div>

    <!-- Profile Header -->
    <div class="profile-card fade-in">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="profile-avatar">

            <div class="flex-1 text-center md:text-left">
                <h1 class="profile-name">{{ $user->name }}</h1>

                @if($user->location)
                    <p class="handwritten text-xl text-gray-600 mb-3">
                        📍 {{ $user->location }}
                    </p>
                @endif

                @if($user->bio)
                    <p class="handwritten text-2xl text-gray-700 leading-relaxed max-w-3xl">{{ $user->bio }}</p>
                @else
                    <p class="handwritten text-2xl text-gray-500 italic">Creative artist sharing amazing work! ✨</p>
                @endif

                @if($user->website)
                    <a href="{{ $user->website }}" target="_blank" class="doodle-text text-base text-pink-600 hover:underline mt-4 inline-block">
                        🔗 {{ parse_url($user->website, PHP_URL_HOST) }}
                    </a>
                @endif

                <div class="stats-container justify-center md:justify-start">
                    <div class="stat-item">
                        <div class="stat-number">{{ $user->artworks_count }}</div>
                        <div class="stat-label">Artworks</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $user->followers_count }}</div>
                        <div class="stat-label">Followers</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $user->following_count }}</div>
                        <div class="stat-label">Following</div>
                    </div>
                </div>
            </div>

            <div class="flex-shrink-0">
                @auth
                    @if(auth()->id() === $user->id)
                        <a href="{{ route('profile.edit') }}" class="btn-graffiti btn-edit">
                            ✏️ Edit Profile
                        </a>
                    @else
                        @if(auth()->user()->isFollowing($user))
                            <form method="POST" action="{{ route('artists.unfollow', $user) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-graffiti btn-unfollow">Unfollow</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('artists.follow', $user) }}">
                                @csrf
                                <button type="submit" class="btn-graffiti btn-follow">✨ Follow</button>
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Artworks Section -->
    <div class="mb-16 fade-in delay-1">
        <h2 class="section-title">Artworks by {{ $user->name }}</h2>

        @if($user->artworks->count() > 0)
            <div class="artwork-grid">
                @foreach($user->artworks as $artwork)
                    <div class="artwork-card">
                        <a href="{{ route('artworks.show', $artwork) }}">
                            <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="doodle-text text-base text-gray-900 mb-2">
                                <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-pink-600">{{ $artwork->title }}</a>
                            </h3>
                            <span class="category-badge">{{ $artwork->category->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg class="w-24 h-24 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="empty-title">No Artworks Yet</h3>
                <p class="handwritten text-2xl text-gray-600">
                    @if(auth()->check() && auth()->id() === $user->id)
                        Start sharing your creative work with the world! 🚀
                    @else
                        {{ $user->name }} hasn't shared any artworks yet.
                    @endif
                </p>
                @if(auth()->check() && auth()->id() === $user->id)
                    <a href="{{ route('artworks.create') }}" class="inline-block mt-6 px-8 py-3 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition" style="font-family: 'Permanent Marker', cursive; border: 3px solid #000; box-shadow: 4px 4px 0px rgba(0,0,0,0.2);">
                        🎨 Upload Your First Artwork
                    </a>
                @endif
            </div>
        @endif
    </div>

    <!-- Collections Section -->
    @if($user->collections->count() > 0)
        <div class="fade-in delay-2">
            <h2 class="section-title">Collections</h2>
            <div class="collections-grid">
                @foreach($user->collections as $collection)
                    <a href="{{ route('collections.show', $collection) }}" class="collection-card">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="text-3xl">📁</div>
                            <div class="flex-1">
                                <h3 class="doodle-text text-xl text-gray-900 mb-2">{{ $collection->name }}</h3>
                                @if($collection->description)
                                    <p class="handwritten text-lg text-gray-700 leading-snug">{{ Str::limit($collection->description, 80) }}</p>
                                @else
                                    <p class="handwritten text-lg text-gray-500 italic">A curated collection</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-3 border-t-2 border-dashed border-gray-200">
                            <span class="doodle-text text-sm text-gray-600">
                                🎨 {{ $collection->artworks->count() }} artworks
                            </span>
                            @if($collection->is_public)
                                <span class="doodle-text text-sm text-green-600">🌍 Public</span>
                            @else
                                <span class="doodle-text text-sm text-gray-500">🔒 Private</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection