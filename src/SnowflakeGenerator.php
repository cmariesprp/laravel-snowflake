<?php

namespace BradieTilley\Snowflakes;

use BradieTilley\Snowflake\Snowflake;
use BradieTilley\Snowflakes\IdentifierResolvers\SequentialIdentifierResolver;

class SnowflakeGenerator
{
    protected bool $booted = false;

    public static function make(): static
    {
        return app(static::class);
    }

    protected function boot(): void
    {
        if ($this->booted) {
            return;
        }

        $this->booted = true;

        if (config('snowflakes.testing')) {
            Snowflake::identifierResolver(new SequentialIdentifierResolver());
        }

        /** @var array{ epoch: string, cluster: int, worker: int } $config */
        $config = config('snowflakes.constants', []);
        Snowflake::configure($config['epoch'], $config['cluster'], $config['worker']);
    }

    public function id(string $group): string
    {
        $this->boot();

        return Snowflake::id($group);
    }
}
