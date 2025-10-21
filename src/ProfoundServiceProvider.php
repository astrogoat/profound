<?php

namespace Astrogoat\Profound;

use Helix\Lego\Apps\App;
use Helix\Lego\Apps\AppPackageServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Astrogoat\Profound\Settings\ProfoundSettings;

class ProfoundServiceProvider extends AppPackageServiceProvider
{
    public function registerApp(App $app): App
    {
        return $app
            ->name('profound')
            ->settings(ProfoundSettings::class)
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ]);
    }

    public function configurePackage(Package $package): void
    {
        $package->name('profound')->hasConfigFile()->hasViews();
    }

    public function register(): void
    {
        parent::register();

        $this->app->singleton(Profound::class, function () {
            return new Profound();
        });
    }
}
