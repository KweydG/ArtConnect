<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'artworks' => Artwork::count(),
            'tutorials' => Tutorial::count(),
            'comments' => Comment::count(),
            'categories' => Category::count(),
            'deleted_users' => User::onlyTrashed()->count(),
            'deleted_artworks' => Artwork::onlyTrashed()->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentArtworks = Artwork::with('user')->latest()->take(5)->get();
        $recentComments = Comment::with(['user', 'artwork'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentArtworks', 'recentComments'));
    }
}
