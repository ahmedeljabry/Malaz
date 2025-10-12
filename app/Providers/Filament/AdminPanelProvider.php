<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\PostsPerMonthChart;
use App\Filament\Widgets\ContactMessagesPerMonthChart;
use App\Filament\Widgets\RecentContactMessages;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->brandName('لوحة التحكم')
            ->id('admin')
            ->path('admin')
            ->login()
            ->bootUsing(function () {
                app()->setLocale('ar');
            })
            ->brandName(fn () => Setting::value('site_name') ?? config('app.name'))
            ->brandLogo(fn () => optional(Setting::value('site_logo')) ? Storage::url(Setting::value('site_logo')) : null)
            ->favicon(fn () => optional(Setting::value('site_favicon')) ? Storage::url(Setting::value('site_favicon')) : null)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                StatsOverview::class,
                PostsPerMonthChart::class,
                ContactMessagesPerMonthChart::class,
                RecentContactMessages::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->databaseNotifications()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

