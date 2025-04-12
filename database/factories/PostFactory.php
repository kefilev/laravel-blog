<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = rtrim(fake()->sentence(), '.'); // Remove the trailing dot if it exists

        return [
            'title' => $title,
            'slug' => $title,
            'content' => fake()->realText(config('blog.seeder.post_content_length')),
            'user_id' => rand(1, config('blog.seeder.users_count')),
            'is_published' => true,
        ];
    }
}
