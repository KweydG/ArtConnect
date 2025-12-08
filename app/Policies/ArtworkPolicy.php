<?php

namespace App\Policies;

use App\Models\Artwork;
use App\Models\User;

class ArtworkPolicy
{
    /**
     * Determine whether the user can update the artwork.
     */
    public function update(User $user, Artwork $artwork): bool
    {
        return $user->id === $artwork->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the artwork.
     */
    public function delete(User $user, Artwork $artwork): bool
    {
        return $user->id === $artwork->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the artwork.
     */
    public function restore(User $user, Artwork $artwork): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the artwork.
     */
    public function forceDelete(User $user, Artwork $artwork): bool
    {
        return $user->isAdmin();
    }
}
