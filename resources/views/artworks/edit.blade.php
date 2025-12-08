@extends('layouts.app')

@section('title', 'Edit Artwork')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="card p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Artwork</h1>

        <form method="POST" action="{{ route('artworks.update', $artwork) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $artwork->title) }}"
                       class="form-input @error('title') border-red-500 @enderror" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="form-input @error('description') border-red-500 @enderror">{{ old('description', $artwork->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <select name="category_id" id="category_id" class="form-input @error('category_id') border-red-500 @enderror" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $artwork->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="w-48 h-48 object-cover rounded-lg mb-4">

                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Replace Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-input">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="medium" class="block text-sm font-medium text-gray-700 mb-1">Medium</label>
                    <input type="text" name="medium" id="medium" value="{{ old('medium', $artwork->medium) }}"
                           class="form-input @error('medium') border-red-500 @enderror">
                </div>

                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags', is_array($artwork->tags) ? implode(', ', $artwork->tags) : '') }}"
                           class="form-input @error('tags') border-red-500 @enderror">
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('artworks.show', $artwork) }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Update Artwork</button>
            </div>
        </form>
    </div>
</div>
@endsection
