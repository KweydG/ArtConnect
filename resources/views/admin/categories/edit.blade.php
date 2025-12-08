@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-input" required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="3" class="form-input">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="form-group">
                @if($category->image)
                    <label class="form-label">Current Image</label>
                    <img src="{{ $category->image_url }}" alt="" class="w-24 h-24 rounded object-cover mb-4">
                @endif
                <label for="image" class="form-label">{{ $category->image ? 'Replace Image' : 'Image' }}</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-input">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
