<?php

namespace App\Providers;

use App\Models\Artwork;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\Tutorial;
use App\Policies\ArtworkPolicy;
use App\Policies\CollectionPolicy;
use App\Policies\CommentPolicy;
use App\Policies\TutorialPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register policies
        Gate::policy(Artwork::class, ArtworkPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
        Gate::policy(Tutorial::class, TutorialPolicy::class);
        Gate::policy(Collection::class, CollectionPolicy::class);
    }
}
