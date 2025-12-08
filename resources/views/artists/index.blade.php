@extends('layouts.app')

@section('title', 'Artists')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">Discover Artists</h1>

        <form method="GET" action="{{ route('artists.index') }}" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search artists..."
                   class="form-input">

            <select name="sort" class="form-input">
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Followed</option>
                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Recently Joined</option>
                <option value="artworks" {{ request('sort') == 'artworks' ? 'selected' : '' }}>Most Artworks</option>
            </select>

            <button type="submit" class="btn-primary">Search</button>
        </form>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($artists as $artist)
            <div class="card p-6">
                <div class="flex items-start">
                    <img src="{{ $artist->avatar_url }}" alt="{{ $artist->name }}" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-gray-900">
                            <a href="{{ route('artists.show', $artist) }}" class="hover:text-indigo-600">{{ $artist->name }}</a>
                        </h3>
                        @if($artist->location)
                            <p class="text-sm text-gray-500">{{ $artist->location }}</p>
                        @endif
                        @if($artist->bio)
                            <p class="text-gray-600 text-sm mt-2">{{ Str::limit($artist->bio, 80) }}</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4 pt-4 border-t text-sm text-gray-500">
                    <div class="flex space-x-4">
                        <span>{{ $artist->artworks_count }} artworks</span>
                        <span>{{ $artist->followers_count }} followers</span>
                    </div>

                    @auth
                        @if(auth()->id() !== $artist->id)
                            @if(auth()->user()->isFollowing($artist))
                                <form method="POST" action="{{ route('artists.unfollow', $artist) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-indigo-600 hover:underline">Unfollow</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('artists.follow', $artist) }}">
                                    @csrf
                                    <button type="submit" class="text-indigo-600 hover:underline">Follow</button>
                                </form>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full text-center py-12">No artists found.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $artists->links() }}
    </div>
</div>
@endsection
