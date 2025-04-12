<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_submit_a_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->post("/blog/{$post->slug}/comments", [
            'body' => 'This is a test comment.',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'body' => 'This is a test comment.',
            'is_approved' => true,
        ]);
    }

    #[Test]
    public function guest_cannot_submit_a_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $response = $this->post("/blog/{$post->slug}/comments", [
            'body' => 'Guest trying to comment.',
        ]);

        $response->assertRedirect('/login'); // Or 403 if you use `abort_unless(auth()->check())`
        $this->assertDatabaseMissing('comments', [
            'body' => 'Guest trying to comment.',
        ]);
    }

    #[Test]
    public function it_validates_required_body()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->post("/blog/{$post->slug}/comments", [
            'body' => '',
        ]);

        $response->assertSessionHasErrors('body');
    }

    #[Test]
    public function it_returns_404_for_nonexistent_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/blog/non-existent-slug/comments', [
            'body' => 'Trying to comment on non-existent post.',
        ]);

        $response->assertStatus(404);
    }
}
