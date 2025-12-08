<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $categories = Category::all();

        $artworks = [
            [
                'title' => 'Sunset Over Manila Bay',
                'description' => 'A beautiful sunset captured at Manila Bay, showcasing the vibrant colors of the Philippine sky.',
                'medium' => 'Oil on Canvas',
                'tags' => ['landscape', 'sunset', 'nature'],
            ],
            [
                'title' => 'Urban Dreams',
                'description' => 'An abstract representation of city life and its complexities.',
                'medium' => 'Digital',
                'tags' => ['abstract', 'urban', 'modern'],
            ],
            [
                'title' => 'Portrait of Hope',
                'description' => 'A portrait capturing the essence of optimism and resilience.',
                'medium' => 'Charcoal',
                'tags' => ['portrait', 'minimalist'],
            ],
            [
                'title' => 'Forest Whispers',
                'description' => 'The mystical beauty of an enchanted forest at dawn.',
                'medium' => 'Watercolor',
                'tags' => ['nature', 'landscape', 'colorful'],
            ],
            [
                'title' => 'Digital Bloom',
                'description' => 'Flowers reimagined through digital artistry.',
                'medium' => 'Digital',
                'tags' => ['nature', 'digital', 'colorful'],
            ],
            [
                'title' => 'Street Life',
                'description' => 'Capturing the vibrant energy of street vendors and everyday life.',
                'medium' => 'Photography',
                'tags' => ['urban', 'street', 'documentary'],
            ],
        ];

        foreach ($users as $user) {
            foreach ($artworks as $index => $artworkData) {
                if ($index >= 2) break; // Each user creates 2 artworks

                Artwork::create([
                    'user_id' => $user->id,
                    'category_id' => $categories->random()->id,
                    'title' => $artworkData['title'] . ' by ' . $user->name,
                    'description' => $artworkData['description'],
                    'image' => 'artworks/default.jpg',
                    'medium' => $artworkData['medium'],
                    'tags' => $artworkData['tags'],
                    'views' => rand(10, 500),
                ]);
            }
        }

        // Create additional random artworks
        Artwork::factory(20)->create([
            'user_id' => fn () => $users->random()->id,
            'category_id' => fn () => $categories->random()->id,
        ]);
    }
}
