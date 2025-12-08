<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Painting',
                'description' => 'Traditional and contemporary painting techniques including oil, acrylic, and watercolor.',
            ],
            [
                'name' => 'Drawing',
                'description' => 'Pencil, charcoal, ink, and other drawing mediums.',
            ],
            [
                'name' => 'Photography',
                'description' => 'Capturing moments through the lens - landscapes, portraits, and more.',
            ],
            [
                'name' => 'Digital Art',
                'description' => 'Art created using digital tools and software.',
            ],
            [
                'name' => 'Sculpture',
                'description' => '3D art forms crafted from various materials.',
            ],
            [
                'name' => 'Mixed Media',
                'description' => 'Combining different artistic mediums and materials.',
            ],
            [
                'name' => 'Illustration',
                'description' => 'Visual storytelling through illustrations and graphics.',
            ],
            [
                'name' => 'Street Art',
                'description' => 'Urban art including graffiti, murals, and installations.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'image' => null,
            ]);
        }
    }
}
