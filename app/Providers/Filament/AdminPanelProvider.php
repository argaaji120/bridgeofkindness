<?php

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Bridge of Kindness Admin')
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('4rem')
            ->colors([
                'primary' => Color::hex('#7AA9AC'),
                'secondary' => Color::hex('#F2C057'),
            ])
            ->favicon(asset('images/logo.png'))
            // ->sidebarCollapsibleOnDesktop()
            ->globalSearch(false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make()
                    ->navigationGroup('Setting')
                    ->navigationSort(100)
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->items([
                        NavigationItem::make('dashboard')
                            ->label(fn(): string => __('filament-panels::pages/dashboard.title'))
                            ->url(fn(): string => Dashboard::getUrl())
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.pages.dashboard')),
                    ])
                    ->groups([
                        NavigationGroup::make('Landing Page')
                            ->items([
                                ...\App\Filament\Resources\LandingHeroes\LandingHeroResource::getNavigationItems(),
                                ...\App\Filament\Resources\HomeCtaButtons\HomeCtaButtonResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Setting')
                            ->items([
                                ...\App\Filament\Resources\Users\UserResource::getNavigationItems(),
                                NavigationItem::make()
                                    ->label('Roles')
                                    ->icon(Heroicon::OutlinedShieldCheck)
                                    ->activeIcon(Heroicon::ShieldCheck)
                                    ->url(route('filament.admin.resources.shield.roles.index'))
                                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.shield.roles.*')),
                            ]),

                    ]);
            })
            ->topNavigation();
    }
}
