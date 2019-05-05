<?php

namespace Artooha\UniversalBot\CacheDriver;

use Artooha\UniversalBot\Interfaces\CacheDriverInterface;

class FileCacheDriver implements CacheDriverInterface
{
    protected $cacheDir;

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $key = md5($key);
        $fileName = $this->getCacheDir().'/'.$key.'.cache';

        if (!file_exists($fileName)) {
            return null;
        }

        $contents = file_get_contents($fileName);
        $contents = explode('###', $contents, 2);
        if (count($contents) != 2) {
            return null;
        }

        if (!is_numeric($contents[0])) {
            return null;
        }

        if ($contents[0] < time()) {
            @unlink($fileName);

            return null;
        }

        return unserialize($contents[1]);
    }

    /**
     * @param string $key
     * @param string $value
     * @param int $expiresIn
     */
    public function set($key, $value, $expiresIn = 3600)
    {
        $key = md5($key);
        $fileName = $this->getCacheDir().'/'.$key.'.cache';

        $expiration = time() + $expiresIn;
        $data = $expiration.'###'.serialize($value);

        file_put_contents($fileName, $data);
    }

    /**
     * @return string
     */
    protected function getCacheDir()
    {
        if (!empty($this->cacheDir)) {
            return $this->cacheDir;
        }

        $includedFiles = get_included_files();
        $first = reset($includedFiles);
        $this->cacheDir = rtrim(dirname($first), '/').'/cache';

        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }

        return $this->cacheDir;
    }
}
