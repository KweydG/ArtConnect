@extends('layouts.app')

@section('title', 'Artworks')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">Artworks</h1>

        <form method="GET" action="{{ route('artworks.index') }}" class="flex gap-4">
            <select name="category" class="form-input" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="artwork-grid">
        @forelse($artworks as $artwork)
            <div class="card artwork-card">
                <a href="{{ route('artworks.show', $artwork) }}">
                    <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                </a>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-1">
                        <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-indigo-600">{{ $artwork->title }}</a>
                    </h3>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <a href="{{ route('artists.show', $artwork->user) }}" class="flex items-center hover:text-indigo-600">
                            <img src="{{ $artwork->user->avatar_url }}" alt="" class="w-6 h-6 rounded-full mr-2">
                            {{ $artwork->user->name }}
                        </a>
                        <span class="badge badge-primary">{{ $artwork->category->name }}</span>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full text-center py-12">No artworks found.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $artworks->links() }}
    </div>
</div>
@endsection
