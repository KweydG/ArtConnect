@extends('layouts.app')

@section('title', $collection->name)

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

    /* Collection Header Card */
    .header-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-bottom: 40px;
        position: relative;
    }

    .header-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-cyan), var(--graffiti-pink));
        border-radius: 16px;
        z-index: -1;
        opacity: 0.4;
    }

    /* Collection Title */
    .collection-main-title {
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

    .collection-main-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 100%;
        height: 6px;
        background: var(--graffiti-yellow);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Badge Graffiti Style */
    .badge-graffiti {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        padding: 6px 16px;
        border: 2px solid #000;
        border-radius: 20px;
        display: inline-block;
        transform: rotate(-2deg);
        font-weight: bold;
    }

    .badge-public {
        background: var(--graffiti-green);
        color: var(--dark-bg);
    }

    .badge-private {
        background: var(--paper-bg);
        color: #666;
    }

    /* Author Link */
    .author-link {
        font-family: 'Permanent Marker', cursive;
        color: var(--dark-bg);
        text-decoration: none;
        font-size: 16px;
        border-bottom: 2px solid var(--graffiti-cyan);
        transition: all 0.3s;
    }

    .author-link:hover {
        color: var(--graffiti-pink);
        border-bottom-color: var(--graffiti-pink);
    }

    /* Buttons */
    .btn-graffiti {
        font-family: 'Permanent Marker', cursive;
        padding: 12px 28px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 15px;
        font-weight: bold;
        text-transform: uppercase;
        position: relative;
        overflow: hidden;
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

    .btn-graffiti:active {
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }

    .btn-edit {
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
    }

    .btn-delete {
        background: var(--graffiti-pink);
        color: white;
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

    /* Remove Button */
    .remove-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: var(--graffiti-pink);
        border: 3px solid #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    .remove-btn:hover {
        background: var(--graffiti-orange);
        transform: rotate(90deg) scale(1.1);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.3);
    }

    .remove-btn svg {
        stroke: white;
        stroke-width: 3;
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

    /* Count Badge */
    .count-badge {
        font-family: 'Bangers', cursive;
        font-size: 18px;
        color: var(--graffiti-purple);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .collection-main-title {
            font-size: 36px;
        }

        .section-title {
            font-size: 32px;
        }

        .header-card {
            padding: 24px;
        }

        .artwork-grid {
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
        📁
    </div>

    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-40 left-10 w-56 h-56" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-purple)" stroke-width="4" opacity="0.2"/>
        <circle cx="100" cy="50" r="25" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
    </svg>

    <!-- Collection Header -->
    <div class="header-card fade-in">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-6">
            <div class="flex-1">
                <h1 class="collection-main-title mb-6">{{ $collection->name }}</h1>
                
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    <span class="handwritten text-xl text-gray-600">by</span>
                    <a href="{{ route('artists.show', $collection->user) }}" class="author-link">
                        {{ $collection->user->name }}
                    </a>
                    <span class="badge-graffiti {{ $collection->is_public ? 'badge-public' : 'badge-private' }}">
                        {{ $collection->is_public ? '🌍 Public' : '🔒 Private' }}
                    </span>
                </div>

                @if($collection->description)
                    <p class="handwritten text-2xl text-gray-700 leading-relaxed">{{ $collection->description }}</p>
                @else
                    <p class="handwritten text-2xl text-gray-500 italic">No description provided</p>
                @endif
            </div>

            @can('update', $collection)
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('collections.edit', $collection) }}" class="btn-graffiti btn-edit">
                        ✏️ Edit
                    </a>
                    <form method="POST" action="{{ route('collections.destroy', $collection) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-graffiti btn-delete"
                                onclick="return confirm('🗑️ Delete this collection? This action cannot be undone!')">
                            🗑️ Delete
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    </div>

    <!-- Artworks Section -->
    <div class="fade-in delay-1">
        <h2 class="section-title">
            Artworks <span class="count-badge">({{ $collection->artworks->count() }})</span>
        </h2>

        @if($collection->artworks->count() > 0)
            <div class="artwork-grid">
                @foreach($collection->artworks as $artwork)
                    <div class="artwork-card">
                        <a href="{{ route('artworks.show', $artwork) }}">
                            <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="doodle-text text-lg text-gray-900 mb-1">
                                <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-pink-600">{{ $artwork->title }}</a>
                            </h3>
                            <p class="handwritten text-base text-gray-600">by {{ $artwork->user->name }}</p>
                        </div>

                        @can('update', $collection)
                            <form method="POST" action="{{ route('collections.remove-artwork', [$collection, $artwork]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn"
                                        onclick="return confirm('Remove this artwork from the collection?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </form>
                        @endcan
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg class="w-28 h-28 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="empty-title">No Artworks Yet</h3>
                <p class="handwritten text-2xl text-gray-600 mb-4">Start adding artworks to this collection!</p>
                <p class="handwritten text-xl text-gray-500">Visit any artwork and click "Add to Collection"</p>
            </div>
        @endif
    </div>
</div>
@endsection