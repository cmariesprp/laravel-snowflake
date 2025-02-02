<?php

namespace BradieTilley\Snowflakes;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SnowflakesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('snowflakes')
            ->hasConfigFile('snowflakes');
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(SnowflakeGenerator::class, SnowflakeGenerator::class);
    }
}
