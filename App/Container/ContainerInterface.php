<?php


namespace App\Container;

use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * Interface ContainerInterface
 * @package App\container
 */
interface ContainerInterface extends PsrContainerInterface
{

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function set(string $key, $value);

    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function reset(string $key, $value);

}