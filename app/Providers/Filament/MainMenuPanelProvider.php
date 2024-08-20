<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Navigation\MenuItem;

class MainMenuPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('mainMenu')
            ->path('mainMenu')
            ->brandLogo(asset('images/logo_siix.png'))
            ->favicon(asset('images/logo_siix.png'))
            ->brandLogoHeight('3rem')
            ->sidebarCollapsibleOnDesktop()
            ->brandName('Admin Portal')
            ->userMenuItems([
                'logout' => MenuItem::make()->label('Log out'),
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->plugin(
                \Hasnayeen\Themes\ThemesPlugin::make(),
            )
            ->plugins([
                FilamentApexChartsPlugin::make(),
            ])
            ->discoverResources(in: app_path('Filament/MainMenu/Resources'), for: 'App\\Filament\\MainMenu\\Resources')
            ->discoverPages(in: app_path('Filament/MainMenu/Pages'), for: 'App\\Filament\\MainMenu\\Pages')
            ->pages([
                \App\Filament\Pages\AdminDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/MainMenu/Widgets'), for: 'App\\Filament\\MainMenu\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
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
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
