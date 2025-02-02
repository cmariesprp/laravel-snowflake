<?php

namespace BradieTilley\Snowflakes\SequenceResolvers;

use BradieTilley\Snowflake\SequenceResolvers\SequenceResolver;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;

class LaravelCacheResolver implements SequenceResolver
{
    protected string $prefix;

    protected Repository $cache;

    public function __construct(CacheManager $cache)
    {
        /** @var ?string $store */
        $store = config('snowflakes.sequencing.store');
        $this->cache = $cache->store($store);

        /** @var string $prefix */
        $prefix = config('snowflakes.sequencing.prefix', '');
        $this->prefix = $prefix;
    }

    public function sequence(int $currentTime): int
    {
        $key = $this->prefix.$currentTime;

        if ($this->cache->add($key, 1, 10)) {
            return 0;
        }

        return $this->cache->increment($key) | 0;
    }
}
