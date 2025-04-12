<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_displays_a_published_post_by_slug()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)
            ->has(Comment::factory()->count(2)->for($user), 'comments')
            ->create([
                'is_published' => true
            ]);

        $response = $this->get(route('blog.show', $post->slug));

        $response->assertInertia(fn (Assert $page) => $page
            ->component('blog/show')
            ->has('post')
            ->where('post.slug', $post->slug)
            ->where('post.title', $post->title)
            ->has('post.comments', 2)
            ->where('post.comments.0.user.name', $user->name)
        );

        $response->assertStatus(200);
    }

    #[Test]
    public function it_returns_404_for_unpublished_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create([
            'is_published' => false,
        ]);

        $this->get(route('blog.show', $post->slug))
            ->assertStatus(404);
    }

    #[Test]
    public function it_returns_404_for_non_existent_slug()
    {
        $this->get('/blog/non-existent-slug')
            ->assertStatus(404);
    }
}
