<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'user')
            ->withCount(['artworks', 'followers', 'following']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        // Sort
        switch ($request->get('sort', 'popular')) {
            case 'recent':
                $query->latest();
                break;
            case 'artworks':
                $query->orderBy('artworks_count', 'desc');
                break;
            default:
                $query->orderBy('followers_count', 'desc');
        }

        $users = $query->paginate($request->get('per_page', 15));

        return response()->json($users);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->loadCount(['artworks', 'followers', 'following']);

        return response()->json([
            'data' => $user,
        ]);
    }

    /**
     * Display artworks by a user.
     */
    public function artworks(User $user, Request $request)
    {
        $artworks = $user->artworks()
            ->with(['category'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->paginate($request->get('per_page', 15));

        return response()->json($artworks);
    }

    /**
     * Follow a user.
     */
    public function follow(User $user)
    {
        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'You cannot follow yourself.'], 400);
        }

        auth()->user()->following()->syncWithoutDetaching([$user->id]);

        return response()->json([
            'message' => 'You are now following ' . $user->name,
            'followers_count' => $user->followers()->count(),
        ]);
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);

        return response()->json([
            'message' => 'You have unfollowed ' . $user->name,
            'followers_count' => $user->followers()->count(),
        ]);
    }

    /**
     * Admin: Display all users including admins.
     */
    public function adminIndex(Request $request)
    {
        $query = User::withCount(['artworks', 'comments']);

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate($request->get('per_page', 15));

        return response()->json($users);
    }

    /**
     * Restore a soft-deleted user (admin only).
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return response()->json([
            'message' => 'User restored successfully.',
            'data' => $user,
        ]);
    }

    /**
     * Permanently delete a user (admin only).
     */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return response()->json([
            'message' => 'User permanently deleted.',
        ]);
    }
}
