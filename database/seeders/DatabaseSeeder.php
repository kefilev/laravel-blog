<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::factory()->create([
        //     'name' => 'Test User 2',
        //     'email' => 'test2@example.com',
        // ]);

        User::factory()->count(config('blog.seeder.users_count'))->create();
        Post::factory()->count(config('blog.seeder.posts_count'))->create();
        Comment::factory()->count(config('blog.seeder.comments_count'))->create();
    }
}
