<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Navigation\NavigationItem;
use App\Filament\Pages\Auth\EditProfile;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
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
            ->profile(EditProfile::class)
            ->navigationItems([
                NavigationItem::make('My Profile')
                    ->url('http://portal.siix-ems.co.id/mainMenu/profile')
                    ->icon('heroicon-o-user')
            ])
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
                // BreezyCore::make()
                //     ->myProfile(
                //         // shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                //         // shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                //         // navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                //         // hasAvatars: false, // Enables the avatar upload form component (default = false)
                //         slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                //     )
                //     ->enableTwoFactorAuthentication(
                //         force: false, // force the user to enable 2FA before they can use the application (default = false)
                //         // action: CustomTwoFactorPage::class // optionally, use a custom 2FA page
                //     )
                //     ->withoutMyProfileComponents([
                //         'update_password'
                //     ])
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
            // ->renderHook(
            //     // PanelsRenderHook::BODY_END,
            //     PanelsRenderHook::FOOTER,
            //     fn() => view('footer')
            // )
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
