<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tutorial>
 */
class TutorialFactory extends Factory
{
    protected $model = Tutorial::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Getting Started with Watercolors',
            'Digital Art for Beginners',
            'Mastering Portrait Drawing',
            'Color Theory Fundamentals',
            'Perspective Drawing Techniques',
            'Oil Painting Basics',
            'Creating Abstract Art',
            'Photo Editing Essentials',
            'Sketching Tips and Tricks',
            'Mixed Media Art Guide',
        ];

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => fake()->unique()->randomElement($titles),
            'description' => fake()->paragraph(),
            'content' => fake()->paragraphs(5, true),
            'image' => null,
            'duration' => fake()->numberBetween(5, 60),
            'difficulty' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'views' => fake()->numberBetween(0, 5000),
        ];
    }

    /**
     * Indicate that the tutorial is for beginners.
     */
    public function beginner(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty' => 'beginner',
        ]);
    }

    /**
     * Indicate that the tutorial is intermediate level.
     */
    public function intermediate(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty' => 'intermediate',
        ]);
    }

    /**
     * Indicate that the tutorial is advanced level.
     */
    public function advanced(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty' => 'advanced',
        ]);
    }
}
