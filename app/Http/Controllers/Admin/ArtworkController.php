<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    /**
     * Display a listing of artworks.
     */
    public function index(Request $request)
    {
        $query = Artwork::with(['user', 'category'])->withCount(['comments', 'likes']);

        // Include trashed artworks if requested
        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $artworks = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.artworks.index', compact('artworks', 'categories'));
    }

    /**
     * Display the specified artwork.
     */
    public function show(Artwork $artwork)
    {
        $artwork->load(['user', 'category', 'comments.user', 'likes']);

        return view('admin.artworks.show', compact('artwork'));
    }

    /**
     * Show the form for editing the artwork.
     */
    public function edit(Artwork $artwork)
    {
        $categories = Category::all();

        return view('admin.artworks.edit', compact('artwork', 'categories'));
    }

    /**
     * Update the specified artwork.
     */
    public function update(Request $request, Artwork $artwork)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'medium' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'string'],
        ]);

        // Parse tags
        $tags = $validated['tags'] ?? '';
        $validated['tags'] = array_filter(array_map('trim', explode(',', $tags)));

        $artwork->update($validated);

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork updated successfully!');
    }

    /**
     * Soft delete the specified artwork.
     */
    public function destroy(Artwork $artwork)
    {
        $artwork->delete();

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork deleted successfully!');
    }

    /**
     * Restore a soft-deleted artwork.
     */
    public function restore($id)
    {
        $artwork = Artwork::onlyTrashed()->findOrFail($id);
        $artwork->restore();

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork restored successfully!');
    }

    /**
     * Permanently delete an artwork.
     */
    public function forceDelete($id)
    {
        $artwork = Artwork::onlyTrashed()->findOrFail($id);

        // Delete image file
        if ($artwork->image) {
            Storage::disk('public')->delete($artwork->image);
        }

        $artwork->forceDelete();

        return redirect()->route('admin.artworks.index', ['trashed' => true])
            ->with('success', 'Artwork permanently deleted!');
    }
}
