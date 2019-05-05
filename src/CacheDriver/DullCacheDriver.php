<?php

namespace Artooha\UniversalBot\CacheDriver;

use Artooha\UniversalBot\Interfaces\CacheDriverInterface;

class DullCacheDriver implements CacheDriverInterface
{
    protected $cache = [];

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->cache[$key] ?? $default;
    }

    /**
     * @param string $key
     * @param string $value
     * @param int $expiresIn
     */
    public function set($key, $value, $expiresIn = 3600)
    {
        $this->cache[$key] = $value;
    }
}
