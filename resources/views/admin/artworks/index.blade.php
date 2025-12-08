@extends('layouts.admin')

@section('title', 'Manage Artworks')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex space-x-4">
        <a href="{{ route('admin.artworks.index') }}" class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">Active</a>
        <a href="{{ route('admin.artworks.index', ['trashed' => true]) }}" class="btn {{ request('trashed') ? 'btn-primary' : 'btn-secondary' }}">Trashed</a>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" class="flex gap-4">
        @if(request('trashed')) <input type="hidden" name="trashed" value="1"> @endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-input flex-1">
        <select name="category" class="form-input">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="table">
        <thead>
            <tr>
                <th>Artwork</th>
                <th>Artist</th>
                <th>Category</th>
                <th>Likes</th>
                <th>Views</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artworks as $artwork)
                <tr>
                    <td>
                        <div class="flex items-center">
                            <img src="{{ $artwork->image_url }}" alt="" class="w-12 h-12 rounded object-cover mr-3">
                            <span class="font-medium">{{ $artwork->title }}</span>
                        </div>
                    </td>
                    <td>{{ $artwork->user->name }}</td>
                    <td>{{ $artwork->category->name }}</td>
                    <td>{{ $artwork->likes_count }}</td>
                    <td>{{ $artwork->views }}</td>
                    <td>
                        @if(request('trashed'))
                            <form method="POST" action="{{ route('admin.artworks.restore', $artwork->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                            <form method="POST" action="{{ route('admin.artworks.force-delete', $artwork->id) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Permanently delete?')">Delete Forever</button>
                            </form>
                        @else
                            <a href="{{ route('admin.artworks.edit', $artwork) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.artworks.destroy', $artwork) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-8 text-gray-500">No artworks found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $artworks->links() }}</div>
@endsection
