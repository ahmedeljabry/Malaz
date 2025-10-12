<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Post;
use App\Models\Service;
use App\Models\Vision;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(12)
            ->get();

        $posts = Post::query()
            ->where('is_published', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        $partners = Partner::query()
            ->orderBy('sort_order')
            ->get();

        $visions = Vision::query()
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('pages.home', compact('services', 'posts', 'partners', 'visions'));
    }
}
