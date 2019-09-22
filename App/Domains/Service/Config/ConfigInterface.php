<?php


namespace App\Domains\Service\Config;

/**
 * Interface ConfigInterface
 * @package App\Domains\Service\Config
 */
interface ConfigInterface
{

    /**
     * @param $key
     * @return array|string
     */
    public function get($key);

    /**
     * @param array $config
     * @return void
     */
    public function setConfigArray(array $config);

}