<?php

use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TutorialController as AdminTutorialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/explore', [HomeController::class, 'explore'])->name('explore');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Artworks (public viewing)
Route::get('/artworks', [ArtworkController::class, 'index'])->name('artworks.index');

// Artworks CRUD (must be before {artwork} route)
Route::middleware('auth')->group(function () {
    Route::get('/artworks/create', [ArtworkController::class, 'create'])->name('artworks.create');
    Route::post('/artworks', [ArtworkController::class, 'store'])->name('artworks.store');
    Route::get('/artworks/{artwork}/edit', [ArtworkController::class, 'edit'])->name('artworks.edit');
    Route::put('/artworks/{artwork}', [ArtworkController::class, 'update'])->name('artworks.update');
    Route::delete('/artworks/{artwork}', [ArtworkController::class, 'destroy'])->name('artworks.destroy');
});

Route::get('/artworks/{artwork}', [ArtworkController::class, 'show'])->name('artworks.show');

// Tutorials (Learn section)
Route::get('/learn', [TutorialController::class, 'index'])->name('tutorials.index');
Route::get('/learn/{tutorial}', [TutorialController::class, 'show'])->name('tutorials.show');

// User profiles (public)
Route::get('/artists', [ProfileController::class, 'index'])->name('artists.index');
Route::get('/artists/{user}', [ProfileController::class, 'show'])->name('artists.show');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Comments
    Route::post('/artworks/{artwork}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Likes
    Route::post('/artworks/{artwork}/like', [LikeController::class, 'toggle'])->name('likes.toggle');

    // Follow/Unfollow
    Route::post('/artists/{user}/follow', [ProfileController::class, 'follow'])->name('artists.follow');
    Route::delete('/artists/{user}/unfollow', [ProfileController::class, 'unfollow'])->name('artists.unfollow');

    // Collections
    Route::resource('collections', CollectionController::class);
    Route::post('/collections/{collection}/artworks/{artwork}', [CollectionController::class, 'addArtwork'])->name('collections.add-artwork');
    Route::delete('/collections/{collection}/artworks/{artwork}', [CollectionController::class, 'removeArtwork'])->name('collections.remove-artwork');

    // Tutorials CRUD (for users who can create tutorials)
    Route::get('/tutorials/create', [TutorialController::class, 'create'])->name('tutorials.create');
    Route::post('/tutorials', [TutorialController::class, 'store'])->name('tutorials.store');
    Route::get('/tutorials/{tutorial}/edit', [TutorialController::class, 'edit'])->name('tutorials.edit');
    Route::put('/tutorials/{tutorial}', [TutorialController::class, 'update'])->name('tutorials.update');
    Route::delete('/tutorials/{tutorial}', [TutorialController::class, 'destroy'])->name('tutorials.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // User management
    Route::resource('users', AdminUserController::class);
    Route::post('/users/{user}/restore', [AdminUserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{user}/force-delete', [AdminUserController::class, 'forceDelete'])->name('users.force-delete');

    // Artwork management
    Route::resource('artworks', AdminArtworkController::class);
    Route::post('/artworks/{artwork}/restore', [AdminArtworkController::class, 'restore'])->name('artworks.restore');
    Route::delete('/artworks/{artwork}/force-delete', [AdminArtworkController::class, 'forceDelete'])->name('artworks.force-delete');

    // Category management
    Route::resource('categories', AdminCategoryController::class);

    // Tutorial management
    Route::resource('tutorials', AdminTutorialController::class);
    Route::post('/tutorials/{tutorial}/restore', [AdminTutorialController::class, 'restore'])->name('tutorials.restore');
    Route::delete('/tutorials/{tutorial}/force-delete', [AdminTutorialController::class, 'forceDelete'])->name('tutorials.force-delete');
});
