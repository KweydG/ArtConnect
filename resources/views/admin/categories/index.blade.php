@extends('layouts.admin')

@section('title', 'Manage Categories')

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
        font-size: 48px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--dark-bg);
        margin-bottom: 32px;
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
        background: var(--graffiti-green);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    /* Add Button */
    .btn-add {
        font-family: 'Permanent Marker', cursive;
        padding: 14px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 16px;
        background: var(--graffiti-green);
        color: var(--dark-bg);
        transition: all 0.3s;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
    }

    .btn-add:hover {
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.3);
    }

    /* Table Container */
    .table-container {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.1);
    }

    /* Table */
    .graffiti-table {
        width: 100%;
        border-collapse: collapse;
    }

    .graffiti-table thead {
        background: var(--paper-bg);
    }

    .graffiti-table thead th {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: var(--dark-bg);
        text-align: left;
        padding: 20px 16px;
        border-bottom: 3px solid #000;
    }

    .graffiti-table tbody tr {
        border-bottom: 2px solid #e5e5e5;
        transition: all 0.3s;
    }

    .graffiti-table tbody tr:hover {
        background: var(--paper-bg);
        transform: translateX(4px);
    }

    .graffiti-table tbody td {
        padding: 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    /* Category Image */
    .category-thumb {
        width: 48px;
        height: 48px;
        border: 3px solid #000;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
    }

    /* Slug Code */
    .slug-code {
        font-family: 'Courier New', monospace;
        font-size: 13px;
        padding: 6px 12px;
        background: var(--paper-bg);
        border: 2px solid #000;
        border-radius: 8px;
        display: inline-block;
    }

    /* Action Buttons */
    .btn-action {
        font-family: 'Permanent Marker', cursive;
        padding: 8px 16px;
        border: 2px solid #000;
        border-radius: 20px;
        font-size: 13px;
        text-transform: uppercase;
        transition: all 0.3s;
        cursor: pointer;
        display: inline-block;
        margin-right: 6px;
        margin-bottom: 6px;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
        text-decoration: none;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
    }

    .btn-edit {
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
    }

    .btn-delete {
        background: var(--graffiti-pink);
        color: white;
    }

    /* Empty State */
    .empty-state {
        padding: 60px 40px;
        text-align: center;
    }

    .empty-title {
        font-family: 'Bangers', cursive;
        font-size: 32px;
        color: var(--dark-bg);
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    /* Sticker */
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
            font-size: 36px;
        }

        .header-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .table-container {
            overflow-x: auto;
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
<div class="relative">
    <!-- Decorative Sticker -->
    <div class="sticker" style="top: 20px; right: 3%; animation-delay: -1s;">
        📂
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-8 fade-in">Manage Categories</h1>

    <!-- Header Section -->
    <div class="header-section fade-in delay-1">
        <div>
            <h2 class="doodle-text text-2xl" style="color: var(--dark-bg);">📋 All Categories</h2>
            <p class="handwritten text-xl text-gray-600 mt-1">Organize artworks by category</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn-add">
            + Add Category
        </a>
    </div>

    <!-- Table -->
    <div class="table-container fade-in delay-2">
        <table class="graffiti-table">
            <thead>
                <tr>
                    <th>📂 Category</th>
                    <th>🔗 Slug</th>
                    <th>🎨 Artworks</th>
                    <th>📚 Tutorials</th>
                    <th>⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                @if($category->image)
                                    <img src="{{ $category->image_url }}" alt="" class="category-thumb">
                                @else
                                    <div class="category-thumb flex items-center justify-center" style="background: var(--graffiti-cyan);">
                                        <span class="text-xl">📂</span>
                                    </div>
                                @endif
                                <span class="doodle-text text-sm">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td>
                            <code class="slug-code">{{ $category->slug }}</code>
                        </td>
                        <td class="doodle-text text-sm">{{ $category->artworks_count }}</td>
                        <td class="doodle-text text-sm">{{ $category->tutorials_count }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn-action btn-edit">
                                ✏️ Edit
                            </a>
                            @if($category->artworks_count == 0 && $category->tutorials_count == 0)
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-action btn-delete" 
                                            onclick="return confirm('🗑️ Delete this category? This cannot be undone!')">
                                        🗑️ Delete
                                    </button>
                                </form>
                            @else
                                <span class="handwritten text-sm text-gray-500">⚠️ In use</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <h3 class="empty-title">No Categories Yet</h3>
                            <p class="handwritten text-2xl text-gray-600 mb-4">Start organizing artworks by creating categories!</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn-add inline-block mt-4">
                                + Add First Category
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Info Section -->
    <div class="mt-8 fade-in delay-2">
        <div style="background: white; border: 3px dashed #000; border-radius: 16px; padding: 24px;">
            <h3 class="doodle-text text-xl mb-4" style="color: var(--dark-bg);">💡 Category Tips:</h3>
            <ul class="space-y-2">
                <li class="handwritten text-lg text-gray-700">✓ Categories help users discover art by style and medium</li>
                <li class="handwritten text-lg text-gray-700">✓ Categories can only be deleted when empty (no artworks or tutorials)</li>
                <li class="handwritten text-lg text-gray-700">✓ Add descriptive icons to make categories more recognizable</li>
                <li class="handwritten text-lg text-gray-700">✓ Keep category names clear and consistent</li>
            </ul>
        </div>
    </div>
</div>
@endsection