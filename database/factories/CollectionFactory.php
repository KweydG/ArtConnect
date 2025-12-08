<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'My Favorites',
            'Inspiration Board',
            'Abstract Collection',
            'Nature Art',
            'Portrait Gallery',
            'Digital Masterpieces',
            'Color Studies',
            'Minimalist Art',
            'Urban Sketches',
            'Traditional Art',
        ];

        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement($names) . ' ' . fake()->numberBetween(1, 100),
            'description' => fake()->optional()->paragraph(),
            'is_public' => fake()->boolean(80),
        ];
    }

    /**
     * Indicate that the collection is public.
     */
    public function public(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => true,
        ]);
    }

    /**
     * Indicate that the collection is private.
     */
    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => false,
        ]);
    }
}
