<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the user's collections.
     */
    public function index()
    {
        $collections = auth()->user()->collections()
            ->withCount('artworks')
            ->latest()
            ->paginate(12);

        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new collection.
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Store a newly created collection.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_public' => ['boolean'],
        ]);

        $collection = auth()->user()->collections()->create($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Collection created successfully!');
    }

    /**
     * Display the specified collection.
     */
    public function show(Collection $collection)
    {
        // Check if private collection belongs to current user
        if (!$collection->is_public && $collection->user_id !== auth()->id()) {
            abort(403, 'This collection is private.');
        }

        $collection->load(['user', 'artworks.user']);

        return view('collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the collection.
     */
    public function edit(Collection $collection)
    {
        $this->authorize('update', $collection);

        return view('collections.edit', compact('collection'));
    }

    /**
     * Update the specified collection.
     */
    public function update(Request $request, Collection $collection)
    {
        $this->authorize('update', $collection);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_public' => ['boolean'],
        ]);

        $collection->update($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Collection updated successfully!');
    }

    /**
     * Remove the specified collection.
     */
    public function destroy(Collection $collection)
    {
        $this->authorize('delete', $collection);

        $collection->delete();

        return redirect()->route('collections.index')
            ->with('success', 'Collection deleted successfully!');
    }

    /**
     * Add an artwork to a collection.
     */
    public function addArtwork(Collection $collection, Artwork $artwork)
    {
        $this->authorize('update', $collection);

        if ($collection->hasArtwork($artwork)) {
            return back()->with('error', 'Artwork is already in this collection.');
        }

        $collection->artworks()->attach($artwork->id);

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Artwork added to collection.']);
        }

        return back()->with('success', 'Artwork added to collection!');
    }

    /**
     * Remove an artwork from a collection.
     */
    public function removeArtwork(Collection $collection, Artwork $artwork)
    {
        $this->authorize('update', $collection);

        $collection->artworks()->detach($artwork->id);

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Artwork removed from collection.']);
        }

        return back()->with('success', 'Artwork removed from collection.');
    }
}
