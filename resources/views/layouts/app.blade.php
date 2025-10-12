

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ \App\Models\Setting::value('site_title') ?: config('app.name') }} | @yield('title')</title>

        {{-- SEO Meta --}}
        <x-seo.meta />

        {{-- Global assets --}}
        <link href="{{ asset('web/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('web/css/owl.carousel.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('web/css/owl.theme.default.min.css') }}" rel="stylesheet" />
        @php($favicon = \App\Models\Setting::value('site_favicon'))
        @if($favicon)
            <link type="icon" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}" rel="icon" />
        @endif

        @if (app()->getLocale() == 'en') <link href="{{ asset('web/css/styles.css') }}" rel="stylesheet" />
        @else <link href="{{ asset('web/css/styles.rtl.css') }}" rel="stylesheet" />@endif
        @stack('head')
    </head>
    <body>
        {{-- Global Nav --}}
        <x-layout.nav />

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Global Footer --}}
        <x-layout.footer />

        {{-- Global Text --}}
        <x-layout.text />

        {{-- Global Scripts --}}
        <x-layout.scripts />
        @stack('scripts')
    </body>
</html>
