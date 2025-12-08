@extends('layouts.app')

@section('title', $collection->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="card p-6 mb-8">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $collection->name }}</h1>
                <div class="flex items-center space-x-4 mt-2">
                    <a href="{{ route('artists.show', $collection->user) }}" class="text-gray-600 hover:text-indigo-600">
                        by {{ $collection->user->name }}
                    </a>
                    <span class="text-sm {{ $collection->is_public ? 'text-green-600' : 'text-gray-500' }}">
                        {{ $collection->is_public ? 'Public' : 'Private' }}
                    </span>
                </div>
                @if($collection->description)
                    <p class="text-gray-600 mt-4">{{ $collection->description }}</p>
                @endif
            </div>

            @can('update', $collection)
                <div class="flex space-x-3">
                    <a href="{{ route('collections.edit', $collection) }}" class="btn-secondary">Edit</a>
                    <form method="POST" action="{{ route('collections.destroy', $collection) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200"
                                onclick="return confirm('Delete this collection?')">Delete</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-900 mb-6">Artworks ({{ $collection->artworks->count() }})</h2>

    @if($collection->artworks->count() > 0)
        <div class="artwork-grid">
            @foreach($collection->artworks as $artwork)
                <div class="card artwork-card relative">
                    <a href="{{ route('artworks.show', $artwork) }}">
                        <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900">
                            <a href="{{ route('artworks.show', $artwork) }}" class="hover:text-indigo-600">{{ $artwork->title }}</a>
                        </h3>
                        <p class="text-sm text-gray-500">by {{ $artwork->user->name }}</p>
                    </div>

                    @can('update', $collection)
                        <form method="POST" action="{{ route('collections.remove-artwork', [$collection, $artwork]) }}"
                              class="absolute top-2 right-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600"
                                    onclick="return confirm('Remove from collection?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </form>
                    @endcan
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center py-12">No artworks in this collection yet.</p>
    @endif
</div>
@endsection
