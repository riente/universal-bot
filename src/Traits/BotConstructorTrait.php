<?php

namespace Artooha\UniversalBot\Traits;

use Artooha\UniversalBot\CacheDriver\DullCacheDriver;
use Artooha\UniversalBot\Interfaces\CacheDriverInterface;

trait BotConstructorTrait
{
    protected $cacheDriver;

    function __construct(CacheDriverInterface $cacheDriver = null)
    {
        if (empty($cacheDriver)) {
            $this->cacheDriver = new DullCacheDriver();
        } else {
            $this->cacheDriver = $cacheDriver;
        }
    }
}
