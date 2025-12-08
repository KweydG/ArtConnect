<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        return response()->json([
            'data' => $categories,
        ]);
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        $category->loadCount(['artworks', 'tutorials']);

        return response()->json([
            'data' => $category,
        ]);
    }
}
