<?php

return [
    'site_name' => env('APP_NAME', 'Laravel'),
    'title_separator' => ' | ',
    'default' => [
        'title' => env('APP_NAME', 'Laravel'),
        'description' => ' ',
        'canonical' => null,
        'image' => null,
        'locale' => config('app.locale'),
    ],
    'twitter' => [
        'card' => 'summary_large_image',
        'site' => null,
    ],
];

