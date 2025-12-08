@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Users</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['users'] }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
        @if($stats['deleted_users'] > 0)
            <p class="text-sm text-gray-500 mt-2">{{ $stats['deleted_users'] }} deleted</p>
        @endif
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Artworks</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['artworks'] }}</p>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        @if($stats['deleted_artworks'] > 0)
            <p class="text-sm text-gray-500 mt-2">{{ $stats['deleted_artworks'] }} deleted</p>
        @endif
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Tutorials</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['tutorials'] }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Categories</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['categories'] }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <!-- Recent Users -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Users</h2>
        <div class="space-y-4">
            @foreach($recentUsers as $user)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ $user->avatar_url }}" alt="" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-medium text-gray-900">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <span class="badge badge-{{ $user->role === 'admin' ? 'admin' : 'user' }}">{{ ucfirst($user->role) }}</span>
                </div>
            @endforeach
        </div>
        <a href="{{ route('admin.users.index') }}" class="block text-center text-indigo-600 hover:underline mt-4">View All Users</a>
    </div>

    <!-- Recent Artworks -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Artworks</h2>
        <div class="space-y-4">
            @foreach($recentArtworks as $artwork)
                <div class="flex items-center">
                    <img src="{{ $artwork->image_url }}" alt="" class="w-12 h-12 rounded object-cover mr-3">
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $artwork->title }}</p>
                        <p class="text-sm text-gray-500">by {{ $artwork->user->name }}</p>
                    </div>
                    <span class="text-sm text-gray-500">{{ $artwork->created_at->diffForHumans() }}</span>
                </div>
            @endforeach
        </div>
        <a href="{{ route('admin.artworks.index') }}" class="block text-center text-indigo-600 hover:underline mt-4">View All Artworks</a>
    </div>
</div>

<!-- Recent Comments -->
<div class="bg-white rounded-lg shadow p-6 mt-6">
    <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Comments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Comment</th>
                <th>Artwork</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentComments as $comment)
                <tr>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ Str::limit($comment->content, 50) }}</td>
                    <td>{{ $comment->artwork->title }}</td>
                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
