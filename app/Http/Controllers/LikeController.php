<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Toggle like on an artwork.
     */
    public function toggle(Artwork $artwork)
    {
        $user = auth()->user();

        if ($artwork->isLikedBy($user)) {
            $artwork->likes()->where('user_id', $user->id)->delete();
            $message = 'Like removed.';
        } else {
            $artwork->likes()->create(['user_id' => $user->id]);
            $message = 'Artwork liked!';
        }

        if (request()->expectsJson()) {
            return response()->json([
                'liked' => $artwork->fresh()->isLikedBy($user),
                'likes_count' => $artwork->likes()->count(),
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
