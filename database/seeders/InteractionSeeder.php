<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;

class InteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $artworks = Artwork::all();

        // Create likes
        foreach ($artworks as $artwork) {
            $likers = $users->random(rand(1, min(5, $users->count())));
            foreach ($likers as $user) {
                Like::firstOrCreate([
                    'user_id' => $user->id,
                    'artwork_id' => $artwork->id,
                ]);
            }
        }

        // Create comments
        $comments = [
            'Amazing work! I love the colors.',
            'This is so inspiring!',
            'Great composition and technique.',
            'Beautiful piece of art!',
            'I love how you captured the light.',
            'The details are incredible!',
            'This speaks to me on so many levels.',
            'Wonderful creativity!',
            'Keep up the great work!',
            'This is absolutely stunning!',
            'Your style is unique and beautiful.',
            'I wish I could create something like this!',
        ];

        foreach ($artworks as $artwork) {
            $numComments = rand(0, 4);
            for ($i = 0; $i < $numComments; $i++) {
                Comment::create([
                    'user_id' => $users->random()->id,
                    'artwork_id' => $artwork->id,
                    'content' => $comments[array_rand($comments)],
                ]);
            }
        }

        // Create collections
        foreach ($users as $user) {
            $collection = Collection::create([
                'user_id' => $user->id,
                'name' => 'My Favorites',
                'description' => 'A collection of my favorite artworks.',
                'is_public' => true,
            ]);

            // Add random artworks to collection
            $randomArtworks = $artworks->random(min(rand(2, 5), $artworks->count()));
            $collection->artworks()->attach($randomArtworks->pluck('id'));
        }

        // Create follows
        foreach ($users as $user) {
            $usersToFollow = $users->where('id', '!=', $user->id)->random(min(rand(1, 3), $users->count() - 1));
            foreach ($usersToFollow as $userToFollow) {
                $user->following()->syncWithoutDetaching([$userToFollow->id]);
            }
        }
    }
}
