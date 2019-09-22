<?php


namespace App\Router\Factory;

use App\router\RouterInterface;

/**
 * Interface RouterFactoryInterface
 * @package App\Router\Factory
 */
interface RouterFactoryInterface
{

    /**
     * @param string $buildKey
     * @param array $routes
     * @param array $httpRoutes
     * @return RouterInterface
     */
    public function make(string $buildKey, array $routes, array $httpRoutes);

}