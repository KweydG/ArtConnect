@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold">All Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add Category</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Slug</th>
                <th>Artworks</th>
                <th>Tutorials</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>
                        <div class="flex items-center">
                            @if($category->image)
                                <img src="{{ $category->image_url }}" alt="" class="w-10 h-10 rounded mr-3 object-cover">
                            @endif
                            <span class="font-medium">{{ $category->name }}</span>
                        </div>
                    </td>
                    <td><code class="bg-gray-100 px-2 py-1 rounded text-sm">{{ $category->slug }}</code></td>
                    <td>{{ $category->artworks_count }}</td>
                    <td>{{ $category->tutorials_count }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary btn-sm">Edit</a>
                        @if($category->artworks_count == 0 && $category->tutorials_count == 0)
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this category?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-gray-500">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
