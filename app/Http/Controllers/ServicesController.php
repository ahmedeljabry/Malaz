<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServicesController extends Controller
{
    public function index()
    {
        return view('pages.services', ['services' => Service::active()->orderBy('sort_order')->orderBy('id')->paginate(12)]);
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->with('sections')->firstOrFail();
        return view('pages.service-details', compact('service'));
    }
}
