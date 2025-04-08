<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 posts using Faker
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {

            $title = $faker->sentence;

            Post::create([
                'title' => $title,
                'slug' => $title,
                'content' => $faker->paragraph,
                'user_id' => rand(1, 5), // Assuming you have users with IDs between 1 and 5
                'is_published' => true,
            ]);
        }
    }
}
