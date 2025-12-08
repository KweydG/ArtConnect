<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $query = Tutorial::with(['user', 'category']);

        // Include trashed tutorials if requested
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

        // Filter by difficulty
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        $tutorials = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.tutorials.index', compact('tutorials', 'categories'));
    }

    /**
     * Show the form for creating a new tutorial.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.tutorials.create', compact('categories'));
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

        $validated['user_id'] = auth()->id();

        Tutorial::create($validated);

        return redirect()->route('admin.tutorials.index')
            ->with('success', 'Tutorial created successfully!');
    }

    /**
     * Display the specified tutorial.
     */
    public function show(Tutorial $tutorial)
    {
        $tutorial->load(['user', 'category']);

        return view('admin.tutorials.show', compact('tutorial'));
    }

    /**
     * Show the form for editing the tutorial.
     */
    public function edit(Tutorial $tutorial)
    {
        $categories = Category::all();

        return view('admin.tutorials.edit', compact('tutorial', 'categories'));
    }

    /**
     * Update the specified tutorial.
     */
    public function update(Request $request, Tutorial $tutorial)
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
            if ($tutorial->image) {
                Storage::disk('public')->delete($tutorial->image);
            }
            $validated['image'] = $request->file('image')->store('tutorials', 'public');
        }

        $tutorial->update($validated);

        return redirect()->route('admin.tutorials.index')
            ->with('success', 'Tutorial updated successfully!');
    }

    /**
     * Soft delete the specified tutorial.
     */
    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();

        return redirect()->route('admin.tutorials.index')
            ->with('success', 'Tutorial deleted successfully!');
    }

    /**
     * Restore a soft-deleted tutorial.
     */
    public function restore($id)
    {
        $tutorial = Tutorial::onlyTrashed()->findOrFail($id);
        $tutorial->restore();

        return redirect()->route('admin.tutorials.index')
            ->with('success', 'Tutorial restored successfully!');
    }

    /**
     * Permanently delete a tutorial.
     */
    public function forceDelete($id)
    {
        $tutorial = Tutorial::onlyTrashed()->findOrFail($id);

        // Delete image file
        if ($tutorial->image) {
            Storage::disk('public')->delete($tutorial->image);
        }

        $tutorial->forceDelete();

        return redirect()->route('admin.tutorials.index', ['trashed' => true])
            ->with('success', 'Tutorial permanently deleted!');
    }
}
