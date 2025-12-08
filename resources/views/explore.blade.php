@extends('layouts.app')

@section('title', 'Explore')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">Explore Artworks</h1>

        <!-- Search & Filters -->
        <form method="GET" action="{{ route('explore') }}" class="flex flex-wrap gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search artworks..."
                   class="form-input w-full md:w-auto">

            <select name="category" class="form-input w-full md:w-auto">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="sort" class="form-input w-full md:w-auto">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Viewed</option>
                <option value="most_liked" {{ request('sort') == 'most_liked' ? 'selected' : '' }}>Most Liked</option>
            </select>

            <button type="submit" class="btn-primary">Search</button>
        </form>
    </div>

    <!-- Results -->
    <div class="artwork-grid">
        @forelse($artworks as $artwork)
            <div class="card artwork-card">
                <a href="{{ route('artworks.show', $artwork) }}" class="block relative group">
                    <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center">
                        <span class="text-white opacity-0 group-hover:opacity-100 transition-all">View Details</span>
                    </div>
                </a>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-1">
                        <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-indigo-600">{{ $artwork->title }}</a>
                    </h3>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <a href="{{ route('artists.show', $artwork->user) }}" class="flex items-center hover:text-indigo-600">
                            <img src="{{ $artwork->user->avatar_url }}" alt="" class="w-6 h-6 rounded-full mr-2">
                            {{ $artwork->user->name }}
                        </a>
                        <span class="badge badge-primary">{{ $artwork->category->name }}</span>
                    </div>
                    <div class="flex items-center space-x-4 text-sm text-gray-400">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path>
                            </svg>
                            {{ $artwork->likes_count }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $artwork->views }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-500 text-lg">No artworks found</p>
                <p class="text-gray-400">Try adjusting your search or filters</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $artworks->links() }}
    </div>
</div>
@endsection
