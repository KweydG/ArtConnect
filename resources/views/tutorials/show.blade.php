@extends('layouts.app')

@section('title', $tutorial->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Tutorial Header -->
    <div class="card p-8 mb-8">
        <div class="flex items-center space-x-2 mb-4">
            <span class="badge badge-{{ $tutorial->difficulty_color }}">{{ ucfirst($tutorial->difficulty) }}</span>
            <span class="text-gray-500">•</span>
            <span class="text-gray-500">{{ $tutorial->duration }} min read</span>
            <span class="text-gray-500">•</span>
            <span class="text-gray-500">{{ $tutorial->views }} views</span>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $tutorial->title }}</h1>
        <p class="text-xl text-gray-600 mb-6">{{ $tutorial->description }}</p>

        <div class="flex items-center justify-between">
            <a href="{{ route('artists.show', $tutorial->user) }}" class="flex items-center hover:text-indigo-600">
                <img src="{{ $tutorial->user->avatar_url }}" alt="" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <p class="font-semibold text-gray-900">{{ $tutorial->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $tutorial->created_at->format('M d, Y') }}</p>
                </div>
            </a>

            <a href="{{ route('categories.show', $tutorial->category) }}" class="badge badge-primary">
                {{ $tutorial->category->name }}
            </a>
        </div>
    </div>

    <!-- Tutorial Image -->
    @if($tutorial->image)
        <div class="card overflow-hidden mb-8">
            <img src="{{ $tutorial->image_url }}" alt="{{ $tutorial->title }}" class="w-full">
        </div>
    @endif

    <!-- Tutorial Content -->
    <div class="card p-8 prose prose-lg max-w-none">
        {!! nl2br(e($tutorial->content)) !!}
    </div>

    <!-- Actions -->
    @can('update', $tutorial)
        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('tutorials.edit', $tutorial) }}" class="btn-secondary">Edit Tutorial</a>
            <form method="POST" action="{{ route('tutorials.destroy', $tutorial) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-100 text-red-600 px-6 py-2 rounded-lg hover:bg-red-200" onclick="return confirm('Delete this tutorial?')">
                    Delete
                </button>
            </form>
        </div>
    @endcan

    <!-- Related Tutorials -->
    @if($relatedTutorials->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Tutorials</h2>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($relatedTutorials as $related)
                    <div class="card p-6">
                        <span class="badge badge-{{ $related->difficulty_color }} mb-2">{{ ucfirst($related->difficulty) }}</span>
                        <h3 class="font-bold text-lg text-gray-900 mb-2">
                            <a href="{{ route('tutorials.show', $related) }}" class="hover:text-indigo-600">{{ $related->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($related->description, 80) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
