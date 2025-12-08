@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="card p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Profile</h1>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Avatar -->
            <div class="flex items-center space-x-6">
                <img src="{{ $user->avatar_url }}" alt="" class="w-24 h-24 rounded-full object-cover">
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Change Avatar</label>
                    <input type="file" name="avatar" id="avatar" accept="image/*" class="form-input">
                    @error('avatar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="form-input @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="form-input @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                <textarea name="bio" id="bio" rows="4" class="form-input @error('bio') border-red-500 @enderror">{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                    <input type="url" name="website" id="website" value="{{ old('website', $user->website) }}"
                           placeholder="https://example.com"
                           class="form-input @error('website') border-red-500 @enderror">
                    @error('website')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}"
                           placeholder="City, Country"
                           class="form-input @error('location') border-red-500 @enderror">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('artists.show', $user) }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="card p-8 mt-8 border-red-200">
        <h2 class="text-xl font-bold text-red-600 mb-4">Delete Account</h2>
        <p class="text-gray-600 mb-4">Once you delete your account, there is no going back. Please be certain.</p>

        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
            @csrf
            @method('DELETE')

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password" id="password" class="form-input w-full max-w-xs" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                Delete Account
            </button>
        </form>
    </div>
</div>
@endsection
