<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Get the user who owns this collection.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all artworks in this collection.
     */
    public function artworks(): BelongsToMany
    {
        return $this->belongsToMany(Artwork::class, 'artwork_collection')
            ->withTimestamps();
    }

    /**
     * Check if an artwork is in this collection.
     */
    public function hasArtwork(Artwork $artwork): bool
    {
        return $this->artworks()->where('artwork_id', $artwork->id)->exists();
    }

    /**
     * Get artworks count attribute.
     */
    public function getArtworksCountAttribute(): int
    {
        return $this->artworks()->count();
    }
}
