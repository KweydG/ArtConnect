<?php

namespace Database\Factories;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artwork>
 */
class ArtworkFactory extends Factory
{
    protected $model = Artwork::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mediums = ['Oil on Canvas', 'Acrylic', 'Watercolor', 'Digital', 'Charcoal', 'Pencil', 'Mixed Media', 'Photography'];
        $tagOptions = ['abstract', 'portrait', 'landscape', 'nature', 'urban', 'modern', 'classic', 'colorful', 'minimalist', 'surreal'];

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraphs(2, true),
            'image' => 'artworks/default.jpg',
            'medium' => fake()->randomElement($mediums),
            'tags' => fake()->randomElements($tagOptions, fake()->numberBetween(1, 4)),
            'views' => fake()->numberBetween(0, 1000),
        ];
    }
}
