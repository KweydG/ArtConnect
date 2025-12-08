<?php

namespace App\Policies;

use App\Models\Tutorial;
use App\Models\User;

class TutorialPolicy
{
    /**
     * Determine whether the user can update the tutorial.
     */
    public function update(User $user, Tutorial $tutorial): bool
    {
        return $user->id === $tutorial->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the tutorial.
     */
    public function delete(User $user, Tutorial $tutorial): bool
    {
        return $user->id === $tutorial->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the tutorial.
     */
    public function restore(User $user, Tutorial $tutorial): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the tutorial.
     */
    public function forceDelete(User $user, Tutorial $tutorial): bool
    {
        return $user->isAdmin();
    }
}
