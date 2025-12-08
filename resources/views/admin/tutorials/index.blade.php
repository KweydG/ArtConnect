@extends('layouts.admin')

@section('title', 'Manage Tutorials')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex space-x-4">
        <a href="{{ route('admin.tutorials.index') }}" class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">Active</a>
        <a href="{{ route('admin.tutorials.index', ['trashed' => true]) }}" class="btn {{ request('trashed') ? 'btn-primary' : 'btn-secondary' }}">Trashed</a>
    </div>
    <a href="{{ route('admin.tutorials.create') }}" class="btn btn-primary">+ Add Tutorial</a>
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
        <select name="difficulty" class="form-input">
            <option value="">All Levels</option>
            <option value="beginner" {{ request('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
            <option value="intermediate" {{ request('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
            <option value="advanced" {{ request('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="table">
        <thead>
            <tr>
                <th>Tutorial</th>
                <th>Author</th>
                <th>Category</th>
                <th>Difficulty</th>
                <th>Views</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tutorials as $tutorial)
                <tr>
                    <td class="font-medium">{{ $tutorial->title }}</td>
                    <td>{{ $tutorial->user->name }}</td>
                    <td>{{ $tutorial->category->name }}</td>
                    <td><span class="badge badge-{{ $tutorial->difficulty_color }}">{{ ucfirst($tutorial->difficulty) }}</span></td>
                    <td>{{ $tutorial->views }}</td>
                    <td>
                        @if(request('trashed'))
                            <form method="POST" action="{{ route('admin.tutorials.restore', $tutorial->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                            <form method="POST" action="{{ route('admin.tutorials.force-delete', $tutorial->id) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Permanently delete?')">Delete Forever</button>
                            </form>
                        @else
                            <a href="{{ route('admin.tutorials.edit', $tutorial) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.tutorials.destroy', $tutorial) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-8 text-gray-500">No tutorials found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $tutorials->links() }}</div>
@endsection
