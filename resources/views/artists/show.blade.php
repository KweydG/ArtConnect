@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Profile Header -->
    <div class="card p-8 mb-8">
        <div class="flex flex-col md:flex-row items-center md:items-start">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover mb-4 md:mb-0 md:mr-8">

            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>

                @if($user->location)
                    <p class="text-gray-500 mt-1">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $user->location }}
                    </p>
                @endif

                @if($user->bio)
                    <p class="text-gray-600 mt-4 max-w-2xl">{{ $user->bio }}</p>
                @endif

                @if($user->website)
                    <a href="{{ $user->website }}" target="_blank" class="text-indigo-600 hover:underline mt-2 inline-block">
                        {{ parse_url($user->website, PHP_URL_HOST) }}
                    </a>
                @endif

                <div class="flex justify-center md:justify-start space-x-8 mt-6 text-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->artworks_count }}</p>
                        <p class="text-sm text-gray-500">Artworks</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->followers_count }}</p>
                        <p class="text-sm text-gray-500">Followers</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->following_count }}</p>
                        <p class="text-sm text-gray-500">Following</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 md:mt-0">
                @auth
                    @if(auth()->id() === $user->id)
                        <a href="{{ route('profile.edit') }}" class="btn-secondary">Edit Profile</a>
                    @else
                        @if(auth()->user()->isFollowing($user))
                            <form method="POST" action="{{ route('artists.unfollow', $user) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-secondary">Unfollow</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('artists.follow', $user) }}">
                                @csrf
                                <button type="submit" class="btn-primary">Follow</button>
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Artworks -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Artworks by {{ $user->name }}</h2>

    @if($user->artworks->count() > 0)
        <div class="artwork-grid">
            @foreach($user->artworks as $artwork)
                <div class="card artwork-card">
                    <a href="{{ route('artworks.show', $artwork) }}">
                        <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900">
                            <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-indigo-600">{{ $artwork->title }}</a>
                        </h3>
                        <span class="text-sm text-gray-500">{{ $artwork->category->name }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center py-12">No artworks yet.</p>
    @endif

    <!-- Collections -->
    @if($user->collections->count() > 0)
        <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6">Collections</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($user->collections as $collection)
                <a href="{{ route('collections.show', $collection) }}" class="card p-6 hover:border-indigo-300 border-2 border-transparent">
                    <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $collection->name }}</h3>
                    @if($collection->description)
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($collection->description, 60) }}</p>
                    @endif
                    <p class="text-sm text-gray-500">{{ $collection->artworks->count() }} artworks</p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
