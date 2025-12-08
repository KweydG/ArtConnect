<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorialController extends Controller
{
    /**
     * Display a listing of tutorials.
     */
    public function index(Request $request)
    {
        $query = Tutorial::with(['user:id,name,avatar', 'category:id,name,slug']);

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

        // Difficulty filter
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Sort
        switch ($request->get('sort', 'latest')) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->latest();
        }

        $tutorials = $query->paginate($request->get('per_page', 15));

        return response()->json($tutorials);
    }

    /**
     * Store a newly created tutorial.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'duration' => ['required', 'integer', 'min:1', 'max:180'],
            'difficulty' => ['required', 'in:beginner,intermediate,advanced'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('tutorials', 'public');
        }

        $tutorial = auth()->user()->tutorials()->create($validated);

        return response()->json([
            'message' => 'Tutorial created successfully.',
            'data' => $tutorial->load(['user', 'category']),
        ], 201);
    }

    /**
     * Display the specified tutorial.
     */
    public function show(Tutorial $tutorial)
    {
        $tutorial->increment('views');

        $tutorial->load(['user', 'category']);

        return response()->json([
            'data' => $tutorial,
        ]);
    }

    /**
     * Update the specified tutorial.
     */
    public function update(Request $request, Tutorial $tutorial)
    {
        if ($tutorial->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string', 'max:500'],
            'content' => ['sometimes', 'string'],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'duration' => ['sometimes', 'integer', 'min:1', 'max:180'],
            'difficulty' => ['sometimes', 'in:beginner,intermediate,advanced'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($tutorial->image) {
                Storage::disk('public')->delete($tutorial->image);
            }
            $validated['image'] = $request->file('image')->store('tutorials', 'public');
        }

        $tutorial->update($validated);

        return response()->json([
            'message' => 'Tutorial updated successfully.',
            'data' => $tutorial->fresh(['user', 'category']),
        ]);
    }

    /**
     * Remove the specified tutorial.
     */
    public function destroy(Tutorial $tutorial)
    {
        if ($tutorial->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $tutorial->delete();

        return response()->json([
            'message' => 'Tutorial deleted successfully.',
        ]);
    }
}
