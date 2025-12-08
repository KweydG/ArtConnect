@extends('layouts.app')

@section('title', 'Learn')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">Learn & Grow</h1>
        <p class="text-xl text-indigo-100">Explore tutorials from talented artists and improve your skills</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Filters -->
    <div class="card p-4 mb-8">
        <form method="GET" action="{{ route('tutorials.index') }}" class="flex flex-wrap gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search tutorials..."
                   class="form-input flex-1">

            <select name="category" class="form-input">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="difficulty" class="form-input">
                <option value="">All Levels</option>
                <option value="beginner" {{ request('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="intermediate" {{ request('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                <option value="advanced" {{ request('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
            </select>

            <select name="sort" class="form-input">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Viewed</option>
            </select>

            <button type="submit" class="btn-primary">Filter</button>
        </form>
    </div>

    <!-- Tutorials Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tutorials as $tutorial)
            <div class="card">
                @if($tutorial->image)
                    <img src="{{ $tutorial->image_url }}" alt="{{ $tutorial->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="badge badge-{{ $tutorial->difficulty_color }}">{{ ucfirst($tutorial->difficulty) }}</span>
                        <span class="text-sm text-gray-500">{{ $tutorial->duration }} min</span>
                    </div>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">
                        <a href="{{ route('tutorials.show', $tutorial) }}" class="hover:text-indigo-600">{{ $tutorial->title }}</a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($tutorial->description, 100) }}</p>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('artists.show', $tutorial->user) }}" class="flex items-center text-sm text-gray-500 hover:text-indigo-600">
                            <img src="{{ $tutorial->user->avatar_url }}" alt="" class="w-6 h-6 rounded-full mr-2">
                            {{ $tutorial->user->name }}
                        </a>
                        <span class="text-sm text-gray-400">{{ $tutorial->views }} views</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <p class="text-gray-500 text-lg">No tutorials found</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $tutorials->links() }}
    </div>
</div>
@endsection
