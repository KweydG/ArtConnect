@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-input" required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-input" required>
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="password" class="form-label">New Password (leave blank to keep)</label>
                    <input type="password" name="password" id="password" class="form-input">
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Role *</label>
                <select name="role" id="role" class="form-input" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bio" class="form-label">Bio</label>
                <textarea name="bio" id="bio" rows="3" class="form-input">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="form-group">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}" class="form-input">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection
