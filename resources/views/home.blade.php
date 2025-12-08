@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Welcome to ArtConnect</h1>
            <p class="text-xl md:text-2xl mb-8 text-indigo-100">A Creative Community for Artists to Share, Learn, and Grow Together</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('explore') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                    Explore Art
                </a>
                @guest
                    <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition">
                        Join Community
                    </a>
                @endguest
            </div>
            <div class="mt-8 flex justify-center space-x-8 text-indigo-200">
                <span>SDG 4: Quality Education</span>
                <span>|</span>
                <span>SDG 11: Sustainable Cities</span>
            </div>
        </div>
    </div>
</section>

<!-- Featured Artworks -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Featured Artworks</h2>
            <a href="{{ route('artworks.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">View All →</a>
        </div>

        <div class="artwork-grid">
            @forelse($featuredArtworks as $artwork)
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
                <p class="text-gray-500 col-span-full text-center py-8">No artworks yet. Be the first to upload!</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Browse Categories</h2>
            <a href="{{ route('categories.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">View All →</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="card p-6 text-center hover:border-indigo-300 border-2 border-transparent">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $category->artworks_count }} artworks</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Learn Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Learn & Grow</h2>
                <p class="text-gray-600 mt-2">Explore tutorials from talented artists</p>
            </div>
            <a href="{{ route('tutorials.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">View All →</a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($featuredTutorials as $tutorial)
                <div class="card">
                    @if($tutorial->image)
                        <img src="{{ $tutorial->image_url }}" alt="{{ $tutorial->title }}" class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-4">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="badge badge-{{ $tutorial->difficulty_color }}">{{ ucfirst($tutorial->difficulty) }}</span>
                            <span class="text-sm text-gray-500">{{ $tutorial->duration }} min</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <a href="{{ route('tutorials.show', $tutorial) }}" class="hover:text-indigo-600">{{ $tutorial->title }}</a>
                        </h3>
                        <p class="text-sm text-gray-500">by {{ $tutorial->user->name }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center py-8">No tutorials yet.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Top Artists -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Featured Artists</h2>
            <a href="{{ route('artists.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">View All →</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($topArtists as $artist)
                <a href="{{ route('artists.show', $artist) }}" class="card p-4 text-center">
                    <img src="{{ $artist->avatar_url }}" alt="{{ $artist->name }}" class="w-16 h-16 rounded-full mx-auto mb-3 object-cover">
                    <h3 class="font-semibold text-gray-900 text-sm">{{ $artist->name }}</h3>
                    <p class="text-xs text-gray-500">{{ $artist->artworks_count }} artworks</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-indigo-600 text-white">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-4">Ready to Share Your Art?</h2>
        <p class="text-xl text-indigo-100 mb-8">Join our creative community and start sharing your artwork with the world.</p>
        @guest
            <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                Get Started Free
            </a>
        @else
            <a href="{{ route('artworks.create') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                Upload Your Art
            </a>
        @endguest
    </div>
</section>
@endsection
