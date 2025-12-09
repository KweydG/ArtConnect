@extends('layouts.app')

@section('title', $artwork->title)

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

    /* Main Image Card */
    .image-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .image-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-pink), var(--graffiti-cyan), var(--graffiti-purple));
        border-radius: 16px;
        z-index: -1;
        opacity: 0.4;
    }

    /* Comments Section */
    .comments-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        margin-top: 32px;
    }

    .comments-title {
        font-family: 'Bangers', cursive;
        font-size: 32px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--dark-bg);
        margin-bottom: 24px;
    }

    /* Comment Form */
    .comment-textarea {
        width: 100%;
        padding: 14px 20px;
        border: 3px solid #000;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 16px;
        background: white;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        resize: vertical;
        min-height: 100px;
    }

    .comment-textarea:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-purple);
    }

    /* Comment Item */
    .comment-item {
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.05);
    }

    /* Sidebar Card */
    .sidebar-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        margin-bottom: 24px;
    }

    .sidebar-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-yellow), var(--graffiti-orange), var(--graffiti-pink));
        border-radius: 16px;
        z-index: -1;
        opacity: 0.3;
    }

    /* Artwork Title */
    .artwork-title {
        font-family: 'Bangers', cursive;
        font-size: 36px;
        line-height: 1.2;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--dark-bg);
        margin-bottom: 16px;
    }

    /* Stats Buttons */
    .stat-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 3px solid #000;
        border-radius: 20px;
        background: white;
        transition: all 0.3s;
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        cursor: pointer;
    }

    .stat-button:hover {
        transform: translateY(-2px);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
    }

    .stat-button.liked {
        background: var(--graffiti-pink);
        color: white;
    }

    .stat-button svg {
        width: 20px;
        height: 20px;
    }

    /* Tags */
    .tag-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 13px;
        padding: 6px 14px;
        border: 2px solid #000;
        border-radius: 20px;
        display: inline-block;
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
        transform: rotate(-1deg);
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

    .btn-primary {
        background: var(--graffiti-purple);
        color: white;
    }

    .btn-edit {
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
    }

    .btn-delete {
        background: var(--graffiti-pink);
        color: white;
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

    /* Related Artwork Card */
    .artwork-card {
        background: white;
        border: 3px solid #000;
        border-radius: 8px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        overflow: hidden;
    }

    .artwork-card:hover {
        transform: translateY(-8px);
        box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.2);
    }

    /* Artwork Grid */
    .artwork-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
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
        z-index: 10;
    }

    @keyframes bob {
        0%, 100% { transform: rotate(12deg) translateY(0); }
        50% { transform: rotate(8deg) translateY(-10px); }
    }

    /* Error Message */
    .error-message {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 18px;
        color: var(--graffiti-pink);
        margin-top: 6px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .artwork-title {
            font-size: 28px;
        }

        .section-title {
            font-size: 32px;
        }

        .sidebar-card,
        .comments-card {
            padding: 20px;
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
        🎨
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Artwork Image -->
            <div class="image-card fade-in">
                <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full">
            </div>

            <!-- Comments Section -->
            <div class="comments-card fade-in delay-1">
                <h3 class="comments-title">💬 Comments ({{ $artwork->comments->count() }})</h3>

                @auth
                    <form method="POST" action="{{ route('comments.store', $artwork) }}" class="mb-8">
                        @csrf
                        <textarea name="content" 
                                  rows="3" 
                                  placeholder="Share your thoughts about this artwork..."
                                  class="comment-textarea @error('content') border-pink-500 @enderror"
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="error-message">⚠️ {{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn-graffiti btn-primary mt-3">
                            💬 Post Comment
                        </button>
                    </form>
                @else
                    <div class="text-center py-6 bg-paper-bg border-3 border-dashed border-black rounded-lg mb-8">
                        <p class="handwritten text-2xl text-gray-700">
                            <a href="{{ route('login') }}" class="text-pink-600 hover:underline">Login</a> to leave a comment! 💭
                        </p>
                    </div>
                @endauth

                <div class="space-y-4">
                    @forelse($artwork->comments as $comment)
                        <div class="comment-item">
                            <div class="flex gap-4">
                                <img src="{{ $comment->user->avatar_url }}" alt="" class="w-12 h-12 rounded-full border-3 border-black flex-shrink-0">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <a href="{{ route('artists.show', $comment->user) }}" class="doodle-text text-base hover:text-pink-600">
                                            {{ $comment->user->name }}
                                        </a>
                                        <span class="handwritten text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="handwritten text-lg text-gray-800">{{ $comment->content }}</p>
                                    @can('delete', $comment)
                                        <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="mt-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="handwritten text-sm text-pink-600 hover:underline" 
                                                    onclick="return confirm('🗑️ Delete this comment?')">
                                                🗑️ Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 border-3 border-dashed border-black rounded-lg">
                            <p class="handwritten text-2xl text-gray-600">No comments yet. Be the first! 🎉</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Artwork Info -->
            <div class="sidebar-card fade-in delay-2" style="position: relative;">
                <h1 class="artwork-title">{{ $artwork->title }}</h1>

                <!-- Artist Info -->
                <a href="{{ route('artists.show', $artwork->user) }}" class="flex items-center gap-3 mb-6 hover:opacity-70 transition">
                    <img src="{{ $artwork->user->avatar_url }}" alt="" class="w-14 h-14 rounded-full border-3 border-black">
                    <div>
                        <p class="doodle-text text-base">{{ $artwork->user->name }}</p>
                        <p class="handwritten text-sm text-gray-600">{{ $artwork->created_at->format('M d, Y') }}</p>
                    </div>
                </a>

                <!-- Stats -->
                <div class="flex flex-wrap gap-3 mb-6">
                    @auth
                        <form method="POST" action="{{ route('likes.toggle', $artwork) }}">
                            @csrf
                            <button type="submit" class="stat-button {{ $artwork->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                                <svg fill="{{ $artwork->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span>{{ $artwork->likes->count() }}</span>
                            </button>
                        </form>
                    @else
                        <span class="stat-button">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span>{{ $artwork->likes->count() }}</span>
                        </span>
                    @endauth

                    <span class="stat-button">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span>{{ $artwork->views }}</span>
                    </span>

                    <span class="stat-button">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <span>{{ $artwork->comments->count() }}</span>
                    </span>
                </div>

                <!-- Description -->
                @if($artwork->description)
                    <div class="mb-6 pb-6 border-b-3 border-dashed border-gray-200">
                        <h3 class="doodle-text text-lg mb-2">📝 Description</h3>
                        <p class="handwritten text-xl text-gray-700 leading-relaxed">{{ $artwork->description }}</p>
                    </div>
                @endif

                <!-- Details -->
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="doodle-text text-sm">Category:</span>
                        <a href="{{ route('categories.show', $artwork->category) }}" class="handwritten text-lg text-pink-600 hover:underline">
                            {{ $artwork->category->name }}
                        </a>
                    </div>
                    @if($artwork->medium)
                        <div class="flex justify-between items-center">
                            <span class="doodle-text text-sm">Medium:</span>
                            <span class="handwritten text-lg text-gray-800">{{ $artwork->medium }}</span>
                        </div>
                    @endif
                </div>

                <!-- Tags -->
                @if($artwork->tags && count($artwork->tags) > 0)
                    <div class="mb-6 pb-6 border-b-3 border-dashed border-gray-200">
                        <h3 class="doodle-text text-base mb-3">🏷️ Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($artwork->tags as $tag)
                                <span class="tag-badge">#{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                @can('update', $artwork)
                    <div class="flex gap-3">
                        <a href="{{ route('artworks.edit', $artwork) }}" class="btn-graffiti btn-edit flex-1 text-center">
                            ✏️ Edit
                        </a>
                        <form method="POST" action="{{ route('artworks.destroy', $artwork) }}" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn-graffiti btn-delete w-full" 
                                    onclick="return confirm('🗑️ Delete this artwork? This cannot be undone!')">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            <!-- Follow Artist -->
            @auth
                @if(auth()->id() !== $artwork->user_id)
                    <div class="sidebar-card" style="position: relative;">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ $artwork->user->avatar_url }}" alt="" class="w-12 h-12 rounded-full border-3 border-black">
                                <div>
                                    <p class="doodle-text text-base">{{ $artwork->user->name }}</p>
                                    <p class="handwritten text-sm text-gray-600">{{ $artwork->user->artworks->count() }} artworks</p>
                                </div>
                            </div>
                            @if(auth()->user()->isFollowing($artwork->user))
                                <form method="POST" action="{{ route('artists.unfollow', $artwork->user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-graffiti btn-unfollow text-sm">Unfollow</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('artists.follow', $artwork->user) }}">
                                    @csrf
                                    <button type="submit" class="btn-graffiti btn-follow text-sm">✨ Follow</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- Related Artworks -->
    @if($relatedArtworks->count() > 0)
        <div class="mt-16 fade-in delay-2">
            <h2 class="section-title">More from {{ $artwork->category->name }}</h2>
            <div class="artwork-grid">
                @foreach($relatedArtworks as $related)
                    <div class="artwork-card">
                        <a href="{{ route('artworks.show', $related) }}">
                            <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="doodle-text text-base text-gray-900 mb-1">
                                <a href="{{ route('artworks.show', $related) }}" class="hover:text-pink-600">{{ $related->title }}</a>
                            </h3>
                            <p class="handwritten text-base text-gray-600">by {{ $related->user->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection