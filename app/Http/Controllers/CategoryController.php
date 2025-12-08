<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::withCount(['artworks', 'tutorials'])->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        $artworks = $category->artworks()
            ->with('user')
            ->latest()
            ->paginate(12);

        $tutorials = $category->tutorials()
            ->with('user')
            ->latest()
            ->take(4)
            ->get();

        return view('categories.show', compact('category', 'artworks', 'tutorials'));
    }
}
