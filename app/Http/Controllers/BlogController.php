<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $page = 1)
    {
        $perPage = config('blog.posts_per_page'); // Number of posts per page
        $posts = Post::withCount('comments')
            ->latest()
            ->paginate($perPage, ['*'], 'page', $page);

        return Inertia::render('blog/index', [
            'posts' => $posts
        ]);
    }
}
