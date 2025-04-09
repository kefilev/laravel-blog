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
        $perPage = 5; // Number of posts per page
        $posts = Post::latest()->paginate($perPage, ['*'], 'page', $page);
        // $posts->withPath('/blog/page');
    
        return Inertia::render('blog/index', [
            'posts' => $posts,
            'page' => $page
        ]);
    }
}
