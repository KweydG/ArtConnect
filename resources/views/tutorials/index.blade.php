@extends('layouts.app')

@section('title', 'Learn')

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

    /* Hero Section */
    .learn-hero {
        background: linear-gradient(135deg, var(--dark-bg) 0%, #16213e 100%);
        position: relative;
        overflow: hidden;
        padding: 80px 0;
    }

    .learn-hero::before {
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

    /* Section Title */
    .section-title {
        font-family: 'Bangers', cursive;
        font-size: 56px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--graffiti-yellow);
        text-shadow: 5px 5px 0px rgba(0,0,0,0.3);
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border: 3px solid #000;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
        position: relative;
    }

    .filter-section::after {
        content: '📚';
        position: absolute;
        top: 16px;
        right: 16px;
        font-size: 32px;
        opacity: 0.2;
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
        border-color: var(--graffiti-purple);
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
        border-color: var(--graffiti-cyan);
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
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
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

    /* Tutorial Card */
    .tutorial-card {
        background: white;
        border: 3px solid #000;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        position: relative;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
    }

    .tutorial-card::before {
        content: '★';
        position: absolute;
        top: 16px;
        right: 16px;
        font-size: 28px;
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
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.2);
    }

    .tutorial-card::after {
        content: '';
        position: absolute;
        inset: -3px;
        background: linear-gradient(45deg, var(--graffiti-pink), var(--graffiti-cyan), var(--graffiti-purple));
        border-radius: 12px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tutorial-card:hover::after {
        opacity: 0.6;
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

    /* Duration Badge */
    .duration-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 13px;
        padding: 4px 10px;
        background: var(--graffiti-cyan);
        border: 2px solid #000;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
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
        content: '🎓';
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 50px;
        opacity: 0.2;
        transform: rotate(15deg);
    }

    .empty-state::after {
        content: '📖';
        position: absolute;
        bottom: 20px;
        left: 20px;
        font-size: 50px;
        opacity: 0.2;
        transform: rotate(-15deg);
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

    /* Book Icon Decoration */
    .book-icon {
        position: relative;
    }

    .book-icon::after {
        content: '';
        position: absolute;
        inset: -4px;
        background: var(--graffiti-purple);
        border-radius: 8px;
        z-index: -1;
        opacity: 0.3;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.3; }
        50% { transform: scale(1.1); opacity: 0.5; }
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

    /* Responsive */
    @media (max-width: 768px) {
        .section-title {
            font-size: 40px;
        }

        .filter-section {
            padding: 16px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="learn-hero relative">
    <!-- Spray Paint Blobs -->
    <div class="spray-circle" style="background: var(--graffiti-purple); width: 350px; height: 350px; top: -80px; left: -80px;"></div>
    <div class="spray-circle" style="background: var(--graffiti-cyan); width: 300px; height: 300px; top: 20%; right: -60px; animation-delay: -2s;"></div>
    <div class="spray-circle" style="background: var(--graffiti-yellow); width: 280px; height: 280px; bottom: -50px; left: 40%; animation-delay: -4s;"></div>

    <!-- SVG Doodles -->
    <svg class="doodle-star absolute top-16 right-20 w-20 h-20" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
        <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" class="doodle-line" style="stroke: var(--graffiti-green)"/>
    </svg>

    <svg class="doodle-star absolute bottom-20 left-16 w-24 h-24" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
        <circle cx="50" cy="50" r="35" class="doodle-line" style="stroke: var(--graffiti-pink); animation-delay: 0.5s"/>
        <path d="M30 50 L50 30 L70 50 L50 70 Z" class="doodle-line" style="stroke: var(--graffiti-yellow); animation-delay: 0.8s"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="section-title mb-4">Learn & Grow</h1>
        <p class="text-2xl md:text-3xl handwritten text-white">Explore tutorials from talented artists and improve your skills</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Background Doodles -->
    <svg class="doodle-bg absolute top-0 right-0 w-72 h-72" viewBox="0 0 200 200" fill="none">
        <path d="M20 100 Q 60 20, 100 100 T 180 100" stroke="var(--graffiti-cyan)" stroke-width="4" opacity="0.2"/>
        <path d="M40 120 Q 80 40, 120 120 T 200 120" stroke="var(--graffiti-pink)" stroke-width="4" opacity="0.2"/>
        <circle cx="100" cy="60" r="20" stroke="var(--graffiti-yellow)" stroke-width="4" opacity="0.2"/>
    </svg>

    <!-- Filters -->
    <div class="filter-section fade-in">
        <form method="GET" action="{{ route('tutorials.index') }}" class="flex flex-col md:flex-row flex-wrap gap-4">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="🔍 Search tutorials..."
                   class="graffiti-input flex-1 min-w-[250px]">

            <select name="category" class="graffiti-select md:w-48">
                <option value="">📂 All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="difficulty" class="graffiti-select md:w-48">
                <option value="">🎯 All Levels</option>
                <option value="beginner" {{ request('difficulty') == 'beginner' ? 'selected' : '' }}>🟢 Beginner</option>
                <option value="intermediate" {{ request('difficulty') == 'intermediate' ? 'selected' : '' }}>🟡 Intermediate</option>
                <option value="advanced" {{ request('difficulty') == 'advanced' ? 'selected' : '' }}>🔴 Advanced</option>
            </select>

            <select name="sort" class="graffiti-select md:w-48">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>⏰ Latest</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>🔥 Most Viewed</option>
            </select>

            <button type="submit" class="btn-graffiti">Filter</button>
        </form>
    </div>

    <!-- Tutorials Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 fade-in">
        @forelse($tutorials as $tutorial)
            <div class="tutorial-card">
                @if($tutorial->image)
                    <img src="{{ $tutorial->image_url }}" alt="{{ $tutorial->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 flex items-center justify-center book-icon" style="background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-pink));">
                        <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center justify-between mb-3">
                        <span class="badge-graffiti badge-{{ $tutorial->difficulty }}">{{ ucfirst($tutorial->difficulty) }}</span>
                        <span class="duration-badge">⏱️ {{ $tutorial->duration }} min</span>
                    </div>
                    <h3 class="doodle-text text-xl text-gray-900 mb-3">
                        <a href="{{ route('tutorials.show', $tutorial) }}" class="hover:text-pink-600">{{ $tutorial->title }}</a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($tutorial->description, 100) }}</p>
                    <div class="flex items-center justify-between border-t-2 border-dashed border-gray-200 pt-3">
                        <a href="{{ route('artists.show', $tutorial->user) }}" class="flex items-center hover:opacity-70 transition">
                            <img src="{{ $tutorial->user->avatar_url }}" alt="" class="w-8 h-8 rounded-full mr-2 border-2 border-black">
                            <span class="handwritten text-base text-gray-700">{{ $tutorial->user->name }}</span>
                        </a>
                        <span class="text-sm handwritten text-gray-500">👁️ {{ $tutorial->views }} views</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="empty-state">
                    <svg class="w-24 h-24 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <h3 class="graffiti-title text-3xl mb-3" style="color: var(--dark-bg);">No Tutorials Found</h3>
                    <p class="handwritten text-xl text-gray-600 mb-2">Try adjusting your filters</p>
                    <p class="handwritten text-lg text-gray-500">Or be the first to create a tutorial!</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($tutorials->hasPages())
        <div class="pagination">
            {{ $tutorials->links() }}
        </div>
    @endif
</div>
@endsection