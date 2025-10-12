<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('pages.blog', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->firstOrFail();
        return view('pages.blog_details', compact('post'));
    }
}
