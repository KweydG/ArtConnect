<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $featuredArtworks = Artwork::with(['user', 'category'])
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount('artworks')
            ->orderBy('artworks_count', 'desc')
            ->take(6)
            ->get();

        $featuredTutorials = Tutorial::with(['user', 'category'])
            ->latest()
            ->take(4)
            ->get();

        $topArtists = User::withCount('artworks')
            ->where('role', 'user')
            ->orderBy('artworks_count', 'desc')
            ->take(6)
            ->get();

        return view('home', compact(
            'featuredArtworks',
            'categories',
            'featuredTutorials',
            'topArtists'
        ));
    }

    /**
     * Display the explore page with search and filters.
     */
    public function explore(Request $request)
    {
        $query = Artwork::with(['user', 'category']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Medium filter
        if ($request->filled('medium')) {
            $query->where('medium', $request->medium);
        }

        // Sort
        switch ($request->get('sort', 'latest')) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'most_liked':
                $query->withCount('likes')->orderBy('likes_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $artworks = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('explore', compact('artworks', 'categories'));
    }
}
