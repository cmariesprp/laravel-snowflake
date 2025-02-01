<?php

namespace BradieTilley\Snowflakes;

use BradieTilley\Snowflake\Snowflake;
use BradieTilley\Snowflakes\Eloquent\TestSnowflakeIdentifiers;
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
        $this->app->singleton(TestSnowflakeIdentifiers::class, TestSnowflakeIdentifiers::class);

        $config = config('snowflakes.constants', []);
        Snowflake::configure($config['epoch'], $config['cluster'], $config['worker']);
    }
}
