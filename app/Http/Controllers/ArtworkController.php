<?php

namespace App\Http\Controllers;

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
        $query = Artwork::with(['user', 'category']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $artworks = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('artworks.index', compact('artworks', 'categories'));
    }

    /**
     * Show the form for creating a new artwork.
     */
    public function create()
    {
        $categories = Category::all();

        return view('artworks.create', compact('categories'));
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
            'tags' => ['nullable', 'string'],
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('artworks', 'public');

        // Parse tags
        $tags = $validated['tags'] ?? '';
        $tagsArray = array_filter(array_map('trim', explode(',', $tags)));

        $artwork = auth()->user()->artworks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'medium' => $validated['medium'],
            'tags' => $tagsArray,
        ]);

        return redirect()->route('artworks.show', $artwork)
            ->with('success', 'Artwork uploaded successfully!');
    }

    /**
     * Display the specified artwork.
     */
    public function show(Artwork $artwork)
    {
        $artwork->increment('views');

        $artwork->load(['user', 'category', 'comments.user', 'likes']);

        $relatedArtworks = Artwork::where('category_id', $artwork->category_id)
            ->where('id', '!=', $artwork->id)
            ->with('user')
            ->take(4)
            ->get();

        return view('artworks.show', compact('artwork', 'relatedArtworks'));
    }

    /**
     * Show the form for editing the artwork.
     */
    public function edit(Artwork $artwork)
    {
        $this->authorize('update', $artwork);

        $categories = Category::all();

        return view('artworks.edit', compact('artwork', 'categories'));
    }

    /**
     * Update the specified artwork.
     */
    public function update(Request $request, Artwork $artwork)
    {
        $this->authorize('update', $artwork);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'medium' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'string'],
        ]);

        // Handle image upload if new image provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($artwork->image) {
                Storage::disk('public')->delete($artwork->image);
            }
            $validated['image'] = $request->file('image')->store('artworks', 'public');
        }

        // Parse tags
        $tags = $validated['tags'] ?? '';
        $validated['tags'] = array_filter(array_map('trim', explode(',', $tags)));

        $artwork->update($validated);

        return redirect()->route('artworks.show', $artwork)
            ->with('success', 'Artwork updated successfully!');
    }

    /**
     * Remove the specified artwork (soft delete).
     */
    public function destroy(Artwork $artwork)
    {
        $this->authorize('delete', $artwork);

        $artwork->delete();

        return redirect()->route('home')
            ->with('success', 'Artwork deleted successfully!');
    }
}
