<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of artists.
     */
    public function index(Request $request)
    {
        $query = User::withCount(['artworks', 'followers', 'following'])
            ->where('role', 'user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
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

        $artists = $query->paginate(12)->withQueryString();

        return view('artists.index', compact('artists'));
    }

    /**
     * Display the specified artist profile.
     */
    public function show(User $user)
    {
        $user->load(['artworks.category', 'collections' => function ($query) {
            $query->where('is_public', true)->with('artworks');
        }]);

        $user->loadCount(['artworks', 'followers', 'following']);

        return view('artists.show', compact('user'));
    }

    /**
     * Show the form for editing the current user's profile.
     */
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    /**
     * Update the current user's profile.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
            'location' => ['nullable', 'string', 'max:100'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the current user's account (soft delete).
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = auth()->user();

        auth()->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }

    /**
     * Follow a user.
     */
    public function follow(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        auth()->user()->following()->syncWithoutDetaching([$user->id]);

        if (request()->expectsJson()) {
            return response()->json([
                'following' => true,
                'followers_count' => $user->followers()->count(),
            ]);
        }

        return back()->with('success', "You are now following {$user->name}!");
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);

        if (request()->expectsJson()) {
            return response()->json([
                'following' => false,
                'followers_count' => $user->followers()->count(),
            ]);
        }

        return back()->with('success', "You have unfollowed {$user->name}.");
    }
}
