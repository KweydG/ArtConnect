@extends('layouts.admin')

@section('title', 'Add Tutorial')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.tutorials.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-input" required>
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description *</label>
                <textarea name="description" id="description" rows="2" class="form-input" required>{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Content *</label>
                <textarea name="content" id="content" rows="10" class="form-input" required>{{ old('content') }}</textarea>
                @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="category_id" class="form-label">Category *</label>
                    <select name="category_id" id="category_id" class="form-input" required>
                        <option value="">Select</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="difficulty" class="form-label">Difficulty *</label>
                    <select name="difficulty" id="difficulty" class="form-input" required>
                        <option value="beginner" {{ old('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" {{ old('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="duration" class="form-label">Duration (minutes) *</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', 15) }}" min="1" max="180" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="image" class="form-label">Cover Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-input">
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.tutorials.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Tutorial</button>
            </div>
        </form>
    </div>
</div>
@endsection
