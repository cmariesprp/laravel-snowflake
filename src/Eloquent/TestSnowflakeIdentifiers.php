<?php

namespace BradieTilley\Snowflakes\Eloquent;

use Illuminate\Database\Eloquent\Model;

class TestSnowflakeIdentifiers
{
    public const START_ID = 9000000000000000000;

    /**
     * @var array<class-string<Model>,int> List of models and their current incrementing ID counters
     */
    protected array $models = [];

    /**
     * Resolve the singleton instance
     */
    public static function make(): self
    {
        /** @var self $instance */
        $instance = app(self::class);

        return $instance;
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
     *
     * @param class-string<Model> $model
     */
    public function getNextId(string $model): string
    {
        $count = $this->models[$model] ??= self::START_ID;
        $count++;
        $this->models[$model] = $count;

        return (string) $count;
    }
}
