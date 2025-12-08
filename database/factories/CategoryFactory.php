<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Painting',
            'Drawing',
            'Photography',
            'Digital Art',
            'Sculpture',
            'Mixed Media',
            'Illustration',
            'Graphic Design',
            'Watercolor',
            'Oil Painting',
            'Acrylic',
            'Charcoal',
            'Pencil Sketch',
            'Street Art',
            'Abstract',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
            'image' => null,
        ];
    }
}
