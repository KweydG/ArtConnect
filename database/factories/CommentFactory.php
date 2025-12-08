<?php

namespace Database\Factories;

use App\Models\Artwork;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
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
        ];

        return [
            'user_id' => User::factory(),
            'artwork_id' => Artwork::factory(),
            'content' => fake()->randomElement($comments) . ' ' . fake()->optional()->sentence(),
        ];
    }
}
