@extends('layouts.admin')

@section('title', 'Manage Artworks')

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
        background: var(--graffiti-purple);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Toggle Buttons */
    .toggle-container {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
    }

    .toggle-btn {
        font-family: 'Permanent Marker', cursive;
        padding: 12px 28px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 15px;
        text-transform: uppercase;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .toggle-btn:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
    }

    .toggle-btn.active {
        background: var(--graffiti-cyan);
        color: var(--dark-bg);
    }

    .toggle-btn.inactive {
        background: white;
        color: var(--dark-bg);
    }

    /* Filter Bar */
    .filter-bar {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
        margin-bottom: 32px;
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
        min-width: 180px;
    }

    .graffiti-select:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-purple);
    }

    /* Filter Button */
    .btn-filter {
        font-family: 'Permanent Marker', cursive;
        padding: 14px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 16px;
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
        transition: all 0.3s;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        text-transform: uppercase;
        font-weight: bold;
    }

    .btn-filter:hover {
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

    /* Artwork Thumbnail */
    .artwork-thumb {
        width: 56px;
        height: 56px;
        border: 3px solid #000;
        border-radius: 8px;
        object-fit: cover;
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

    .btn-restore {
        background: var(--graffiti-green);
        color: var(--dark-bg);
    }

    .btn-forever {
        background: var(--graffiti-orange);
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

    /* Pagination */
    .pagination {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin-top: 32px;
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

        .filter-bar form {
            flex-direction: column;
        }

        .graffiti-input,
        .graffiti-select {
            width: 100%;
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
        🎨
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-8 fade-in">Manage Artworks</h1>

    <!-- Toggle Buttons -->
    <div class="toggle-container fade-in">
        <a href="{{ route('admin.artworks.index') }}" class="toggle-btn {{ !request('trashed') ? 'active' : 'inactive' }}">
            ✅ Active
        </a>
        <a href="{{ route('admin.artworks.index', ['trashed' => true]) }}" class="toggle-btn {{ request('trashed') ? 'active' : 'inactive' }}">
            🗑️ Trashed
        </a>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar fade-in delay-1">
        <form method="GET" class="flex flex-wrap gap-4">
            @if(request('trashed'))
                <input type="hidden" name="trashed" value="1">
            @endif

            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="🔍 Search artworks..."
                   class="graffiti-input flex-1 min-w-[200px]">

            <select name="category" class="graffiti-select">
                <option value="">📂 All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn-filter">
                Filter
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-container fade-in delay-2">
        <table class="graffiti-table">
            <thead>
                <tr>
                    <th>🎨 Artwork</th>
                    <th>👤 Artist</th>
                    <th>📂 Category</th>
                    <th>❤️ Likes</th>
                    <th>👁️ Views</th>
                    <th>⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artworks as $artwork)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <img src="{{ $artwork->image_url }}" alt="" class="artwork-thumb">
                                <span class="doodle-text text-sm">{{ $artwork->title }}</span>
                            </div>
                        </td>
                        <td class="handwritten text-lg">{{ $artwork->user->name }}</td>
                        <td class="handwritten text-lg">{{ $artwork->category->name }}</td>
                        <td class="doodle-text text-sm">{{ $artwork->likes_count }}</td>
                        <td class="doodle-text text-sm">{{ $artwork->views }}</td>
                        <td>
                            @if(request('trashed'))
                                <form method="POST" action="{{ route('admin.artworks.restore', $artwork->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="btn-action btn-restore">
                                        ↩️ Restore
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.artworks.force-delete', $artwork->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-action btn-forever" 
                                            onclick="return confirm('⚠️ Permanently delete this artwork? This cannot be undone!')">
                                        🔥 Delete Forever
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('admin.artworks.edit', $artwork) }}" class="btn-action btn-edit">
                                    ✏️ Edit
                                </a>
                                <form method="POST" action="{{ route('admin.artworks.destroy', $artwork) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-action btn-delete" 
                                            onclick="return confirm('🗑️ Move this artwork to trash?')">
                                        🗑️ Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="empty-title">No Artworks Found</h3>
                            <p class="handwritten text-2xl text-gray-600">
                                @if(request('search') || request('category'))
                                    Try adjusting your filters
                                @elseif(request('trashed'))
                                    No trashed artworks
                                @else
                                    No artworks yet
                                @endif
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($artworks->hasPages())
        <div class="pagination fade-in delay-2">
            {{ $artworks->links() }}
        </div>
    @endif
</div>
@endsection