<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_loads_the_blog_index_page()
    {
        $user = User::factory()->create();
        Post::factory()->for($user)->create();

        $response = $this->get('/blog/page/1');

        $response->assertStatus(200);

        $response->assertInertia(fn (Assert $page) =>
            $page->component('blog/index')
                ->has('posts.data')
                ->has('posts.data.0.comments_count')
                ->where('posts.current_page', 1)
        );
    }

    #[Test]
    public function it_paginates_posts_properly()
    {
        $perPage = config('blog.posts_per_page', 10);
        $user = User::factory()->create();
        Post::factory()->for($user)->count($perPage + 3)->create();

        $response = $this->get('/blog/page/2');

        $response->assertInertia(fn (Assert $page) =>
            $page->component('blog/index')
                ->where('posts.current_page', 2)
                ->has('posts.data', 3) // remaining posts
        );
    }
}
