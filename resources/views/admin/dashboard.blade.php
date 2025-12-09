@extends('layouts.admin')

@section('title', 'Dashboard')

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
        margin-bottom: 40px;
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

    /* Stat Card */
    .stat-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        position: relative;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.15);
    }

    /* Different colors for each stat card */
    .stat-card:nth-child(1)::before {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        background: var(--graffiti-cyan);
        border-radius: 16px;
        z-index: -1;
        opacity: 0.3;
    }

    .stat-card:nth-child(2)::before {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        background: var(--graffiti-purple);
        border-radius: 16px;
        z-index: -1;
        opacity: 0.3;
    }

    .stat-card:nth-child(3)::before {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        background: var(--graffiti-pink);
        border-radius: 16px;
        z-index: -1;
        opacity: 0.3;
    }

    .stat-card:nth-child(4)::before {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        background: var(--graffiti-green);
        border-radius: 16px;
        z-index: -1;
        opacity: 0.3;
    }

    .stat-label {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
    }

    .stat-number {
        font-family: 'Bangers', cursive;
        font-size: 48px;
        color: var(--dark-bg);
        line-height: 1;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border: 3px solid #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .stat-icon.cyan { background: var(--graffiti-cyan); }
    .stat-icon.purple { background: var(--graffiti-purple); }
    .stat-icon.pink { background: var(--graffiti-pink); }
    .stat-icon.green { background: var(--graffiti-green); }

    /* Section Card */
    .section-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-family: 'Bangers', cursive;
        font-size: 32px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--dark-bg);
        margin-bottom: 24px;
        position: relative;
        display: inline-block;
    }

    .section-title::before {
        content: '★';
        position: absolute;
        left: -32px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 24px;
        color: var(--graffiti-yellow);
    }

    /* User Item */
    .user-item {
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        transition: all 0.3s;
    }

    .user-item:hover {
        transform: translateX(4px);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    /* Artwork Item */
    .artwork-item {
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        transition: all 0.3s;
    }

    .artwork-item:hover {
        transform: translateX(4px);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .artwork-thumb {
        width: 56px;
        height: 56px;
        border: 3px solid #000;
        border-radius: 8px;
        object-fit: cover;
    }

    /* Badge */
    .badge-graffiti {
        font-family: 'Permanent Marker', cursive;
        font-size: 12px;
        padding: 4px 12px;
        border: 2px solid #000;
        border-radius: 16px;
        display: inline-block;
        transform: rotate(-2deg);
    }

    .badge-admin {
        background: var(--graffiti-pink);
        color: white;
    }

    .badge-user {
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
    }

    /* Table */
    .graffiti-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .graffiti-table thead th {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: var(--dark-bg);
        text-align: left;
        padding: 12px 16px;
        background: var(--paper-bg);
        border: 3px solid #000;
        border-bottom: none;
    }

    .graffiti-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .graffiti-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .graffiti-table tbody tr {
        background: var(--paper-bg);
        transition: all 0.3s;
    }

    .graffiti-table tbody tr:hover {
        transform: translateX(4px);
    }

    .graffiti-table tbody td {
        padding: 16px;
        border: 3px solid #000;
        border-top: none;
        border-bottom: 3px solid #000;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    .graffiti-table tbody td:first-child {
        border-left: 3px solid #000;
        border-radius: 12px 0 0 12px;
    }

    .graffiti-table tbody td:last-child {
        border-right: 3px solid #000;
        border-radius: 0 12px 12px 0;
    }

    /* View Link */
    .view-link {
        font-family: 'Permanent Marker', cursive;
        font-size: 16px;
        color: var(--graffiti-purple);
        text-decoration: none;
        display: inline-block;
        padding: 12px 24px;
        border: 3px solid #000;
        border-radius: 50px;
        background: white;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        margin-top: 16px;
    }

    .view-link:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        background: var(--graffiti-yellow);
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
        .page-title {
            font-size: 40px;
        }

        .section-title {
            font-size: 24px;
        }

        .stat-number {
            font-size: 36px;
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
<div class="relative">
    <!-- Decorative Sticker -->
    <div class="sticker" style="top: 20px; right: 3%; animation-delay: -1s;">
        📊
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-12 fade-in">Admin Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 fade-in">
        <!-- Total Users -->
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="stat-label">Total Users</p>
                    <p class="stat-number">{{ $stats['users'] }}</p>
                </div>
                <div class="stat-icon cyan">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            @if($stats['deleted_users'] > 0)
                <p class="handwritten text-base text-gray-600">🗑️ {{ $stats['deleted_users'] }} deleted</p>
            @endif
        </div>

        <!-- Total Artworks -->
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="stat-label">Total Artworks</p>
                    <p class="stat-number">{{ $stats['artworks'] }}</p>
                </div>
                <div class="stat-icon purple">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            @if($stats['deleted_artworks'] > 0)
                <p class="handwritten text-base text-gray-600">🗑️ {{ $stats['deleted_artworks'] }} deleted</p>
            @endif
        </div>

        <!-- Total Tutorials -->
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="stat-label">Total Tutorials</p>
                    <p class="stat-number">{{ $stats['tutorials'] }}</p>
                </div>
                <div class="stat-icon pink">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="stat-label">Categories</p>
                    <p class="stat-number">{{ $stats['categories'] }}</p>
                </div>
                <div class="stat-icon green">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Users -->
        <div class="section-card fade-in delay-1">
            <h2 class="section-title">Recent Users</h2>
            <div class="space-y-3">
                @foreach($recentUsers as $user)
                    <div class="user-item">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ $user->avatar_url }}" alt="" class="w-12 h-12 rounded-full border-3 border-black">
                                <div>
                                    <p class="doodle-text text-sm">{{ $user->name }}</p>
                                    <p class="handwritten text-base text-gray-600">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="badge-graffiti badge-{{ $user->role === 'admin' ? 'admin' : 'user' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('admin.users.index') }}" class="view-link">
                    👥 View All Users
                </a>
            </div>
        </div>

        <!-- Recent Artworks -->
        <div class="section-card fade-in delay-2">
            <h2 class="section-title">Recent Artworks</h2>
            <div class="space-y-3">
                @foreach($recentArtworks as $artwork)
                    <div class="artwork-item">
                        <div class="flex items-center gap-4">
                            <img src="{{ $artwork->image_url }}" alt="" class="artwork-thumb">
                            <div class="flex-1">
                                <p class="doodle-text text-sm">{{ $artwork->title }}</p>
                                <p class="handwritten text-base text-gray-600">by {{ $artwork->user->name }}</p>
                            </div>
                            <span class="handwritten text-sm text-gray-500">{{ $artwork->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('admin.artworks.index') }}" class="view-link">
                    🎨 View All Artworks
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Comments -->
    <div class="section-card fade-in delay-3">
        <h2 class="section-title">Recent Comments</h2>
        <table class="graffiti-table">
            <thead>
                <tr>
                    <th>👤 User</th>
                    <th>💬 Comment</th>
                    <th>🎨 Artwork</th>
                    <th>📅 Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentComments as $comment)
                    <tr>
                        <td class="doodle-text text-sm">{{ $comment->user->name }}</td>
                        <td class="handwritten text-base">{{ Str::limit($comment->content, 60) }}</td>
                        <td class="handwritten text-base">{{ $comment->artwork?->title ?? 'Deleted Artwork' }}</td>
                        <td class="handwritten text-base text-gray-600">{{ $comment->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection