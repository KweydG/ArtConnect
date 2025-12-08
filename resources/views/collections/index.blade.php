@extends('layouts.app')

@section('title', 'My Collections')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Collections</h1>
        <a href="{{ route('collections.create') }}" class="btn-primary">+ New Collection</a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($collections as $collection)
            <div class="card p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">
                            <a href="{{ route('collections.show', $collection) }}" class="hover:text-indigo-600">{{ $collection->name }}</a>
                        </h3>
                        <span class="text-sm {{ $collection->is_public ? 'text-green-600' : 'text-gray-500' }}">
                            {{ $collection->is_public ? 'Public' : 'Private' }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('collections.edit', $collection) }}" class="text-gray-400 hover:text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                @if($collection->description)
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($collection->description, 80) }}</p>
                @endif

                <p class="text-sm text-gray-500">{{ $collection->artworks_count }} artworks</p>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <p class="text-gray-500 text-lg">No collections yet</p>
                <a href="{{ route('collections.create') }}" class="text-indigo-600 hover:underline">Create your first collection</a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $collections->links() }}
    </div>
</div>
@endsection
