@extends('layouts.app')

@section('title', 'My Collections')

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
        font-size: 48px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--dark-bg);
        position: relative;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 100%;
        height: 6px;
        background: var(--graffiti-purple);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* New Collection Button */
    .btn-graffiti {
        font-family: 'Permanent Marker', cursive;
        padding: 14px 32px;
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
        text-decoration: none;
        display: inline-block;
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
    }

    .btn-graffiti:hover {
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.3);
    }

    .btn-graffiti:active {
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }

    /* Collection Card */
    .collection-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        position: relative;
    }

    .collection-card::before {
        content: '';
        position: absolute;
        inset: -4px;
        background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-pink), var(--graffiti-cyan));
        border-radius: 12px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .collection-card:hover {
        transform: translateY(-8px) rotate(-1deg);
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.15);
    }

    .collection-card:hover::before {
        opacity: 0.5;
    }

    /* Collection Title */
    .collection-title {
        font-family: 'Permanent Marker', cursive;
        font-size: 20px;
        color: var(--dark-bg);
        text-decoration: none;
        transition: color 0.3s;
    }

    .collection-title:hover {
        color: var(--graffiti-pink);
    }

    /* Badge Graffiti Style */
    .badge-graffiti {
        font-family: 'Permanent Marker', cursive;
        font-size: 12px;
        padding: 4px 12px;
        border: 2px solid #000;
        border-radius: 16px;
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

    /* Edit Button */
    .edit-button {
        width: 40px;
        height: 40px;
        border: 3px solid #000;
        border-radius: 50%;
        background: var(--graffiti-cyan);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .edit-button:hover {
        transform: rotate(15deg) scale(1.1);
        background: var(--graffiti-yellow);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
    }

    .edit-button svg {
        width: 20px;
        height: 20px;
        stroke: var(--dark-bg);
        stroke-width: 2.5;
    }

    /* Artwork Count Badge */
    .count-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        padding: 6px 14px;
        background: var(--paper-bg);
        border: 2px solid #000;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 8px;
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
        content: '📁';
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 50px;
        opacity: 0.2;
        transform: rotate(15deg);
    }

    .empty-state::after {
        content: '✨';
        position: absolute;
        bottom: 20px;
        left: 30px;
        font-size: 50px;
        opacity: 0.2;
        transform: rotate(-15deg);
    }

    .empty-title {
        font-family: 'Bangers', cursive;
        font-size: 36px;
        color: var(--dark-bg);
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .empty-link {
        font-family: 'Permanent Marker', cursive;
        color: var(--graffiti-purple);
        text-decoration: none;
        border-bottom: 2px solid var(--graffiti-purple);
        transition: all 0.3s;
    }

    .empty-link:hover {
        color: var(--graffiti-pink);
        border-bottom-color: var(--graffiti-pink);
    }

    /* Stickers/Decorations */
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
    .collections-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    /* Doodles */
    .doodle-bg {
        position: absolute;
        pointer-events: none;
        opacity: 0.1;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 36px;
        }

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

    .stagger-1 { animation-delay: 0.1s; }
    .stagger-2 { animation-delay: 0.2s; }
    .stagger-3 { animation-delay: 0.3s; }
</style>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 20px; right: 5%; animation-delay: -1s;">
        📚
    </div>

    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-32 left-10 w-48 h-48" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-purple)" stroke-width="4" opacity="0.2"/>
        <circle cx="100" cy="50" r="20" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
    </svg>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-12 fade-in">
        <h1 class="page-title">My Collections</h1>
        <a href="{{ route('collections.create') }}" class="btn-graffiti">
            + New Collection
        </a>
    </div>

    <!-- Collections Grid -->
    <div class="collections-grid fade-in stagger-1">
        @forelse($collections as $collection)
            <div class="collection-card">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <h3 class="mb-2">
                            <a href="{{ route('collections.show', $collection) }}" class="collection-title">
                                {{ $collection->name }}
                            </a>
                        </h3>
                        <span class="badge-graffiti {{ $collection->is_public ? 'badge-public' : 'badge-private' }}">
                            {{ $collection->is_public ? '🌍 Public' : '🔒 Private' }}
                        </span>
                    </div>
                    <a href="{{ route('collections.edit', $collection) }}" class="edit-button">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                </div>

                @if($collection->description)
                    <p class="handwritten text-lg text-gray-700 mb-4 leading-relaxed">
                        {{ Str::limit($collection->description, 100) }}
                    </p>
                @else
                    <p class="handwritten text-lg text-gray-500 italic mb-4">
                        No description yet
                    </p>
                @endif

                <div class="count-badge">
                    🎨 <span class="font-bold">{{ $collection->artworks_count }}</span> artworks
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="empty-state">
                    <svg class="w-24 h-24 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="empty-title">No Collections Yet</h3>
                    <p class="handwritten text-2xl text-gray-600 mb-6">Start organizing your favorite artworks!</p>
                    <a href="{{ route('collections.create') }}" class="empty-link text-xl">Create your first collection →</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($collections->hasPages())
        <div class="pagination fade-in stagger-2">
            {{ $collections->links() }}
        </div>
    @endif
</div>
@endsection