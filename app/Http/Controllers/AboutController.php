<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $aboutTitle = Setting::value('about_title') ?? 'About Us';
        $aboutBody = Setting::value('about_body');
        $aboutImage = Setting::value('about_image');

        return view('pages.about', compact('aboutTitle', 'aboutBody', 'aboutImage'));
    }
}
