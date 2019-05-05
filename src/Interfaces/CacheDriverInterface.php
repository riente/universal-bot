<?php

namespace Artooha\UniversalBot\Interfaces;

interface CacheDriverInterface
{
    public function get($key, $default = null);
    public function set($key, $value, $expiresIn = 3600);
}
