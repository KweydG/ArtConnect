@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Category Header -->
    <div class="card p-6 mb-8">
        <div class="flex items-center">
            @if($category->image)
                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-20 h-20 rounded-full object-cover mr-6">
            @else
                <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mr-6">
                    <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-gray-600 mt-2">{{ $category->description }}</p>
                @endif
                <div class="flex space-x-4 mt-2 text-sm text-gray-500">
                    <span>{{ $artworks->total() }} artworks</span>
                    <span>{{ $tutorials->count() }} tutorials</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tutorials in this category -->
    @if($tutorials->count() > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Learn {{ $category->name }}</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($tutorials as $tutorial)
                    <div class="card">
                        <div class="w-full h-32 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="p-4">
                            <span class="badge badge-{{ $tutorial->difficulty_color }} mb-2">{{ ucfirst($tutorial->difficulty) }}</span>
                            <h3 class="font-semibold text-gray-900">
                                <a href="{{ route('tutorials.show', $tutorial) }}" class="hover:text-indigo-600">{{ $tutorial->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">by {{ $tutorial->user->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Artworks -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Artworks in {{ $category->name }}</h2>
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
                    <a href="{{ route('artists.show', $artwork->user) }}" class="text-sm text-gray-500 hover:text-indigo-600">
                        by {{ $artwork->user->name }}
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full text-center py-12">No artworks in this category yet.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $artworks->links() }}
    </div>
</div>
@endsection
