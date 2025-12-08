@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex space-x-4">
        <a href="{{ route('admin.users.index') }}" class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">Active</a>
        <a href="{{ route('admin.users.index', ['trashed' => true]) }}" class="btn {{ request('trashed') ? 'btn-primary' : 'btn-secondary' }}">Trashed</a>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Add User</a>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-4">
        @if(request('trashed'))
            <input type="hidden" name="trashed" value="1">
        @endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." class="form-input flex-1">
        <select name="role" class="form-input">
            <option value="">All Roles</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Artworks</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>
                        <div class="flex items-center">
                            <img src="{{ $user->avatar_url }}" alt="" class="w-10 h-10 rounded-full mr-3">
                            <span class="font-medium">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge badge-{{ $user->role === 'admin' ? 'admin' : 'user' }}">{{ ucfirst($user->role) }}</span></td>
                    <td>{{ $user->artworks_count }}</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        @if(request('trashed'))
                            <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.force-delete', $user->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Permanently delete this user?')">Delete Forever</button>
                            </form>
                        @else
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm">Edit</a>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')">Delete</button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
