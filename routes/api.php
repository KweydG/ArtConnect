<?php

use App\Http\Controllers\Api\ArtworkController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\TutorialController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/

// Categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

// Artworks
Route::get('/artworks', [ArtworkController::class, 'index']);
Route::get('/artworks/{artwork}', [ArtworkController::class, 'show']);
Route::get('/artworks/{artwork}/comments', [CommentController::class, 'index']);

// Tutorials
Route::get('/tutorials', [TutorialController::class, 'index']);
Route::get('/tutorials/{tutorial}', [TutorialController::class, 'show']);

// Users/Artists
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/artworks', [UserController::class, 'artworks']);

/*
|--------------------------------------------------------------------------
| Authenticated API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    // Current user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Artworks CRUD
    Route::post('/artworks', [ArtworkController::class, 'store']);
    Route::put('/artworks/{artwork}', [ArtworkController::class, 'update']);
    Route::delete('/artworks/{artwork}', [ArtworkController::class, 'destroy']);

    // Comments
    Route::post('/artworks/{artwork}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    // Likes
    Route::post('/artworks/{artwork}/like', [ArtworkController::class, 'like']);
    Route::delete('/artworks/{artwork}/like', [ArtworkController::class, 'unlike']);

    // Follow
    Route::post('/users/{user}/follow', [UserController::class, 'follow']);
    Route::delete('/users/{user}/follow', [UserController::class, 'unfollow']);

    // Tutorials CRUD
    Route::post('/tutorials', [TutorialController::class, 'store']);
    Route::put('/tutorials/{tutorial}', [TutorialController::class, 'update']);
    Route::delete('/tutorials/{tutorial}', [TutorialController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    // Users management
    Route::get('/users', [UserController::class, 'adminIndex']);
    Route::post('/users/{user}/restore', [UserController::class, 'restore']);
    Route::delete('/users/{user}/force', [UserController::class, 'forceDelete']);

    // Artworks management
    Route::post('/artworks/{artwork}/restore', [ArtworkController::class, 'restore']);
    Route::delete('/artworks/{artwork}/force', [ArtworkController::class, 'forceDelete']);
});
