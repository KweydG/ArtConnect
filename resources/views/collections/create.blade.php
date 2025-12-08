@extends('layouts.app')

@section('title', 'Create Collection')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="card p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Create Collection</h1>

        <form method="POST" action="{{ route('collections.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-input @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="form-input @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_public" id="is_public" value="1"
                       {{ old('is_public', true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <label for="is_public" class="ml-2 text-sm text-gray-700">Make this collection public</label>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('collections.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Create Collection</button>
            </div>
        </form>
    </div>
</div>
@endsection
