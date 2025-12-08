@extends('layouts.admin')

@section('title', 'Edit Artwork')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-6">
            <img src="{{ $artwork->image_url }}" alt="" class="w-48 h-48 rounded object-cover">
        </div>

        <form method="POST" action="{{ route('admin.artworks.update', $artwork) }}" class="space-y-6">
            @csrf @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $artwork->title) }}" class="form-input" required>
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="4" class="form-input">{{ old('description', $artwork->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Category *</label>
                <select name="category_id" id="category_id" class="form-input" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $artwork->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="medium" class="form-label">Medium</label>
                    <input type="text" name="medium" id="medium" value="{{ old('medium', $artwork->medium) }}" class="form-input">
                </div>
                <div class="form-group">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags', is_array($artwork->tags) ? implode(', ', $artwork->tags) : '') }}" class="form-input">
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.artworks.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Artwork</button>
            </div>
        </form>
    </div>
</div>
@endsection
