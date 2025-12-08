@extends('layouts.app')

@section('title', $artwork->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Artwork Image -->
        <div class="lg:col-span-2">
            <div class="card overflow-hidden">
                <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-full">
            </div>

            <!-- Comments Section -->
            <div class="card mt-6 p-6">
                <h3 class="text-xl font-bold mb-4">Comments ({{ $artwork->comments->count() }})</h3>

                @auth
                    <form method="POST" action="{{ route('comments.store', $artwork) }}" class="mb-6">
                        @csrf
                        <textarea name="content" rows="3" placeholder="Share your thoughts..."
                                  class="form-input mb-3 @error('content') border-red-500 @enderror"
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn-primary">Post Comment</button>
                    </form>
                @else
                    <p class="text-gray-500 mb-6">
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a> to leave a comment.
                    </p>
                @endauth

                <div class="space-y-4">
                    @forelse($artwork->comments as $comment)
                        <div class="flex space-x-4 p-4 bg-gray-50 rounded-lg">
                            <img src="{{ $comment->user->avatar_url }}" alt="" class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('artists.show', $comment->user) }}" class="font-semibold text-gray-900 hover:text-indigo-600">
                                        {{ $comment->user->name }}
                                    </a>
                                    <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 mt-1">{{ $comment->content }}</p>
                                @can('delete', $comment)
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 text-sm hover:underline" onclick="return confirm('Delete this comment?')">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No comments yet. Be the first to comment!</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Artwork Info -->
            <div class="card p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $artwork->title }}</h1>

                <div class="flex items-center space-x-4 mb-4">
                    <a href="{{ route('artists.show', $artwork->user) }}" class="flex items-center hover:text-indigo-600">
                        <img src="{{ $artwork->user->avatar_url }}" alt="" class="w-12 h-12 rounded-full mr-3">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $artwork->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $artwork->created_at->format('M d, Y') }}</p>
                        </div>
                    </a>
                </div>

                <div class="flex items-center space-x-4 mb-6">
                    @auth
                        <form method="POST" action="{{ route('likes.toggle', $artwork) }}">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 {{ $artwork->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400' }} hover:text-red-500">
                                <svg class="w-6 h-6" fill="{{ $artwork->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span>{{ $artwork->likes->count() }}</span>
                            </button>
                        </form>
                    @else
                        <span class="flex items-center space-x-2 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span>{{ $artwork->likes->count() }}</span>
                        </span>
                    @endauth

                    <span class="flex items-center space-x-2 text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span>{{ $artwork->views }}</span>
                    </span>

                    <span class="flex items-center space-x-2 text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <span>{{ $artwork->comments->count() }}</span>
                    </span>
                </div>

                @if($artwork->description)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-700">{{ $artwork->description }}</p>
                    </div>
                @endif

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Category</span>
                        <a href="{{ route('categories.show', $artwork->category) }}" class="text-indigo-600 hover:underline">
                            {{ $artwork->category->name }}
                        </a>
                    </div>
                    @if($artwork->medium)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Medium</span>
                            <span class="text-gray-900">{{ $artwork->medium }}</span>
                        </div>
                    @endif
                </div>

                @if($artwork->tags && count($artwork->tags) > 0)
                    <div class="mt-4 pt-4 border-t">
                        <div class="flex flex-wrap gap-2">
                            @foreach($artwork->tags as $tag)
                                <span class="badge badge-primary">#{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @can('update', $artwork)
                    <div class="mt-6 pt-4 border-t flex space-x-3">
                        <a href="{{ route('artworks.edit', $artwork) }}" class="btn-secondary flex-1 text-center">Edit</a>
                        <form method="POST" action="{{ route('artworks.destroy', $artwork) }}" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200" onclick="return confirm('Delete this artwork?')">
                                Delete
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            <!-- Follow Artist -->
            @auth
                @if(auth()->id() !== $artwork->user_id)
                    <div class="card p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $artwork->user->avatar_url }}" alt="" class="w-12 h-12 rounded-full mr-3">
                                <div>
                                    <p class="font-semibold">{{ $artwork->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $artwork->user->artworks->count() }} artworks</p>
                                </div>
                            </div>
                            @if(auth()->user()->isFollowing($artwork->user))
                                <form method="POST" action="{{ route('artists.unfollow', $artwork->user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-secondary text-sm">Unfollow</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('artists.follow', $artwork->user) }}">
                                    @csrf
                                    <button type="submit" class="btn-primary text-sm">Follow</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- Related Artworks -->
    @if($relatedArtworks->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">More from {{ $artwork->category->name }}</h2>
            <div class="artwork-grid">
                @foreach($relatedArtworks as $related)
                    <div class="card artwork-card">
                        <a href="{{ route('artworks.show', $related) }}">
                            <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900">
                                <a href="{{ route('artworks.show', $related) }}" class="hover:text-indigo-600">{{ $related->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500">by {{ $related->user->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
