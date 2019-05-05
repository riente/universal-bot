<?php

namespace Artooha\UniversalBot\Traits;

use Artooha\UniversalBot\Interfaces\CacheDriverInterface;

trait CacheTrait
{
    /**
     * @param $key
     * @return mixed
     */
    protected function cacheGet($key)
    {
        if (!empty($this->cacheDriver) && $this->cacheDriver instanceof CacheDriverInterface) {
            return $this->cacheDriver->get($key);
        }

        return null;
    }

    /**
     * @param string $key
     * @param string $value
     * @param int $expiresIn
     */
    protected function cacheSet($key, $value, $expiresIn = 3600)
    {
        if (!empty($this->cacheDriver) && $this->cacheDriver instanceof CacheDriverInterface) {
            $this->cacheDriver->set($key, $value, $expiresIn);
        }
    }
}
