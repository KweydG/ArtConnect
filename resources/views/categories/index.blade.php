@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Browse Categories</h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <a href="{{ route('categories.show', $category) }}" class="card p-6 text-center hover:border-indigo-300 border-2 border-transparent transition">
                @if($category->image)
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                @else
                    <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $category->name }}</h3>
                @if($category->description)
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($category->description, 80) }}</p>
                @endif
                <div class="flex justify-center space-x-4 text-sm text-gray-500">
                    <span>{{ $category->artworks_count }} artworks</span>
                    <span>{{ $category->tutorials_count }} tutorials</span>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
