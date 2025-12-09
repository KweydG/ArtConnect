@extends('layouts.app')

@section('title', $tutorial->title)

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

    /* Main Content Card */
    .content-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        position: relative;
        padding: 48px;
        margin-bottom: 32px;
    }

    .content-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-yellow), var(--graffiti-cyan), var(--graffiti-pink));
        border-radius: 16px;
        z-index: -1;
        opacity: 0.3;
    }

    /* Tutorial Title */
    .tutorial-title {
        font-family: 'Bangers', cursive;
        font-size: 48px;
        line-height: 1.2;
        color: var(--dark-bg);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
        position: relative;
        display: inline-block;
    }

    .tutorial-title::after {
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

    .badge-category {
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
        transform: rotate(2deg);
    }

    /* Meta Info */
    .meta-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        padding: 6px 12px;
        background: var(--paper-bg);
        border: 2px solid #000;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Author Card */
    .author-card {
        background: white;
        border: 3px solid #000;
        border-radius: 16px;
        padding: 20px;
        display: inline-flex;
        align-items: center;
        gap: 16px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }

    .author-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.2);
    }

    .author-card img {
        border: 3px solid #000;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.2);
    }

    /* Image Container */
    .image-container {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        margin-bottom: 32px;
        position: relative;
    }

    .image-container::after {
        content: '🎨';
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 40px;
        opacity: 0.2;
    }

    /* Content Prose Styling */
    .tutorial-content {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        line-height: 1.8;
        color: #333;
    }

    .tutorial-content p {
        margin-bottom: 20px;
    }

    .tutorial-content h2 {
        font-family: 'Permanent Marker', cursive;
        font-size: 28px;
        color: var(--dark-bg);
        margin-top: 40px;
        margin-bottom: 16px;
        padding-left: 20px;
        border-left: 6px solid var(--graffiti-yellow);
    }

    .tutorial-content h3 {
        font-family: 'Permanent Marker', cursive;
        font-size: 24px;
        color: var(--dark-bg);
        margin-top: 32px;
        margin-bottom: 12px;
    }

    /* Buttons */
    .btn-graffiti {
        font-family: 'Permanent Marker', cursive;
        padding: 12px 28px;
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

    /* Related Tutorials */
    .related-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        position: relative;
    }

    .related-card::after {
        content: '';
        position: absolute;
        top: 6px;
        left: 6px;
        right: -6px;
        bottom: -6px;
        background: var(--graffiti-purple);
        border-radius: 12px;
        z-index: -1;
        transition: all 0.3s;
        opacity: 0.3;
    }

    .related-card:hover {
        transform: translate(-4px, -4px);
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.15);
    }

    .related-card:hover::after {
        top: 10px;
        left: 10px;
        opacity: 0.5;
    }

    /* Section Titles */
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
        left: -40px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 32px;
        color: var(--graffiti-yellow);
    }

    /* Decorative Elements */
    .doodle-corner {
        position: absolute;
        pointer-events: none;
    }

    .top-left {
        top: -20px;
        left: -20px;
        transform: rotate(-15deg);
    }

    .top-right {
        top: -20px;
        right: -20px;
        transform: rotate(15deg);
    }

    /* Sticker */
    .sticker {
        position: absolute;
        background: white;
        border: 3px solid #000;
        border-radius: 50%;
        padding: 12px;
        font-size: 24px;
        transform: rotate(12deg);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
        animation: bob 3s ease-in-out infinite;
    }

    @keyframes bob {
        0%, 100% { transform: rotate(12deg) translateY(0); }
        50% { transform: rotate(8deg) translateY(-10px); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .content-card {
            padding: 24px;
        }

        .tutorial-title {
            font-size: 32px;
        }

        .section-title {
            font-size: 28px;
        }

        .section-title::before {
            left: -30px;
            font-size: 24px;
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
    .delay-3 { animation-delay: 0.3s; }
</style>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Decorative Sticker -->
    <div class="sticker" style="top: 20px; right: 40px;">
        📚
    </div>

    <!-- Tutorial Header -->
    <div class="content-card fade-in">
        <!-- Meta Badges -->
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <span class="badge-graffiti badge-{{ $tutorial->difficulty }}">{{ ucfirst($tutorial->difficulty) }}</span>
            <span class="meta-badge">⏱️ {{ $tutorial->duration }} min</span>
            <span class="meta-badge">👁️ {{ $tutorial->views }} views</span>
        </div>

        <!-- Title -->
        <h1 class="tutorial-title mb-8">{{ $tutorial->title }}</h1>

        <!-- Description -->
        <p class="handwritten text-3xl text-gray-700 mb-8 leading-relaxed">{{ $tutorial->description }}</p>

        <!-- Author & Category -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <a href="{{ route('artists.show', $tutorial->user) }}" class="author-card">
                <img src="{{ $tutorial->user->avatar_url }}" alt="{{ $tutorial->user->name }}" class="w-16 h-16 rounded-full object-cover">
                <div>
                    <p class="doodle-text text-lg text-gray-900">{{ $tutorial->user->name }}</p>
                    <p class="handwritten text-base text-gray-600">{{ $tutorial->created_at->format('M d, Y') }}</p>
                </div>
            </a>

            <a href="{{ route('categories.show', $tutorial->category) }}" class="badge-graffiti badge-category text-base">
                📂 {{ $tutorial->category->name }}
            </a>
        </div>
    </div>

    <!-- Tutorial Image -->
    @if($tutorial->image)
        <div class="image-container fade-in delay-1">
            <img src="{{ $tutorial->image_url }}" alt="{{ $tutorial->title }}" class="w-full">
        </div>
    @endif

    <!-- Tutorial Content -->
    <div class="content-card tutorial-content fade-in delay-2">
        <div class="doodle-corner top-left">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 30 Q 20 10, 30 30 T 50 30" stroke="#FFBE0B" stroke-width="3" fill="none"/>
                <circle cx="30" cy="15" r="5" fill="#00F5FF" stroke="#000" stroke-width="2"/>
            </svg>
        </div>
        <div class="doodle-corner top-right">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30 10 L35 25 L50 30 L35 35 L30 50 L25 35 L10 30 L25 25 Z" fill="#FF006E" stroke="#000" stroke-width="2"/>
            </svg>
        </div>

        {!! nl2br(e($tutorial->content)) !!}
    </div>

    <!-- Actions -->
    @can('update', $tutorial)
        <div class="flex flex-wrap justify-end gap-4 mb-12 fade-in delay-3">
            <a href="{{ route('tutorials.edit', $tutorial) }}" class="btn-graffiti btn-edit">
                ✏️ Edit Tutorial
            </a>
            <form method="POST" action="{{ route('tutorials.destroy', $tutorial) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-graffiti btn-delete" onclick="return confirm('Delete this tutorial? This action cannot be undone!')">
                    🗑️ Delete
                </button>
            </form>
        </div>
    @endcan

    <!-- Related Tutorials -->
    @if($relatedTutorials->count() > 0)
        <div class="mt-16 fade-in delay-3">
            <h2 class="section-title">Related Tutorials</h2>
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($relatedTutorials as $related)
                    <div class="related-card">
                        <span class="badge-graffiti badge-{{ $related->difficulty }} mb-3">{{ ucfirst($related->difficulty) }}</span>
                        <h3 class="doodle-text text-xl text-gray-900 mb-3">
                            <a href="{{ route('tutorials.show', $related) }}" class="hover:text-pink-600">{{ $related->title }}</a>
                        </h3>
                        <p class="text-gray-600 leading-relaxed">{{ Str::limit($related->description, 120) }}</p>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="handwritten text-base text-gray-500">by {{ $related->user->name }}</span>
                            <span class="meta-badge">⏱️ {{ $related->duration }} min</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Back Button -->
    <div class="mt-12 text-center fade-in">
        <a href="{{ route('tutorials.index') }}" class="btn-graffiti" style="background: var(--graffiti-yellow); color: var(--dark-bg);">
            ← Back to Tutorials
        </a>
    </div>
</div>
@endsection