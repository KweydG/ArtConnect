@extends('layouts.admin')

@section('title', 'Manage Users')

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
        background: var(--graffiti-cyan);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }

    /* Toggle Buttons */
    .toggle-container {
        display: flex;
        gap: 12px;
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

    /* Add Button */
    .btn-add {
        font-family: 'Permanent Marker', cursive;
        padding: 14px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 16px;
        background: var(--graffiti-purple);
        color: white;
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
        min-width: 160px;
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

    /* Role Badge */
    .role-badge {
        font-family: 'Permanent Marker', cursive;
        font-size: 12px;
        padding: 4px 12px;
        border: 2px solid #000;
        border-radius: 20px;
        display: inline-block;
        transform: rotate(-1deg);
    }

    .role-badge.admin {
        background: var(--graffiti-purple);
        color: white;
    }

    .role-badge.user {
        background: var(--graffiti-green);
        color: var(--dark-bg);
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

        .header-section {
            flex-direction: column;
            align-items: flex-start;
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
        👥
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-8 fade-in">Manage Users</h1>

    <!-- Header Section -->
    <div class="header-section fade-in">
        <div class="toggle-container">
            <a href="{{ route('admin.users.index') }}" class="toggle-btn {{ !request('trashed') ? 'active' : 'inactive' }}">
                ✅ Active
            </a>
            <a href="{{ route('admin.users.index', ['trashed' => true]) }}" class="toggle-btn {{ request('trashed') ? 'active' : 'inactive' }}">
                🗑️ Trashed
            </a>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-add">
            + Add User
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
                   placeholder="🔍 Search users..."
                   class="graffiti-input flex-1 min-w-[200px]">

            <select name="role" class="graffiti-select">
                <option value="">👤 All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>🎨 User</option>
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
                    <th>👤 User</th>
                    <th>📧 Email</th>
                    <th>🎭 Role</th>
                    <th>🎨 Artworks</th>
                    <th>💬 Comments</th>
                    <th>⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="doodle-text text-sm">{{ $user->name }}</td>
                        <td class="handwritten text-lg">{{ $user->email }}</td>
                        <td>
                            <span class="role-badge {{ $user->role }}">
                                @if($user->role == 'admin')
                                    👑 Admin
                                @else
                                    🎨 User
                                @endif
                            </span>
                        </td>
                        <td class="doodle-text text-sm">{{ $user->artworks_count }}</td>
                        <td class="doodle-text text-sm">{{ $user->comments_count }}</td>
                        <td>
                            @if(request('trashed'))
                                <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="btn-action btn-restore">
                                        ↩️ Restore
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.force-delete', $user->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-action btn-forever"
                                            onclick="return confirm('⚠️ Permanently delete this user? This cannot be undone!')">
                                        🔥 Delete Forever
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-edit">
                                    ✏️ Edit
                                </a>
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn-action btn-delete"
                                                onclick="return confirm('🗑️ Move this user to trash?')">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="empty-title">No Users Found</h3>
                            <p class="handwritten text-2xl text-gray-600">
                                @if(request('search') || request('role'))
                                    Try adjusting your filters
                                @elseif(request('trashed'))
                                    No trashed users
                                @else
                                    No users yet
                                @endif
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="pagination fade-in delay-2">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
