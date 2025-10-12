<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return redirect(LaravelLocalization::localizeURL('/'));
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('/about', [AboutController::class, 'index'])->name('about');

        Route::get('/services', [ServicesController::class, 'index'])->name('services');
        Route::get('/services/{slug}', [ServicesController::class, 'show'])->name('service.details');

        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.details');

        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
    }
);
