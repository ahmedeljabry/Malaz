@php
    $siteName = \App\Models\Setting::value('site_name') ?: config('app.name');
    $metaTitle = \App\Models\Setting::value('meta_title') ?: (\App\Models\Setting::value('site_title') ?: $siteName);
    $metaDescription = \App\Models\Setting::value('meta_description') ?: '';
    $metaKeywords = \App\Models\Setting::value('meta_keywords') ?: '';
    $metaRobots = \App\Models\Setting::value('meta_robots') ?: 'index, follow';
    $metaAuthor = \App\Models\Setting::value('meta_author') ?: '';
    $metaCanonical = \App\Models\Setting::value('meta_canonical') ?: url()->current();

    $ogTitle = \App\Models\Setting::value('meta_og_title') ?: $metaTitle;
    $ogDescription = \App\Models\Setting::value('meta_og_description') ?: $metaDescription;
    $ogImagePath = \App\Models\Setting::value('meta_og_image') ?: \App\Models\Setting::value('site_logo');
    $ogImage = $ogImagePath ? \Illuminate\Support\Facades\Storage::url($ogImagePath) : asset('web/img/share.png');

    $twTitle = \App\Models\Setting::value('meta_twitter_title') ?: $metaTitle;
    $twDescription = \App\Models\Setting::value('meta_twitter_description') ?: $metaDescription;
    $twImagePath = \App\Models\Setting::value('meta_twitter_image') ?: $ogImagePath;
    $twImage = $twImagePath ? \Illuminate\Support\Facades\Storage::url($twImagePath) : $ogImage;
@endphp

<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $metaKeywords }}">
<meta name="robots" content="{{ $metaRobots }}">
<meta name="author" content="{{ $metaAuthor }}">
<link rel="canonical" href="{{ $metaCanonical }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="@hasSection('title')@yield('title')@else{{ $ogTitle }}@endif">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:url" content="{{ url()->current() }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@hasSection('title')@yield('title')@else{{ $twTitle }}@endif">
<meta name="twitter:description" content="{{ $twDescription }}">
<meta name="twitter:image" content="{{ $twImage }}">