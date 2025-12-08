<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    /**
     * Display a listing of artworks.
     */
    public function index(Request $request)
    {
        $query = Artwork::with(['user:id,name,avatar', 'category:id,name,slug'])
            ->withCount(['likes', 'comments']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Sort
        switch ($request->get('sort', 'latest')) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'most_liked':
                $query->orderBy('likes_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $artworks = $query->paginate($request->get('per_page', 15));

        return response()->json($artworks);
    }

    /**
     * Store a newly created artwork.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'medium' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'array'],
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('artworks', 'public');

        $artwork = auth()->user()->artworks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'medium' => $validated['medium'] ?? null,
            'tags' => $validated['tags'] ?? [],
        ]);

        return response()->json([
            'message' => 'Artwork created successfully.',
            'data' => $artwork->load(['user', 'category']),
        ], 201);
    }

    /**
     * Display the specified artwork.
     */
    public function show(Artwork $artwork)
    {
        $artwork->increment('views');

        $artwork->load(['user', 'category', 'comments.user'])
            ->loadCount(['likes', 'comments']);

        return response()->json([
            'data' => $artwork,
        ]);
    }

    /**
     * Update the specified artwork.
     */
    public function update(Request $request, Artwork $artwork)
    {
        if ($artwork->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'medium' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'array'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($artwork->image) {
                Storage::disk('public')->delete($artwork->image);
            }
            $validated['image'] = $request->file('image')->store('artworks', 'public');
        }

        $artwork->update($validated);

        return response()->json([
            'message' => 'Artwork updated successfully.',
            'data' => $artwork->fresh(['user', 'category']),
        ]);
    }

    /**
     * Remove the specified artwork.
     */
    public function destroy(Artwork $artwork)
    {
        if ($artwork->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $artwork->delete();

        return response()->json([
            'message' => 'Artwork deleted successfully.',
        ]);
    }

    /**
     * Like an artwork.
     */
    public function like(Artwork $artwork)
    {
        $artwork->likes()->firstOrCreate(['user_id' => auth()->id()]);

        return response()->json([
            'message' => 'Artwork liked.',
            'likes_count' => $artwork->likes()->count(),
        ]);
    }

    /**
     * Unlike an artwork.
     */
    public function unlike(Artwork $artwork)
    {
        $artwork->likes()->where('user_id', auth()->id())->delete();

        return response()->json([
            'message' => 'Like removed.',
            'likes_count' => $artwork->likes()->count(),
        ]);
    }

    /**
     * Restore a soft-deleted artwork (admin only).
     */
    public function restore($id)
    {
        $artwork = Artwork::onlyTrashed()->findOrFail($id);
        $artwork->restore();

        return response()->json([
            'message' => 'Artwork restored successfully.',
            'data' => $artwork,
        ]);
    }

    /**
     * Permanently delete an artwork (admin only).
     */
    public function forceDelete($id)
    {
        $artwork = Artwork::onlyTrashed()->findOrFail($id);

        if ($artwork->image) {
            Storage::disk('public')->delete($artwork->image);
        }

        $artwork->forceDelete();

        return response()->json([
            'message' => 'Artwork permanently deleted.',
        ]);
    }
}
