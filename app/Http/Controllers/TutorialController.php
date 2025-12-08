<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorialController extends Controller
{
    /**
     * Display a listing of tutorials (Learn page).
     */
    public function index(Request $request)
    {
        $query = Tutorial::with(['user', 'category']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
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

        $tutorials = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('tutorials.index', compact('tutorials', 'categories'));
    }

    /**
     * Show the form for creating a new tutorial.
     */
    public function create()
    {
        $categories = Category::all();

        return view('tutorials.create', compact('categories'));
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

        return redirect()->route('tutorials.show', $tutorial)
            ->with('success', 'Tutorial created successfully!');
    }

    /**
     * Display the specified tutorial.
     */
    public function show(Tutorial $tutorial)
    {
        $tutorial->increment('views');

        $tutorial->load(['user', 'category']);

        $relatedTutorials = Tutorial::where('category_id', $tutorial->category_id)
            ->where('id', '!=', $tutorial->id)
            ->with('user')
            ->take(4)
            ->get();

        return view('tutorials.show', compact('tutorial', 'relatedTutorials'));
    }

    /**
     * Show the form for editing the tutorial.
     */
    public function edit(Tutorial $tutorial)
    {
        $this->authorize('update', $tutorial);

        $categories = Category::all();

        return view('tutorials.edit', compact('tutorial', 'categories'));
    }

    /**
     * Update the specified tutorial.
     */
    public function update(Request $request, Tutorial $tutorial)
    {
        $this->authorize('update', $tutorial);

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
            if ($tutorial->image) {
                Storage::disk('public')->delete($tutorial->image);
            }
            $validated['image'] = $request->file('image')->store('tutorials', 'public');
        }

        $tutorial->update($validated);

        return redirect()->route('tutorials.show', $tutorial)
            ->with('success', 'Tutorial updated successfully!');
    }

    /**
     * Remove the specified tutorial (soft delete).
     */
    public function destroy(Tutorial $tutorial)
    {
        $this->authorize('delete', $tutorial);

        $tutorial->delete();

        return redirect()->route('tutorials.index')
            ->with('success', 'Tutorial deleted successfully!');
    }
}
