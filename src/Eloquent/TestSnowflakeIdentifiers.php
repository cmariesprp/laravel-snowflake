<?php

namespace BradieTilley\Snowflakes\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array<class-string<Model>, int> $models List of models and their current incrementing ID counters
 */
class TestSnowflakeIdentifiers
{
    public const START_ID = 9000000000000000000;

    protected array $models = [];

    /**
     * Resolve the singleton instance
     */
    public static function make(): static
    {
        return app(static::class);
    }

    /**
     * Reset any recorded IDs, such as when you've truncated a DB
     * table and want the incremental test IDs to start from 1 again
     */
    public function reset(): void
    {
        $this->models = [];
    }

    /**
     * Get the next incremental ID
     */
    public function getNextId(string $model): string
    {
        $this->models[$model] ??= static::START_ID;
        $this->models[$model]++;

        return (string) $this->models[$model];
    }
}
